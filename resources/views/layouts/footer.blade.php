<footer>
    <div class="bg-yellow-400">
        <div class="md:p-20">
            <h1 class="text-center font-poppins font-bold uppercase italic">mulai sekarang</h1>
            <div class="flex justify-center mt-5">
                <h1 class="font-poppins font-extrabold md:text-5xl text-center w-1/2">
                    <span class="bg-white px-2">Nikmati kenyamanan</span> dalam perjalanan Anda dengan mobil berkualitas
                    yang
                    kami sediakan
                </h1>
            </div>
            <div class="flex justify-center mt-5 ">
                <a href="/sewa-mobil"
                    class="py-2 px-4 bg-black hover:bg-gray-800 transition-all rounded-lg text-yellow-400 font-poppins font-light">Sewa
                    Mobil
                    Sekarang</a>
            </div>
            <div class="flex justify-center"><img src="{{ asset('img/footer-animation.png') }}" alt=""></div>
        </div>

    </div>
    <div class="py-10 px-6 md:px-20 bg-black">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Kolom 1 -->
            <div>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/logo-footer.png') }}" alt="Logo" class="w-56 object-contain" />
                </div>
                <div class="md:ml-10">
                    <p class="mt-4 text-yellow-400 font-poppins">Customer Service</p>
                    <p class="font-semibold text-yellow-400 font-poppins">24/7 Support by whatsapp, phone or email</p>
                </div>
            </div>

            <!-- Kolom 2 -->
            <div>
                <h3 class="text-lg font-bold text-yellow-400 font-poppins mb-2">Features</h3>
                <ul class="space-y-1">
                    <li><a href="/login" class="hover:underline text-yellow-400 font-poppins">Login</a></li>
                    <li><a href="/register" class="hover:underline text-yellow-400 font-poppins">Daftar</a></li>
                    <li>
                        @auth
                            <a href="{{ url('/profile-user') }}" class="hover:underline text-yellow-400 font-poppins">Ganti
                                Email</a>
                        @else
                            <a href="#" onclick="showLoginAlert()"
                                class="hover:underline text-yellow-400 font-poppins">Ganti Email</a>
                        @endauth
                    </li>
                    <li>
                        @auth
                            <a href="{{ url('/profile-user') }}" class="hover:underline text-yellow-400 font-poppins">Ganti
                                Password</a>
                        @else
                            <a href="#" onclick="showLoginAlert()"
                                class="hover:underline text-yellow-400 font-poppins">Ganti Password</a>
                        @endauth
                    </li>
                    <li><a href="/sewa-mobil" class="hover:underline text-yellow-400 font-poppins">Pemesanan Mobil</a>
                    </li>
                    <li>
                        <a href="https://wa.me/6285641748049" target="_blank"
                            class="hover:underline text-yellow-400 font-poppins">
                            Report via admin
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kolom 3 -->
            <div>
                <h3 class="text-lg font-bold mb-2 text-yellow-400 font-poppins">Developer</h3>
                <ul class="space-y-1">
                    <li><a href="https://www.instagram.com/ayakjugaisyah" target="_blank"
                            class="hover:underline text-yellow-400 font-poppins">@ayakjugaisyah</a></li>
                    <li><a href="https://www.instagram.com/alin_syariff" target="_blank"
                            class="hover:underline text-yellow-400 font-poppins">@alin__syariff</a></li>
                    <li><a href="https://www.instagram.com/zainnayaputri_" target="_blank"
                            class="hover:underline text-yellow-400 font-poppins">@zainnayaputri_</a></li>
                    <li><a href="https://www.instagram.com/elnzzah" target="_blank"
                            class="hover:underline text-yellow-400 font-poppins">@elnzzah</a></li>
                </ul>
            </div>
        </div>

        <!-- Garis pembatas -->
        <div class="border-t border-yellow-400 my-6"></div>

        <!-- Copyright -->
        <p class="text-center text-sm text-yellow-400 font-poppins">Copyright © {{ now()->format('Y') }} Payyed. All
            Right Reserved
        </p>
    </div>
</footer>

<script script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showLoginAlert() {
        Swal.fire({
            icon: 'warning',
            title: 'Maaf, anda harus login dulu.',
            showConfirmButton: true,
            confirmButtonText: 'OK',
        });
    }
</script>
