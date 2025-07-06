<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class UserCRUD extends Component
{
    use WithFileUploads, WithPagination;
    public $fullname, $email, $password, $password_confirmation, $roleId;

    protected $rules = [
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'roleId' => 'required|exists:roles,id',
    ];

    protected $messages = [
        'fullname.required' => 'Nama lengkap harus diisi!',
        'email.required' => 'Email harus diisi!',
        'email.email' => 'Format email tidak valid!',
        'email.unique' => 'Email sudah terdaftar!',
        'password.required' => 'Kata sandi harus diisi!',
        'password.min' => 'Kata sandi minimal 8 karakter!',
        'password.confirmed' => 'Konfirmasi kata sandi tidak cocok!',
        'roleId.required' => 'Peran harus dipilih!',
        'roleId.exists' => 'Peran yang dipilih tidak valid!',
    ];


    public function render()
    {
        return view('livewire.user.user-c-r-u-d', [
            'users' => User::with('roles')->paginate(10),
            'roles' => Role::all(),
        ])->layout('layouts.app');
    }
}
