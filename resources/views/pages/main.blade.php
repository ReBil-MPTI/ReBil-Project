@extends('pages.welcome')
@section('content')
    <div class="md:p-32" id="whyus">
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
            <div class="flex flex-col p-10 m-5 md:p-10  border-4 border-l border-t shadow-lg rounded-md border-black">
                <img src="{{ asset('img/icon.png') }}" alt="" class="w-5 md:w-14">
                <h1 class="font-poppins font-bold text-xl mt-5">Fleksibilitas dalam Pilihan Kendaraan</h1>
                <p class="font-poppins mt-5">
                    Kami menawarkan beragam jenis mobil mulai dari yang ekonomis hingga premium, memungkinkan Anda
                    untuk memilih sesuai kebutuhan
                </p>
            </div>
            <div class="flex flex-col p-10 m-5 md:p-10  border-4 border-l border-t shadow-lg rounded-md border-black">
                <img src="{{ asset('img/face-wink.png') }}" alt="" class="w-5 md:w-14">
                <h1 class="font-poppins font-bold text-xl mt-5">Pelayanan Pelanggan yang Unggul</h1>
                <p class="font-poppins mt-5">
                    Kami menawarkan beragam jenis mobil mulai dari yang ekonomis hingga premium, memungkinkan Anda
                    untuk memilih sesuai kebutuhan
                </p>
            </div>
            <div class="flex flex-col p-10 m-5 md:p-10  border-4 border-l border-t shadow-lg rounded-md border-black">
                <img src="{{ asset('img/Vector57.png') }}" alt="" class="w-5 md:w-14">
                <h1 class="font-poppins font-bold text-xl mt-5">Harga yang Kompetitif</h1>
                <p class="font-poppins mt-5">
                    Kami menawarkan beragam jenis mobil mulai dari yang ekonomis hingga premium, memungkinkan Anda
                    untuk memilih sesuai kebutuhan
                </p>
            </div>
            <div class="flex flex-col p-10 m-5 md:p-10  border-4 border-l border-t shadow-lg rounded-md border-black">
                <img src="{{ asset('img/Time_progress.png') }}" alt="" class="w-5 md:w-14">
                <h1 class="font-poppins font-bold text-xl mt-5">Ketersediaan Luas</h1>
                <p class="font-poppins mt-5">
                    Kami menawarkan beragam jenis mobil mulai dari yang ekonomis hingga premium, memungkinkan Anda
                    untuk memilih sesuai kebutuhan
                </p>
            </div>
            <div class="flex flex-col p-10 m-5 md:p-10  border-4 border-l border-t shadow-lg rounded-md border-black">
                <img src="{{ asset('img/Trophy.png') }}" alt="" class="w-10 md:w-14">
                <h1 class="font-poppins font-bold text-xl mt-5">Kendaraan yang Terawat dan Berkualitas</h1>
                <p class="font-poppins mt-5">
                    Kami menawarkan beragam jenis mobil mulai dari yang ekonomis hingga premium, memungkinkan Anda
                    untuk memilih sesuai kebutuhan
                </p>
            </div>
            <div class="flex flex-col p-10 m-5 md:p-10  border-4 border-l border-t shadow-lg rounded-md border-black">
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
@endsection
