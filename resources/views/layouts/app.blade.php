<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('build/assets/app-kXvSF43q.css') }}">
    <script src="{{ asset('build/assets/app-C6zcaxnx.js') }}" defer></script>

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Include Navigation (Sidebar) -->
        <livewire:layout.navigation />

        <!-- Page Heading - positioned after sidebar -->
        @if (isset($header))
            <header class=" dark:bg-gray-800  lg:ml-64">
                <div class="max-w-7xl mx-auto py-7 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content - positioned after sidebar -->
        <main class="lg:ml-64 border dark:border-gray-800">
            <div class="container px-4 sm:px-6 lg:px-8">
                <div class="md:p-10 bg-white  rounded-2xl md:mt-10 md:mb-10">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
    @livewireScripts
</body>

</html>
