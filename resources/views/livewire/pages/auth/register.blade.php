<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));
        $user->assignRole('Customer');

        Auth::login($user);

        // Cek role dan redirect sesuai role
        if ($user->hasRole('Admin')) {
            $this->redirect(route('dashboard', absolute: false), navigate: true);
            return;
        }

        if ($user->hasRole('Customer')) {
            $this->redirect(route('landing', absolute: false), navigate: true);
            return;
        }

        // Default fallback jika tidak ada role dikenali
        Auth::logout();
        session()->flash('error', 'Role tidak dikenali.');
    }
}; ?>

<div class="min-h-screen flex items-center justify-center bg-[#f1f2f6] dark:bg-gray-900 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 w-full max-w-7xl bg-transparent rounded-lg overflow-hidden">

        {{-- Kiri: Ilustrasi --}}
        <div class="bg-[#f1f2f6] dark:bg-gray-900 md:flex md:flex-col justify-center hidden">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white mb-2">
                Daftar untuk Bergabung!
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                Bergabunglah bersama kami dan nikmati berbagai layanan eksklusif.
            </p>

            <img src="{{ asset('img/logo-login-admin.png') }}" alt="Logo" class="h-full mb-4">
        </div>

        {{-- Kanan: Form --}}
        <div
            class="bg-white dark:bg-gray-800 shadow-[6px_6px_0_#000] rounded-xl p-10 flex flex-col justify-center border-b-8 border-r-8 border-l-2 border-t-2 border-black">
            <form wire:submit="register" class="space-y-6">
                <!-- Name -->
                <div>
                    <label for="name"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama</label>
                    <input wire:model="name" id="name" name="name" type="text" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-black focus:ring focus:ring-black/50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Masukkan Nama Lengkap">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                    <input wire:model="email" id="email" name="email" type="email" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-black focus:ring focus:ring-black/50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Masukkan Email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div x-data="{ show: false }">
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" wire:model="password" id="password" name="password"
                            required
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-black focus:ring focus:ring-black/50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Masukkan Password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <button type="button" @click="show = !show"
                            class="absolute right-3 top-3.5 text-gray-400 focus:outline-none"
                            :title="show ? 'Sembunyikan' : 'Tampilkan'">
                            <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div x-data="{ showConfirm: false }">
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Konfirmasi Password</label>
                    <div class="relative">
                        <input :type="showConfirm ? 'text' : 'password'" wire:model="password_confirmation"
                            id="password_confirmation" name="password_confirmation" required
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-black focus:ring focus:ring-black/50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Konfirmasi Password">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        <button type="button" @click="showConfirm = !showConfirm"
                            class="absolute right-3 top-3.5 text-gray-400 focus:outline-none"
                            :title="showConfirm ? 'Sembunyikan' : 'Tampilkan'">
                            <i :class="showConfirm ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                        </button>
                    </div>
                </div>

                <!-- Tombol & Link -->
                <div class="flex items-center justify-between">
                    <a href="/login" wire:navigate
                        class="text-sm underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                        Sudah punya akun?
                    </a>
                    <button type="submit"
                        class="py-2 px-4 rounded-md bg-white text-black font-semibold border border-black shadow-[2px_2px_0_#000] hover:bg-gray-100">
                        Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
