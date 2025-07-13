@extends('pages.second-header')

@section('content')
    <div class="py-10 px-4 md:px-20 bg-white">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($cars as $item)
                <div class="rounded-xl border-2 border-black shadow-md p-5 flex flex-col justify-between">
                    {{-- Nama dan Harga --}}
                    <div>
                        <h2 class="text-center font-semibold text-lg mb-1">{{ $item->car_name }}</h2>
                        <p class="text-center text-gray-500 mb-3">Rp {{ number_format($item->price, 0, ',', '.') }}/ Hari</p>

                        {{-- Gambar Mobil --}}
                        <div class="flex justify-center mb-4">
                            <img src="{{ Storage::url($item->car_image) }}" alt="{{ $item->car_name }}"
                                class="w-4/5 h-36 object-contain">
                        </div>

                        {{-- Detail Spesifikasi --}}
                        <ul class="text-sm text-gray-700 list-disc pl-5 space-y-1">
                            <li>Jenis Transmisi: {{ $item->transmission_type }}</li>
                            <li>Jenis Penggerak: {{ $item->transmission_type_concept }}</li>
                            <li>Tenaga / Kapasitas Mesin: {{ $item->engine_capacity }}</li>
                            <li>Kapasitas Duduk: {{ $item->seat_capacity }} Kursi</li>
                            <li>Bahan Bakar: {{ $item->fuel_type }}</li>
                        </ul>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mt-4 flex justify-between items-center">
                        <a href="#" class="bg-black text-white py-1 px-4 rounded hover:bg-gray-800 text-sm">Sewa</a>
                        <button class="text-xl text-gray-500 hover:text-black">
                            <i class="bi bi-star"></i> {{-- Gunakan Bootstrap Icons --}}
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
