<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        try {
            $this->form->authenticate();

            if (!auth()->user()->hasRole('Admin')) {
                auth()->logout();
                session()->flash('error', 'Anda tidak memiliki akses.');
                return;
            }

            Session::regenerate();
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika email/password salah
            session()->flash('error', 'Email atau password salah.');
        }
    }
}; ?>

<div class="min-h-screen flex items-center justify-center bg-[#f1f2f6] dark:bg-gray-900 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 w-full max-w-7xl bg-transparent rounded-lg overflow-hidden">

        {{-- Kiri: Ilustrasi --}}
        <div class="bg-[#f1f2f6] dark:bg-gray-900 flex flex-col justify-center">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white mb-2">Selamat Datang Admin !</h2>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">Jangan lupa lembur ya admin ! mwehehe</p>
            <img src="{{ asset('img/logo-login-admin.png') }}" alt="Logo" class="h-full mb-4">
        </div>

        {{-- Kanan: Form --}}
        <div
            class="bg-white dark:bg-gray-800 shadow-[6px_6px_0_#000] rounded-xl p-10 flex flex-col justify-center border-b-8 border-r-8 border-l-2 border-t-2 border-black">
            <form wire:submit="login" class="space-y-6">
                @if (session('error'))
                    <div class="text-sm text-red-600 dark:text-red-400">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Username -->
                <div>
                    <label for="email"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                    <input wire:model="form.email" id="email" name="email" type="text" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-black focus:ring focus:ring-black/50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Masukkan Email">
                </div>

                <!-- Password -->
                <div>
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
                    <div class="relative">
                        <input wire:model="form.password" id="password" name="password" type="password" required
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-black focus:ring focus:ring-black/50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Masukkan Password">
                        <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                        {{-- Optional: Toggle show/hide --}}
                        <span class="absolute right-3 top-3.5 text-gray-400">
                            <i class="bi bi-eye"></i> <!-- pakai Bootstrap Icon jika perlu -->
                        </span>
                    </div>
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                        class="w-full py-2 px-4 rounded-md bg-white text-black font-semibold border border-black shadow-[2px_2px_0_#000] hover:bg-gray-100">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
