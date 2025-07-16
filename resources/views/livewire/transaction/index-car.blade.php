@php
    use App\Models\Transaction;
@endphp

<div class="py-10 px-4 md:px-20 bg-white">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($cars as $item)
            <div class="rounded-xl border-2 border-black shadow-md p-5 flex flex-col justify-between">
                <div>
                    <h2 class="text-center font-semibold text-lg mb-1">{{ $item->car_name }}</h2>
                    <p class="text-center text-gray-500 mb-3">Rp {{ number_format($item->price, 0, ',', '.') }}/ Hari</p>
                    <div class="flex justify-center mb-4">
                        <img src="{{ Storage::url($item->car_image) }}" alt="{{ $item->car_name }}"
                            class="w-4/5 h-36 object-contain">
                    </div>
                    <ul class="text-sm text-gray-700 list-disc pl-5 space-y-1">
                        <li>Jenis Transmisi: {{ $item->transmission_type }}</li>
                        <li>Jenis Penggerak: {{ $item->transmission_type_concept }}</li>
                        <li>Tenaga / Kapasitas Mesin: {{ $item->engine_capacity }}</li>
                        <li>Kapasitas Duduk: {{ $item->seat_capacity }} Kursi</li>
                        <li>Bahan Bakar: {{ $item->fuel_type }}</li>
                    </ul>
                </div>
                <div class="mt-5">
                    @auth
                        <button wire:click="openModal({{ $item->id }})"
                            class="bg-black text-white py-1 px-4 rounded hover:bg-gray-800 text-sm">
                            Sewa
                        </button>
                    @else
                        <button wire:click="openLoginAlert"
                            class="bg-black text-white py-1 px-4 rounded hover:bg-gray-800 text-sm">
                            Sewa
                        </button>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>

    {{-- Modal --}}
    @if ($modal && $selectedCar)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white w-full max-w-xl p-6 rounded-lg shadow-lg border-2 border-black">
                <div class="flex justify-between w-full">
                    <h2 class="text-xl font-semibold mb-4 text-yellow-700">Form Sewa Mobil</h2>
                    <button wire:click="closeModal"><i class="bi bi-x text-4xl"></i></button>
                </div>

                {{-- Info Mobil --}}
                <div class="mb-4 flex flex-col items-center">
                    <img src="{{ Storage::url($selectedCar->car_image) }}" alt="{{ $selectedCar->car_name }}"
                        class="w-48 h-32 object-contain rounded-lg border-2 border-yellow-400 bg-white shadow-md mb-2">

                    <h3 class="font-bold text-lg text-yellow-700">{{ $selectedCar->car_name }}</h3>
                    <p class="text-yellow-600 text-md mb-2">
                        Rp {{ number_format($selectedCar->price, 0, ',', '.') }}/Hari
                    </p>

                    <div x-data="{ showDetail: false }" class="w-full mt-2 text-sm text-gray-700">
                        <button type="button" @click="showDetail = !showDetail"
                            class="text-yellow-600 hover:underline text-xs mb-2">
                            <span x-text="showDetail ? 'Sembunyikan Detail' : 'Lihat Detail Mobil'"></span>
                        </button>

                        <ul x-show="showDetail" x-transition class="list-disc pl-5 space-y-1">
                            <li>Jenis Transmisi: {{ $selectedCar->transmission_type }}</li>
                            <li>Jenis Penggerak: {{ $selectedCar->transmission_type_concept }}</li>
                            <li>Tenaga / Kapasitas Mesin: {{ $selectedCar->engine_capacity }}</li>
                            <li>Kapasitas Duduk: {{ $selectedCar->seat_capacity }} Kursi</li>
                            <li>Bahan Bakar: {{ $selectedCar->fuel_type }}</li>
                        </ul>
                    </div>
                </div>


                {{-- Step 1 --}}
                @if ($step === 1)
                    <form wire:submit.prevent="nextStep" class="space-y-4">
                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label class="block text-sm font-medium text-yellow-900">Nama</label>
                                <input type="text" value="{{ Auth::user()->name ?? 'Anda Belum Login' }}" readonly
                                    class="w-full border px-3 py-2 rounded bg-gray-100 text-xs" />
                            </div>
                            <div class="w-1/2">
                                <label class="block text-sm font-medium text-yellow-900">Email</label>
                                <input type="email" value="{{ Auth::user()->email ?? 'Anda Belum Login' }}" readonly
                                    class="w-full border px-3 py-2 rounded bg-gray-100 text-xs" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-yellow-900">Alamat</label>
                            <input type="text" wire:model="address"
                                class="w-full border px-3 py-2 rounded border-yellow-300" />
                            @error('address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <select wire:model="duration" class="w-full border px-3 py-2 rounded border-yellow-300">
                                <option value="">-- Pilih Durasi Sewa --</option>
                                @foreach (Transaction::getDuration() as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                            @error('duration')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex justify-end pt-4 gap-4">
                            <button type="submit"
                                class="px-4 py-2 bg-yellow-500 text-yellow-900 rounded hover:bg-yellow-600">
                                Lanjut
                            </button>
                        </div>
                    </form>
                @endif

                {{-- Step 2 --}}
                @if ($step === 2)
                    <form wire:submit.prevent="store" enctype="multipart/form-data" class="space-y-4">
                        {{-- Informasi Pembayaran --}}
                        <div class="bg-yellow-50 border border-yellow-300 p-4 rounded">
                            <h3 class="text-md font-semibold text-yellow-900 mb-2">Detail Pembayaran</h3>
                            <p class="text-sm text-gray-800">
                                Harga Sewa / Hari: <strong>Rp
                                    {{ number_format($selectedCar->price, 0, ',', '.') }}</strong>
                            </p>
                            <p class="text-sm text-gray-800">
                                Durasi: <strong>{{ $duration }} Hari</strong>
                            </p>
                            <p class="text-sm text-gray-800">
                                <span>Total Pembayaran:</span>
                                <strong class="text-lg text-yellow-700">Rp
                                    {{ number_format($totalPayment, 0, ',', '.') }}</strong>
                            </p>

                            <div class="mt-4">
                                <label class="text-sm font-semibold text-yellow-900 block mb-1">Bank Transfer</label>
                                <div class="flex items-center gap-4 justify-center">
                                    <div class=" inline-flex items-center gap-2">
                                        <img src="{{ asset('img/bri.webp') }}" alt="VA" class="w-10">
                                        <h1 class="font-poppins font-semibold text-yellow-500 text-lg">
                                            {{ $virtualAccount }}</h1>
                                    </div>
                                    <button type="button"
                                        onclick="navigator.clipboard.writeText('{{ $virtualAccount }}').then(() => Swal.fire({
                                            icon: 'success',
                                            title: 'Disalin!',
                                            text: 'Nomor Virtual Account berhasil disalin ke clipboard.',
                                            timer: 2000,
                                            showConfirmButton: false
                                        }))"
                                        class="px-2 py-1 text-sm text-yellow-500">
                                        <i class="bi bi-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Upload Bukti Pembayaran --}}
                        <div>
                            <label class="block text-sm font-medium text-yellow-900">Upload Bukti Pembayaran</label>
                            <input type="file" wire:model="paymentImage"
                                class="w-full border px-3 py-2 rounded border-yellow-300" />
                            @error('paymentImage')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-between pt-4">
                            <button type="button" wire:click="backStep"
                                class="px-4 py-2 border border-yellow-400 rounded hover:bg-yellow-100 text-yellow-900">
                                Kembali
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-yellow-400 text-yellow-900 rounded hover:bg-yellow-500 font-semibold shadow">
                                Kirim
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    @endif

    {{-- Modal Alert Login --}}
    @if ($loginAlert)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white w-full max-w-sm p-6 rounded-lg shadow-lg text-center">
                <h2 class="text-xl font-bold text-red-600 mb-4">Anda Belum Login</h2>
                <p class="mb-6 text-gray-700">Silakan login atau daftar terlebih dahulu untuk menyewa mobil.</p>
                <div class="flex justify-center gap-4">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-white border border-yellow-400 text-black rounded hover:bg-gray-300">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-black text-yellow-400 rounded hover:bg-gray-800">Daftar</a>
                </div>
                <button wire:click="$set('loginAlert', false)"
                    class="mt-4 text-sm text-gray-500 hover:underline">Tutup</button>
            </div>
        </div>
    @endif

    {{-- Modal Proses Transaksi --}}
    @if ($processing)
        <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg text-center w-80 border-2 border-yellow-400 shadow-xl">
                <img src="{{ asset('img/notif.png') }}" class="mx-auto mb-4 w-24 h-24 object-contain"
                    alt="Notif">
                <p class="text-lg font-semibold text-gray-800 mb-1">Tunggu Sebentar, Proses Pembayaranmu</p>
                <p class="text-lg font-semibold text-gray-800 mb-4">Sedang Diproses</p>
                <div class="flex justify-center">
                    <div class="w-8 h-8 border-4 border-gray-300 border-t-yellow-500 rounded-full animate-spin"></div>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal Transaksi Berhasil --}}
    @if ($success && $latestTransaction)
        <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-xl text-left w-full max-w-md border border-gray-200 shadow-2xl">
                <div class="flex justify-center">
                    <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center mb-4">
                        <i class="bi bi-check2 text-3xl text-black"></i>
                    </div>
                </div>

                <h3 class="text-center text-lg font-semibold text-gray-800 mb-1">Pembayaran berhasil !</h3>
                <h2 class="text-center text-2xl font-bold text-black mb-4">
                    IDR {{ number_format($latestTransaction->total_payment, 0, ',', '.') }}
                </h2>

                <hr class="mb-4 border-gray-300">

                <div class="text-sm text-gray-700 space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Nomor Pemesanan</span>
                        <span class="font-medium">{{ $latestTransaction->noref }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Waktu Pembayaran</span>
                        <span 
                        class="font-medium">{{ \Carbon\Carbon::parse($latestTransaction->created_at)
                        ->setTimezone('Asia/Jakarta')
                        ->format('d-m-Y, H:i') }}</span>
                        </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Metode Pembayaran</span>
                        <span class="font-medium">Bank Transfer</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Nama Pemesan</span>
                        <span class="font-medium">{{ auth()->user()->name }}</span>
                    </div>
                </div>

                <hr class="my-4 border-dashed border-t border-gray-300">

                <div class="flex justify-between items-center text-base font-semibold">
                    <span>Total Harga</span>
                    <span>IDR {{ number_format($latestTransaction->total_payment, 0, ',', '.') }}</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">*Sudah termasuk PPN</p>

                <div class="mt-5 p-3 border border-yellow-400 rounded-lg bg-yellow-50">
                    <p class="text-sm font-semibold text-yellow-700 mb-2">Detail Mobil</p>
                    <ul class="text-sm text-gray-700 space-y-1 list-disc pl-4">
                        <li>Mobil: <strong>{{ $latestTransaction->car->car_name ?? '-' }}</strong></li>
                        <li>Transmisi: {{ $latestTransaction->car->transmission_type ?? '-' }}</li>
                        <li>Daya Mesin: {{ $latestTransaction->car->engine_capacity ?? '-' }}</li>
                        <li>Kapasitas: {{ $latestTransaction->car->seat_capacity ?? '-' }}</li>
                    </ul>
                </div>

                <div class="mt-6 text-center">
                    <button wire:click="resetAfterSuccess"
                        class="px-5 py-2 bg-yellow-500 text-white font-medium rounded hover:bg-yellow-600">
                        OK
                    </button>
                </div>
            </div>
        </div>
    @endif


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('start-processing', () => {
            setTimeout(() => {
                window.dispatchEvent(new CustomEvent('finishProcessing'))
            }, 2500);
        });
    </script>


</div>
