<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

class UserCRUD extends Component
{
    use WithFileUploads, WithPagination;

    public $fullname, $email, $userImage, $password, $password_confirmation, $roleId;
    public $selectedUserId = null;
    public $modalVisibleForm = false;
    public $modalEdit = false;
    public $modaldelete = false;
    public $deleteId = null;

    protected function rules()
    {
        $emailRule = 'required|email|max:255|unique:users,email';
        $passwordRule = 'required|string|min:8|confirmed';

        if ($this->selectedUserId) {
            $emailRule .= ',' . $this->selectedUserId;
            $passwordRule = 'nullable|string|min:8|confirmed';
        }

        return [
            'fullname' => 'required|string|max:255',
            'email' => $emailRule,
            'password' => $passwordRule,
            'password_confirmation' => 'same:password',
            'userImage' => 'nullable|image|max:5048',
            'roleId' => 'required|exists:roles,id',
        ];
    }

    protected $messages = [
        'fullname.required' => 'Nama lengkap harus diisi!',
        'email.required' => 'Email harus diisi!',
        'email.email' => 'Format email tidak valid!',
        'email.unique' => 'Email sudah terdaftar!',
        'password.required' => 'Kata sandi harus diisi!',
        'password.min' => 'Kata sandi minimal 8 karakter!',
        'password.confirmed' => 'Konfirmasi kata sandi tidak cocok!',
        'userImage.image' => 'File yang diunggah harus berupa gambar!',
        'userImage.max' => 'Ukuran gambar tidak boleh lebih dari 2MB!',
        'roleId.required' => 'Peran harus dipilih!',
        'roleId.exists' => 'Peran yang dipilih tidak valid!',
    ];

    public function modalVisible()
    {
        $this->reset(['fullname', 'email', 'password', 'password_confirmation', 'userImage', 'roleId', 'selectedUserId']);
        $this->modalVisibleForm = true;
        $this->modalEdit = false;
    }

    public function createUser()
    {
        $this->validate($this->rules(), $this->messages);

        try {
            $imagePath = null;
            if ($this->userImage) {
                $imagePath = Storage::disk('public')->putFile('profile_images', $this->userImage);
            }

            $user = User::create([
                'name' => $this->fullname,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'profile_image' => $imagePath,
            ]);

            $role = Role::findOrFail($this->roleId);
            $user->assignRole($role->name);

            session()->flash('message', 'Pengguna berhasil dibuat.');
            $this->modalVisibleForm = false;
            $this->resetForm();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);

        $this->selectedUserId = $user->id;
        $this->fullname = $user->name;
        $this->email = $user->email;
        $this->roleId = $user->roles->pluck('id')->first();
        $this->password = '';
        $this->password_confirmation = '';
        $this->userImage = null;

        $this->modalVisibleForm = true;
        $this->modalEdit = true;
    }

    public function update()
    {
        $this->validate($this->rules(), $this->messages);

        $user = User::findOrFail($this->selectedUserId);

        if ($this->userImage) {
            $imagePath = Storage::disk('public')->putFile('profile_images', $this->userImage);
            $user->profile_image = $imagePath;
        }


        $user->name = $this->fullname;

        if ($user->email !== $this->email) {
            $user->email = $this->email;
        }

        if (!empty($this->password)) {
            $user->password = bcrypt($this->password);
        }

        $role = Role::findOrFail($this->roleId);
        $roleName = $role->name;

        $user->syncRoles([$roleName]);

        $user->save();

        session()->flash('message', 'Pengguna berhasil diperbarui.');
        $this->modalVisibleForm = false;
        $this->modalEdit = false;
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->selectedUserId = $id;
        $this->modaldelete = true;
    }
    public function deleteUser()
    {
        $user = User::findOrFail($this->selectedUserId);

        try {
            $user->delete();
            session()->flash('message', 'Pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }

        $this->modaldelete = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['fullname', 'email', 'password', 'password_confirmation', 'userImage', 'roleId', 'selectedUserId']);
    }

    public function render()
    {
        return view('livewire.user.user-c-r-u-d', [
            'users' => User::with('roles')->paginate(10),
            'roles' => Role::all(),
        ])->layout('layouts.app');
    }
}
