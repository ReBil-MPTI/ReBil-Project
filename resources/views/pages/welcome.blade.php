<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <title>ReBil</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-CnIt_raY.css') }}">
    <script src="{{ asset('build/assets/app-C6zcaxnx.js') }}" defer></script> --}}

</head>

<body class="antialiased">
    @include('layouts.navbar')
    <header
        class="bg-yellow-400 flex flex-col md:flex-row items-center justify-between   py-20 md:py-32 gap-10 border-b border-black">
        <div class="w-full md:w-1/2 text-center md:text-left md:px-16">
            <h1 class="font-bold font-poppins text-4xl md:text-6xl leading-tight text-black">
                Sewa Mobil Dan <br /> Mulai Perjalanan
            </h1>
            <p class="mt-6 text-base md:text-xl text-black leading-relaxed">
                Mulai petualangan Anda sekarang, pilih mobil impian Anda dan nikmati perjalanan tanpa khawatir.<br />
                Pengalaman berkendara yang tak terlupakan dimulai di sini."
            </p>
            <a href="/sewa-mobil"
                class="inline-flex items-center mt-8 px-6 py-3 bg-black text-white rounded-md font-medium hover:bg-gray-800 transition">
                Sewa Mobil Sekarang
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        <div class="w-full md:w-1/2 flex justify-center">
            <img src="{{ asset('img/mobilgtr.png') }}" alt="mobil hero" class="w-full h-auto" />
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')
    @livewireScripts
</body>

</html>
