<nav class="bg-yellow-400 py-4">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
        {{-- Kiri: Logo --}}
        <div class="flex items-center space-x-2">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-8 w-auto">
            <span class="font-bold text-lg text-black">REBIL</span>
        </div>

        {{-- Tengah: Menu --}}
        <ul class="hidden md:flex space-x-8 font-medium text-black">
            <li><a href="#home" class="hover:text-white transition">Home</a></li>
            <li><a href="#why-us" class="hover:text-white transition">Why Us</a></li>
            <li><a href="#sewa-mobil" class="hover:text-white transition">Sewa Mobil</a></li>
        </ul>

        {{-- Kanan: Button Login & Daftar --}}
        <div class="flex space-x-3">
            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif
        </div>
    </div>
</nav>
