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
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-kXvSF43q.css') }}">
    <script src="{{ asset('build/assets/app-C6zcaxnx.js') }}" defer></script>

</head>

<body class="antialiased">
    @include('layouts.navbar')
    <header
        class="bg-yellow-400 flex flex-col items-center justify-center rounded-b-[5em] md:rounded-b-[20em]  py-20 md:py-32 gap-10 border-b-[5px] border-black">
        <div class="w-full flex justify-center items-center text-center md:text-left md:px-16 gap-5">
            <div class="inline-flex">
                <div class="h-1 w-20 bg-white"></div>
                <div class="h-1 w-10 bg-black"></div>
            </div>
            <h1 class="font-bold font-poppins text-lg md:text-6xl leading-tight text-black">
                Our Cars
            </h1>
            <div class="inline-flex">
                <div class="h-1 w-10 bg-black"></div>
                <div class="h-1 w-20 bg-white"></div>
            </div>
        </div>
        <div class="w-full md:w-1/2">
            <h1 class="font-semibold font-poppins text-lg text-center md:text-4xl">Nikmati Perjalanan Dengan <br>
                Mobil Paling Nyaman</h1>
            <p class="text-center text-lg md:text-2xl mt-5 font-poppins">"Mulai petualangan Anda sekarang, pilih mobil
                impian
                Anda dan
                nikmati perjalanan tanpa khawatir.
                Pengalaman berkendara yang tak terlupakan dimulai di sini."</p>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')
    @livewireScripts
</body>

</html>
