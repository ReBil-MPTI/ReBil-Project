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

<!-- Sidebar Container -->
<div x-data="{ sidebarOpen: false }">
    <!-- Sidebar -->
    <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-primary dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transform transition-transform duration-300 ease-in-out lg:translate-x-0">

        <!-- Sidebar Header -->
        <div class="flex items-center justify-between h-20 px-4 border-b border-gray-400 dark:border-gray-700">
            <div class="flex items-center">
                <x-application-logo class="block h-8 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </div>

            <!-- Close button for mobile -->
            <button @click="sidebarOpen = false"
                class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="mt-5 flex-1 px-2 space-y-1">
            <a href="{{ route('dashboard') }}" wire:navigate
                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-primary dark:bg-blue-900 dark:text-blue-200' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                <i class="bi bi-grid-1x2-fill mr-3 h-5 w-5"></i>
                {{ __('Dashboard') }}
            </a>

            <a href="{{ route('cars.index') }}" wire:navigate
                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('cars.index') ? 'bg-blue-100 text-primary dark:bg-blue-900 dark:text-blue-200' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                <i class="bi bi-car-front-fill mr-3 h-5 w-5"></i>
                {{ __('Data Mobil') }}
            </a>

            <a href="#" wire:navigate
                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                <i class="bi bi-diagram-3-fill mr-3 h-5 w-5"></i>
                {{ __('Riwayat Transaksi') }}
            </a>
        </nav>
        <div class="fixed bottom-10 w-full">
            <div class="px-4 py-2  border-gray-200">
                <div x-data="{ dark: localStorage.getItem('theme') === 'dark' }" x-init="document.documentElement.classList.toggle('dark', dark)" class="flex items-center justify-between">
                    <span class="text-sm font-medium text-white dark:text-gray-200">Dark Mode</span>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="dark"
                            @change="localStorage.setItem('theme', dark ? 'dark' : 'light');
                            document.documentElement.classList.toggle('dark', dark)"
                            class="sr-only peer">
                        <div
                            class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-2 text-xs">🌛</span>
                    </label>
                </div>
            </div>

            <!-- User Profile Section with Dropdown -->
            <div class="flex-shrink-0 ">
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button @click="dropdownOpen = !dropdownOpen"
                        class="w-full flex items-center px-4 py-3 text-sm font-medium text-white hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                        <div class="flex-shrink-0">
                            <div
                                class="h-10 w-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                <span class="text-sm font-medium text-white dark:text-gray-200">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-3 flex-1 text-left">
                            <p class="text-sm font-medium text-white dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                                x-text="name" x-on:profile-updated.window="name = $event.detail.name">
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-gray-400 transition-transform duration-150"
                                :class="{ 'rotate-180': dropdownOpen }" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute bottom-full left-0 right-0 mb-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-md shadow-lg z-10">

                        <div class="py-1">
                            <a href="{{ route('profile') }}" wire:navigate
                                class="block px-4 py-2 text-sm text-white hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                <i class="bi bi-person-fill mr-2"></i>
                                {{ __('Profile') }}
                            </a>

                            <hr class="border-gray-200 dark:border-gray-600">

                            <button wire:click="logout"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20 transition duration-150 ease-in-out">
                                <i class="bi bi-box-arrow-right mr-2"></i>
                                {{ __('Log Out') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu button -->
    <div x-show="!sidebarOpen" class="lg:hidden fixed top-4 right-4 z-50">
        <button @click="sidebarOpen = true"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>
</div>
