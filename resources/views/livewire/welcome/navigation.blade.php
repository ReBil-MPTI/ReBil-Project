<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav class="-mx-3 flex flex-1 justify-end items-center space-x-4">
    @auth
        @if (Auth::user()->hasRole('Admin'))
            {{-- Tampilkan Logo + Nama untuk Admin --}}
            {{-- Tampilkan Dashboard untuk Admin --}}
            <a href="{{ url('/dashboard') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Dashboard
            </a>
        @else
            {{-- Tampilkan Avatar + Dropdown untuk User --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                        alt="Profile" class="w-8 h-8 rounded-full object-cover">
                    <span class="text-sm font-medium text-black dark:text-white">
                        {{ Auth::user()->name }}
                    </span>
                    <svg class="w-4 h-4 text-black dark:text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- Dropdown --}}
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg py-2 z-50">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600">Profile</a>
                    <button wire:click="logout"
                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20 transition duration-150 ease-in-out">
                        <i class="bi bi-box-arrow-right mr-2"></i>
                        {{ __('Log Out') }}
                    </button>
                </div>
            </div>
        @endif
    @else
        <a href="{{ route('login') }}"
            class="px-4 py-2 rounded-md bg-white text-black font-semibold hover:bg-gray-100 transition">
            Log in
        </a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="px-4 py-2 rounded-md bg-black text-yellow-400 font-semibold hover:bg-gray-800 transition">
                Register
            </a>
        @endif
    @endauth
</nav>
