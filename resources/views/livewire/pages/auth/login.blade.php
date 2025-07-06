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

            $user = auth()->user();

            // Cek role
            if ($user->hasRole('Admin')) {
                Session::regenerate();
                $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
                return;
            }

            if ($user->hasRole('Customer')) {
                Session::regenerate();
                $this->redirectIntended(default: route('landing', absolute: false), navigate: true);
                return;
            }

            // Jika role tidak dikenali, logout dan tolak akses
            auth()->logout();
            session()->flash('error', 'Role Anda tidak memiliki akses.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika email/password salah
            session()->flash('error', 'Email atau password salah.');
        }
    }
}; ?>

<div class="min-h-screen flex items-center justify-center bg-[#f1f2f6] dark:bg-gray-900 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 w-full max-w-7xl bg-transparent rounded-lg overflow-hidden">

        {{-- Kiri: Ilustrasi --}}
        <div class="bg-[#f1f2f6] dark:bg-gray-900 md:flex md:flex-col justify-center hidden">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white mb-2">
                Selamat Datang di Layanan Kami!
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                Kami senang menyambut Anda. Temukan kemudahan dan layanan terbaik hanya di sini!
            </p>


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
                <div x-data="{ show: false }" class="flex flex-col justify-center">
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" wire:model="form.password" id="password"
                            name="password" required
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-black focus:ring focus:ring-black/50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Masukkan Password">
                        <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                        <button type="button" @click="show = !show"
                            class="absolute right-3 top-3.5 text-gray-400 focus:outline-none"
                            :title="show ? 'Sembunyikan' : 'Tampilkan'">
                            <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                        </button>
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
