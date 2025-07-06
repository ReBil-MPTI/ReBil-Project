<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    use WithFileUploads;

    public $isEditing = false;

    public $name;
    public $email;
    public $phone;

    public $photo;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone_number;
    }

    public function enableEdit()
    {
        $this->isEditing = true;
    }

    public function save()
    {
        $user = auth()->user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
        ];

        // Hanya validasi password jika diisi
        if ($this->new_password) {
            $rules['new_password'] = 'string|min:6';
        }

        $this->validate($rules);

        // Upload foto profil jika ada
        if ($this->photo) {
            if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
                Storage::delete('public/' . $user->profile_image);
            }

            $path = $this->photo->store('profile-photos', 'public');
            $user->profile_image = $path;
        }

        // Update data umum
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone_number = $this->phone;

        // Update password jika ada
        if ($this->new_password) {
            $user->password = Hash::make($this->new_password);
        }

        $user->save();

        $this->reset(['photo', 'new_password', 'new_password_confirmation']);
        $this->isEditing = false;

        session()->flash('message', 'Profil berhasil diperbarui.');
    }


    public function render()
    {
        return view('livewire.user.profile')->layout('layouts.guest');
    }

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}
