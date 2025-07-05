<div class="p-4">
    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold flex items-center">Daftar Mobil</h2>
        <div class="flex flex-col md:flex-row md:items-center gap-3 mb-4 mt-2">
            {{-- Input pencarian nama --}}
            <input type="text" wire:model.live.debounce.300ms="searchName"
                class="w-full md:w-64 border px-4 py-2 rounded bg-gray-50" placeholder="Cari nama mobil..." />

            {{-- Filter tahun --}}
            <select wire:model.live="filterYear" class="w-full md:w-48 border px-4 py-2 rounded bg-gray-50">
                <option value="">Semua Tahun</option>
                @foreach ($availableYears as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>


            <button wire:click="showModalForm" class="bg-white border px-4 py-2 rounded hover:bg-gray-100">
                Tambah Mobil
            </button>
        </div>
    </div>

    {{-- Tabel Mobil --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded overflow-hidden border border-gray-200">
            <thead class="bg-gray-50 text-gray-400 text-left text-sm">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Tipe Mobil</th>
                    <th class="px-6 py-3">Nama Mobil</th>
                    <th class="px-6 py-3">Foto Mobil</th>
                    <th class="px-6 py-3">Plat</th>
                    <th class="px-6 py-3">Tahun</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm" id="car-gallery">
                @forelse ($cars as $index => $mobil)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4">{{ ($cars->currentPage() - 1) * $cars->perPage() + $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $mobil->carType->type_name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $mobil->car_name }}</td>
                        <td class="px-6 py-4">
                            @if ($mobil->car_image)
                                <a href="{{ Storage::url($mobil->car_image) }}" target="_blank" class="car-gallery-item"
                                    data-lg-size="1600-1067">
                                    <img src="{{ Storage::url($mobil->car_image) }}" alt="{{ $mobil->car_name }}"
                                        class="h-12 w-20 object-cover cursor-pointer rounded hover:scale-105 transition" />
                                </a>
                            @else
                                <span class="text-gray-400 italic">No Image</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $mobil->police_number }}</td>
                        <td class="px-6 py-4">{{ $mobil->year }}</td>
                        <td class="px-6 py-4">
                            <button
                                class="bg-green-200 text-green-800 px-4 py-1 rounded-full text-xs hover:bg-green-300"
                                wire:click="edit({{ $mobil->id }})">Edit</button>

                            <button class="bg-red-200 text-red-800 px-4 py-1 rounded-full text-xs ml-2 hover:bg-red-300"
                                wire:click="confirmDelete({{ $mobil->id }})">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            @if ($searchName || $filterYear)
                                Tidak ada data mobil yang sesuai dengan pencarian.
                            @else
                                Belum ada data mobil.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $cars->links() }}
    </div>

    {{-- Modal Form --}}
    @if ($modalVisibleForm)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
            <div class="bg-white w-full max-w-xl rounded-2xl shadow-lg p-8 max-h-[90vh] overflow-y-auto">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">
                    {{ $modalEdit ? 'Edit Mobil' : 'Tambah Mobil' }}
                </h2>

                {{-- Display validation errors --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Mobil</label>
                        <input type="text" wire:model.defer="carName"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600"
                            placeholder="BMW M4 Competition" />
                        @error('carName')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Tipe Mobil</label>
                        <select wire:model.defer="carTypeId"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600">
                            <option value="">Pilih Tipe</option>
                            @foreach ($carTypes as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->type_name }}</option>
                            @endforeach
                        </select>
                        @error('carTypeId')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Gambar Mobil</label>
                        <input type="file" wire:model="carImage"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600" />

                        @error('carImage')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        @if ($carImage)
                            <div class="mt-2">
                                <img src="{{ $carImage->temporaryUrl() }}" class="h-32 rounded shadow" />
                            </div>
                        @endif
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Plat Nomor</label>
                        <input type="text" wire:model.defer="policeNumber"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600"
                            placeholder="B 1234 ABC" />
                        @error('policeNumber')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Tahun</label>
                        <input type="number" wire:model.defer="carYear"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600" placeholder="2025"
                            min="1900" max="{{ date('Y') + 1 }}" />
                        @error('carYear')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button wire:click="$set('modalVisibleForm', false)"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">Batal</button>

                    @if ($modalEdit)
                        <button wire:click="update"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">Update</button>
                    @else
                        <button wire:click="store"
                            class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">Simpan</button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Modal Konfirmasi Delete --}}
    @if ($confirmingDelete)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Konfirmasi Hapus</h3>
                <p class="text-gray-600 mb-6">Apakah kamu yakin ingin menghapus mobil ini?</p>

                <div class="flex justify-end space-x-3">
                    <button wire:click="$set('confirmingDelete', false)"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Batal
                    </button>
                    <button wire:click="deleteMobil" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/thumbnail/lg-thumbnail.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lightGallery(document.getElementById('car-gallery'), {
                selector: '.car-gallery-item',
                thumbnail: true,
                zoom: true,
            });
        });
    </script>
@endpush
