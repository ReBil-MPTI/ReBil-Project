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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" /> --}}
</head>

<body class="antialiased">
    @include('layouts.navbar')

    <!-- Hero -->
    <header
        class="bg-yellow-400 flex flex-col md:flex-row items-center justify-between py-20 md:py-32 gap-10 border-b border-black"
        data-aos="fade-down">
        <div class="w-full md:w-1/2 text-center md:text-left md:px-16">
            <h1 class="font-bold font-poppins text-4xl md:text-6xl leading-tight text-black" data-aos="fade-right"
                data-aos-delay="300">
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
        <div class="w-full md:w-1/2 flex justify-center" data-aos="zoom-in">
            <img src="{{ asset('img/mobilgtr.png') }}" alt="mobil hero" class="w-full h-auto" />
        </div>
    </header>

    <!-- Section Kenapa Memilih Kami -->
    <main>
        <div class="md:p-32" data-aos="fade-up">
            <div class="w-full flex justify-center flex-col items-center mt-10">
                <h1 class="font-bold font-poppins md:text-5xl text-xl text-center w-3/4 p-2">Kenapa harus memilih kami
                    untuk</h1>
                <div class="inline-flex">
                    <h1 class="font-bold bg-yellow-400 font-poppins md:text-5xl text-xl text-center w-fit md:p-2">Sewa
                        Mobil</h1>
                    <h1 class="font-bold font-poppins md:text-5xl text-xl text-center w-fit md:p-2">?</h1>
                </div>
            </div>
        </div>

        <div class="md:px-32 py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-5">
                @php
                    $features = [
                        ['img' => 'icon.png', 'title' => 'Fleksibilitas dalam Pilihan Kendaraan'],
                        ['img' => 'face-wink.png', 'title' => 'Pelayanan Pelanggan yang Unggul'],
                        ['img' => 'Vector57.png', 'title' => 'Harga yang Kompetitif'],
                        ['img' => 'Time_progress.png', 'title' => 'Ketersediaan Luas'],
                        ['img' => 'Trophy.png', 'title' => 'Kendaraan yang Terawat dan Berkualitas'],
                        ['img' => 'check_ring_round.png', 'title' => 'Proses Pemesanan yang Mudah'],
                    ];
                @endphp
                @foreach ($features as $i => $feature)
                    <div class="flex flex-col p-10 m-5 border-4 border-l border-t shadow-lg rounded-md border-black"
                        data-aos="zoom-in" data-aos-delay="{{ $i * 100 }}">
                        <img src="{{ asset('img/' . $feature['img']) }}" alt="" class="w-10 md:w-14">
                        <h1 class="font-poppins font-bold text-xl mt-5">{{ $feature['title'] }}</h1>
                        <p class="font-poppins mt-5">Kami menawarkan beragam jenis mobil mulai dari yang ekonomis hingga
                            premium, memungkinkan Anda untuk memilih sesuai kebutuhan</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Steps -->
        <div class="md:p-32">
            <div class="w-full flex justify-center flex-col items-center mt-10" data-aos="fade-up">
                <h1 class="font-bold font-poppins md:text-5xl text-xl text-center w-3/4 p-2">Hanya Beberapa Langkah
                    Untuk</h1>
                <div class="inline-flex">
                    <h1 class="font-bold bg-yellow-400 font-poppins md:text-5xl text-xl text-center w-fit md:p-2">
                        Menyewa</h1>
                    <h1 class="font-bold font-poppins md:text-5xl text-xl text-center w-fit md:p-2">Mobil Di kami</h1>
                </div>
                <h1 class="font-bold font-poppins text-xl text-center w-3/4 p-2">Itu sangat mudah, silahkan ikuti 4
                    langkah ini</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-10 md:mt-20">
                @php
                    $steps = [
                        [
                            'img' => 'selamat-datang.png',
                            'step' => 'Step 01',
                            'desc' =>
                                'Buat akun, masukkan informasi yang diperlukan seperti nama, alamat email, nomor telepon, dan kata sandi.',
                        ],
                        [
                            'img' => 'selamat-datang2.png',
                            'step' => 'Step 02',
                            'desc' => 'Pilih Jenis Mobil, klik atau pilih opsi untuk melakukan reservasi',
                        ],
                        [
                            'img' => 'selamat-datang3.png',
                            'step' => 'Step 03',
                            'desc' => 'Lakukan Pembayaran, pilih metode pembayaran yang diinginkan.',
                        ],
                        [
                            'img' => 'selamat-datang4.png',
                            'step' => 'Step 04',
                            'desc' => 'Datang ke Lokasi dan Jemput Mobil Impianmu dengan dokumen lengkap',
                        ],
                    ];
                @endphp

                @foreach ($steps as $i => $s)
                    @if ($i % 2 == 0)
                        <div data-aos="fade-right"><img src="{{ asset('img/' . $s['img']) }}" alt="tes"></div>
                        <div class="flex flex-col justify-center p-10 md:gap-3" data-aos="fade-left">
                            <h1 class="font-bold font-poppins text-xl md:text-3xl">{{ $s['step'] }}</h1>
                            <p class="font-bold font-poppins text-xl md:text-3xl">{{ $s['desc'] }}</p>
                        </div>
                    @else
                        <div class="flex flex-col justify-center p-10 md:gap-3" data-aos="fade-right">
                            <h1 class="font-bold font-poppins text-xl md:text-3xl">{{ $s['step'] }}</h1>
                            <p class="font-bold font-poppins text-xl md:text-3xl">{{ $s['desc'] }}</p>
                        </div>
                        <div data-aos="fade-left"><img src="{{ asset('img/' . $s['img']) }}" alt=""></div>
                    @endif
                @endforeach
            </div>
        </div>
    </main>

    @include('layouts.footer')
    @livewireScripts
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        document.addEventListener('livewire:load', () => {
            Livewire.hook('message.processed', () => {
                AOS.refresh();
            });
        });
    </script>
</body>

</html>
