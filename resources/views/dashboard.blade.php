<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="/"
                class="inline-flex gap-2 items-center rounded-lg bg-green-800 hover:bg-primary text-white transition-all px-3 py-2 font-poppins font-semibold">
                <i class="bi bi-globe"></i>
                <span>Landing Page</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10 border-2 border-black rounded-xl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                        <div class="space-y-4">
                            <h1 class="text-3xl md:text-4xl font-bold text-black dark:text-white">
                                Selamat Datang <br> {{ Auth::user()->name }}!
                            </h1>
                            <p class="text-gray-500 dark:text-gray-300 text-sm md:text-xl text-justify leading-relaxed">
                                "Tetaplah gigih dan kreatif dalam menjaga harmoni dan kemajuan.
                                Setiap langkahmu membentuk kenyamanan dan kesuksesan bagi banyak orang."
                            </p>
                        </div>
                        <div class="flex justify-center">
                            <img src="{{ asset('img/dashboard.png') }}" alt="dashboard-icon"
                                class="w-full max-w-sm h-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
