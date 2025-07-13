<div>
    @include('layouts.navbar')
    <div class="min-h-screen bg-white dark:bg-gray-900 p-6 flex justify-center items-center">
        <div class="grid grid-cols-1 md:grid-cols-4 max-w-7xl mx-auto gap-6 md:py-32">
            <!-- Navigasi Samping -->
            <div class="col-span-1 bg-white shadow border rounded-2xl p-4 flex flex-col justify-between">
                <div>
                    <p class="font-semibold text-lg mb-4">Navigasi Profile</p>

                    <!-- Menu Aktif -->
                    <button wire:click="showTab('profile')"
                        class="flex items-center space-x-2 w-full px-4 py-2 rounded-md font-semibold text-black mb-2 {{ $activeTab === 'profile' ? 'bg-yellow-400' : 'hover:bg-gray-100' }}">
                        <i class="bi bi-person-badge-fill"></i>
                        <span>Informasi Pribadi Saya</span>
                    </button>
                    <button wire:click="showTab('transactions')"
                        class="flex items-center w-full space-x-2 px-4 py-2 rounded-md font-semibold text-black mb-2 {{ $activeTab === 'transactions' ? 'bg-yellow-400' : 'hover:bg-gray-100' }}">
                        <i class="bi bi-hourglass-top"></i>
                        <span>Riwayat Transaksi</span>
                    </button>

                    <!-- Logout -->
                    <button wire:click="logout"
                        class="flex items-center space-x-2 text-red-600 font-semibold px-4 py-2 hover:bg-red-100 rounded-md w-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </div>

                <a href="/"
                    class="mt-4 inline-block text-center font-semibold rounded-full border border-black py-2 px-4 hover:bg-gray-100 shadow-[4px_4px_0_#000]">
                    Kembali ke Halaman Utama
                </a>
            </div>

            <!-- Konten Informasi Profile -->
            <div class="col-span-1 md:col-span-3 bg-white shadow rounded-2xl p-8">
                @if ($activeTab === 'profile')
                    <div class="flex items-center justify-between flex-wrap gap-4 mb-8">
                        <div>
                            <h2 class="text-xl md:text-2xl font-bold text-black">Selamat Datang, {{ $name }}
                            </h2>
                            <p class="text-gray-500 mt-1">Informasi mengenai profil anda ada disini !</p>
                        </div>

                        {{-- Foto Profil --}}
                        <div class="relative w-20 h-20">
                            {{-- Foto Profil --}}
                            <img src="{{ Auth::user()->profile_image
                                ? asset('storage/' . Auth::user()->profile_image)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($name) }}"
                                alt="Foto Profil"
                                class="w-20 h-20 rounded-full object-cover border-2 border-black shadow-md" />

                            {{-- Icon Pensil di Atas Foto --}}
                            @if ($isEditing)
                                <label for="photo-upload"
                                    class="absolute bottom-0 right-0 bg-black text-white p-1 rounded-full cursor-pointer hover:bg-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.232 5.232l3.536 3.536M9 13l6.536-6.536a2 2 0 112.828 2.828L11.828 16H9v-2.828z" />
                                    </svg>
                                </label>
                            @endif

                            {{-- Input File Hidden --}}
                            <input id="photo-upload" type="file" wire:model="photo" class="hidden" />
                        </div>
                    </div>

                    @if (session()->has('message'))
                        <div class="mb-4 text-green-600 font-semibold">{{ session('message') }}</div>
                    @endif

                    <div class="space-y-6">
                        <div>
                            <label class="block font-bold text-sm mb-1">Nama Lengkap</label>
                            <input type="text" wire:model.defer="name" {{ $isEditing ? '' : 'readonly' }}
                                class="w-full border rounded-lg px-4 py-2 {{ $isEditing ? 'bg-white text-black' : 'bg-gray-100 text-gray-500 cursor-not-allowed border-none' }}" />
                        </div>
                        <div>
                            <label class="block font-bold text-sm mb-1">Email</label>
                            <input type="text" wire:model.defer="email" {{ $isEditing ? '' : 'readonly' }}
                                class="w-full border rounded-lg px-4 py-2 {{ $isEditing ? 'bg-white text-black' : 'bg-gray-100 text-gray-500 cursor-not-allowed border-none' }}" />
                        </div>
                        <div>
                            <label class="block font-bold text-sm mb-1">Nomor Handphone</label>
                            <input type="text" wire:model.defer="phone" {{ $isEditing ? '' : 'readonly' }}
                                class="w-full border rounded-lg px-4 py-2 {{ $isEditing ? 'bg-white text-black' : 'bg-gray-100 text-gray-500 cursor-not-allowed border-none' }}" />
                        </div>
                        @if ($isEditing)
                            {{-- Password Baru --}}
                            <div x-data="{ show: false }">
                                <label class="block font-bold text-sm mb-1">Password Baru <span
                                        class="text-gray-400 text-xs">(Opsional)</span></label>
                                <div class="relative">
                                    <input :type="show ? 'text' : 'password'" wire:model.defer="new_password"
                                        class="w-full border rounded-lg px-4 py-2 pr-10 bg-white text-black" />
                                    <button type="button" @click="show = !show"
                                        class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.967 9.967 0 012.514-4.128m3.328-2.366A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.963 9.963 0 01-4.38 5.302M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                                @error('new_password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                    </div>

                    <div class="mt-6">
                        @if ($isEditing)
                            <button wire:click="save"
                                class="bg-black text-white px-4 py-2 rounded-md font-semibold hover:bg-gray-800 transition">
                                Simpan
                            </button>
                        @else
                            <button wire:click="enableEdit"
                                class="bg-yellow-400 text-black px-4 py-2 rounded-md font-semibold hover:bg-yellow-500 transition">
                                Edit Profil
                            </button>
                        @endif
                    </div>
                @elseif ($activeTab === 'transactions')
                    {{-- KONTEN TRANSAKSI --}}
                    <h2 class="text-2xl font-bold mb-4">Riwayat Transaksi</h2>

                    @if ($transactions->isEmpty())
                        <p class="text-gray-500">Belum ada transaksi.</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($transactions as $trx)
                                <div class="border border-gray-200 rounded-lg p-4 shadow">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">
                                                {{ $trx->created_at->format('d M Y H:i') }}</p>
                                            <p class="font-semibold text-lg">{{ $trx->car->car_name }}</p>
                                            <p>Durasi: {{ $trx->duration }} Hari</p>
                                            <p>Total: Rp {{ number_format($trx->total_payment, 0, ',', '.') }}</p>
                                            <p>No Ref: <span
                                                    class="text-yellow-700 font-semibold">{{ $trx->noref }}</span>
                                            </p>
                                            <div>Status:
                                                @if ($trx->status === 'pending')
                                                    <span
                                                        class="inline-block px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                                        Menunggu Verifikasi
                                                    </span>
                                                @elseif ($trx->status === 'rejected')
                                                    <span
                                                        class="inline-block px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                                        Ditolak
                                                    </span>
                                                @elseif ($trx->status === 'approved')
                                                    <span
                                                        class="inline-block px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                        Telah Diverifikasi
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            @if ($trx->status !== 'pending' && $trx->status !== 'rejected')
                                                <a href="{{ route('transactions.print', $trx->id) }}" target="_blank"
                                                    class="inline-block px-4 py-2 bg-black text-white text-sm rounded hover:bg-gray-800">
                                                    Cetak Bukti Pembayaran
                                                </a>
                                            @else
                                                <span
                                                    class="inline-block px-4 py-2 bg-gray-300 text-gray-600 text-sm rounded cursor-not-allowed"
                                                    title="Bukti hanya tersedia setelah pembayaran dikonfirmasi.">
                                                    Cetak Bukti Pembayaran
                                                </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
</div>
