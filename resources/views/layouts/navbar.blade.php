<nav x-data="{ open: false }" class="bg-yellow-400 py-4 fixed w-full border-b border-black">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
        {{-- Kiri: Logo --}}
        <div class="flex items-center space-x-2">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-8 w-auto">
            <span class="font-bold text-lg text-black">REBIL</span>
        </div>

        {{-- Hamburger (mobile only) --}}
        <div class="md:hidden">
            <button @click="open = !open" class="text-black focus:outline-none">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Tengah: Menu --}}
        <ul class="hidden md:flex space-x-8 font-medium text-black">
            <li><a href="#home" class="hover:text-white transition">Home</a></li>
            <li><a href="#why-us" class="hover:text-white transition">Why Us</a></li>
            <li><a href="#sewa-mobil" class="hover:text-white transition">Sewa Mobil</a></li>
        </ul>

        {{-- Kanan: Button Login & Daftar --}}
        <div class="hidden md:flex space-x-3">
            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif
        </div>
    </div>

    {{-- Mobile Menu Dropdown --}}
    <div x-show="open" class="md:hidden px-4 pt-4 pb-2 space-y-2 font-medium text-black bg-yellow-400">
        <a href="#home" class="block hover:text-white transition">Home</a>
        <a href="#why-us" class="block hover:text-white transition">Why Us</a>
        <a href="#sewa-mobil" class="block hover:text-white transition">Sewa Mobil</a>

        {{-- Login/Daftar juga ditampilkan di mobile --}}
        <div class="pt-4 border-t border-black">
            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif
        </div>
    </div>
</nav>
