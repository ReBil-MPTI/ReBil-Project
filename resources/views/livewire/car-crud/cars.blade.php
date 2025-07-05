<div class="p-4">
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Daftar Mobil</h2>
        <button wire:click="showModalForm" class="bg-white border px-4 py-2 rounded hover:bg-gray-100">
            Tambah Mobil
        </button>
    </div>

    <table class="min-w-full bg-white rounded overflow-hidden border border-gray-200">
        <thead class="bg-gray-50 text-gray-400 text-left text-sm">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Tipe Mobil</th>
                <th class="px-6 py-3">Nama Mobil</th>
                <th class="px-6 py-3">Plat</th>
                <th class="px-6 py-3">Tahun</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
            @forelse ($cars as $index => $mobil)
                <tr class="border-t border-gray-200">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">{{ $mobil->carType->type_name ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $mobil->car_name }}</td>
                    <td class="px-6 py-4">{{ $mobil->police_number }}</td>
                    <td class="px-6 py-4">{{ $mobil->year }}</td>
                    <td class="px-6 py-4">
                        <button class="bg-green-200 text-green-800 px-4 py-1 rounded-full text-xs">Edit</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data mobil.</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    @if ($modalVisibleForm)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
            <div class="bg-white w-full max-w-xl rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Mobil</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Mobil</label>
                        <input type="text" wire:model.defer="carName"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600"
                            placeholder="BMW M4 Competition" />
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
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Plat</label>
                        <input type="text" wire:model.defer="policeNumber"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600" placeholder="0101" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Tahun</label>
                        <input type="text" wire:model.defer="carYear"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600" placeholder="2025" />
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button wire:click="$set('modalVisibleForm', false)"
                        class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg">Batal</button>
                    <button wire:click="store"
                        class="bg-green-400 hover:bg-green-500 text-white px-6 py-2 rounded-lg">Simpan</button>
                </div>
            </div>
        </div>
    @endif

</div>
