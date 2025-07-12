<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <link rel="stylesheet" href="{{ asset('build/assets/app-CiYD4BMy.css') }}">
    <script src="{{ asset('build/assets/app-DNxiirP_.js') }}" defer></script>

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
            <a href="#"
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
        <div class="md:p-32">
            <div class="w-full flex justify-center flex-col items-center mt-10">
                <h1 class="font-bold font-poppins md:text-5xl text-xl text-center w-3/4 p-2">Kenapa harus memilih kamui
                    untuk
                </h1>
                <div class="inline-flex">
                    <h1 class="font-bold bg-yellow-400 font-poppins md:text-5xl text-xl text-center w-fit md:p-2">Sewa
                        Mobil
                    </h1>
                    <h1 class="font-bold font-poppins md:text-5xl text-xl text-center w-fit md:p-2">?</h1>
                </div>
            </div>
        </div>

        <div class="md:px-32 py-10">
            <div class="grid grid-cols1 md:grid-cols-3 gap-2 md:gap-5">
                <div
                    class="flex flex-col p-10 m-5 md:p-10  border-4 border-l border-t shadow-lg rounded-md border-black">
                    <img src="{{ asset('img/icon.png') }}" alt="" class="w-5 md:w-14">
                    <h1 class="font-poppins font-bold text-xl mt-5">Fleksibilitas dalam Pilihan Kendaraan</h1>
                    <p class="font-poppins mt-5">
                        Kami menawarkan beragam jenis mobil mulai dari yang ekonomis hingga premium, memungkinkan Anda
                        untuk memilih sesuai kebutuhan
                    </p>
                </div>
                <div
                    class="flex flex-col p-10 m-5 md:p-10  border-4 border-l border-t shadow-lg rounded-md border-black">
                    <img src="{{ asset('img/face-wink.png') }}" alt="" class="w-5 md:w-14">
                    <h1 class="font-poppins font-bold text-xl mt-5">Pelayanan Pelanggan yang Unggul</h1>
                    <p class="font-poppins mt-5">
                        Kami menawarkan beragam jenis mobil mulai dari yang ekonomis hingga premium, memungkinkan Anda
                        untuk memilih sesuai kebutuhan
                    </p>
                </div>
                <div
                    class="flex flex-col p-10 m-5 md:p-10  border-4 border-l border-t shadow-lg rounded-md border-black">
                    <img src="{{ asset('img/Vector57.png') }}" alt="" class="w-5 md:w-14">
                    <h1 class="font-poppins font-bold text-xl mt-5">Harga yang Kompetitif</h1>
                    <p class="font-poppins mt-5">
                        Kami menawarkan beragam jenis mobil mulai dari yang ekonomis hingga premium, memungkinkan Anda
                        untuk memilih sesuai kebutuhan
                    </p>
                </div>
                <div
                    class="flex flex-col p-10 m-5 md:p-10  border-4 border-l border-t shadow-lg rounded-md border-black">
                    <img src="{{ asset('img/Time_progress.png') }}" alt="" class="w-5 md:w-14">
                    <h1 class="font-poppins font-bold text-xl mt-5">Ketersediaan Luas</h1>
                    <p class="font-poppins mt-5">
                        Kami menawarkan beragam jenis mobil mulai dari yang ekonomis hingga premium, memungkinkan Anda
                        untuk memilih sesuai kebutuhan
                    </p>
                </div>
                <div
                    class="flex flex-col p-10 m-5 md:p-10  border-4 border-l border-t shadow-lg rounded-md border-black">
                    <img src="{{ asset('img/Trophy.png') }}" alt="" class="w-10 md:w-14">
                    <h1 class="font-poppins font-bold text-xl mt-5">Kendaraan yang Terawat dan Berkualitas</h1>
                    <p class="font-poppins mt-5">
                        Kami menawarkan beragam jenis mobil mulai dari yang ekonomis hingga premium, memungkinkan Anda
                        untuk memilih sesuai kebutuhan
                    </p>
                </div>
                <div
                    class="flex flex-col p-10 m-5 md:p-10  border-4 border-l border-t shadow-lg rounded-md border-black">
                    <img src="{{ asset('img/check_ring_round.png') }}" alt="" class="w-10 md:w-14">
                    <h1 class="font-poppins font-bold text-xl mt-5">Proses Pemesanan yang Mudah</h1>
                    <p class="font-poppins mt-5">
                        Kami menawarkan beragam jenis mobil mulai dari yang ekonomis hingga premium, memungkinkan Anda
                        untuk memilih sesuai kebutuhan
                    </p>
                </div>
            </div>
        </div>

        <div class="md:p-32">
            <div class="w-full flex justify-center flex-col items-center mt-10">
                <h1 class="font-bold font-poppins md:text-5xl text-xl text-center w-3/4 p-2">Hanya Beberapa Langkah
                    Untuk
                </h1>
                <div class="inline-flex">
                    <h1 class="font-bold bg-yellow-400 font-poppins md:text-5xl text-xl text-center w-fit md:p-2">
                        Menyewa
                    </h1>
                    <h1 class="font-bold font-poppins md:text-5xl text-xl text-center w-fit md:p-2">Mobil Di kami </h1>
                </div>
                <h1 class="font-bold font-poppins  text-xl text-center w-3/4 p-2">Itu sangat mudah, silahkan ikuti 4
                    langkah ini
                </h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-10 md:mt-20">
                <div>
                    <img src="{{ asset('img/selamat-datang.png') }}" alt="">
                </div>
                <div class=" flex flex-col  justify-center p-10 md:gap-3">
                    <h1 class="font-bold font-poppins text-xl md:text-3xl">Step 01</h1>
                    <p class="font-bold font-poppins text-xl md:text-3xl">Buat akun, masukkan informasi yang diperlukan
                        seperti
                        nama, alamat email, nomor telepon, dan kata
                        sandi.</p>
                </div>
                <div class=" flex flex-col  justify-center p-10 md:gap-3 mt-10">
                    <h1 class="font-bold font-poppins text-xl md:text-3xl">Step 02</h1>
                    <p class="font-bold font-poppins text-xl md:text-3xl">Pilih Jenis Mobil, Pilih mobil yang sesuai
                        dengan kebutuhan dan keinginanmu, kemudian klik atau pilih opsi untuk melakukan reservasi</p>
                </div>
                <div class="mt-10">
                    <img src="{{ asset('img/selamat-datang2.png') }}" alt="">
                </div>
                <div class="mt-10">
                    <img src="{{ asset('img/selamat-datang3.png') }}" alt="">
                </div>
                <div class=" flex flex-col  justify-center p-10 md:gap-3 mt-10">
                    <h1 class="font-bold font-poppins text-xl md:text-3xl">Step 03</h1>
                    <p class="font-bold font-poppins text-xl md:text-3xl">Lakukan Pembayaran, Pilih metode pembayaran
                        yang diinginkan (kartu kredit, transfer bank, atau opsi lainnya).</p>
                </div>
                <div class=" flex flex-col  justify-center p-10 md:gap-3 mt-10">
                    <h1 class="font-bold font-poppins text-xl md:text-3xl">Step 04</h1>
                    <p class="font-bold font-poppins text-xl md:text-3xl">Datang ke Lokasi dan Jemput Mobil Impianmu,
                        Pastikan untuk membawa dokumen yang diperlukan seperti SIM, kartu identitas, dan dokumen lain
                        yang diminta oleh penyedia layanan</p>
                </div>
                <div class="mt-10">
                    <img src="{{ asset('img/selamat-datang4.png') }}" alt="">
                </div>
            </div>
        </div>

        <div class="md:px-32 py-10">

        </div>
    </main>

    @include('layouts.footer')
    @livewireScripts
</body>

</html>
