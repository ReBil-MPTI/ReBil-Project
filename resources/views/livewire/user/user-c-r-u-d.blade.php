<div class="p-4">
    {{-- Flash Message --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('message') }}
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
        <div class="flex flex-col md:flex-row md:items-center gap-3 mb-4 mt-2">
            {{-- <input type="text" wire:model.live.debounce.300ms="searchName"
                class="w-full md:w-64 border px-4 py-2 rounded bg-gray-50" placeholder="Cari nama mobil..." />

            <select wire:model.live="filterYear" class="w-full md:w-48 border px-4 py-2 rounded bg-gray-50">
                <option value="">Semua Tahun</option>
                @foreach ($availableYears as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select> --}}


            <button wire:click="modalVisible" class="bg-white border px-4 py-2 rounded hover:bg-gray-100">
                Tambah User
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded overflow-hidden border border-gray-200">
            <thead class="bg-gray-50 text-gray-400 text-left text-sm">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama User</th>
                    <th class="px-6 py-3">Email User</th>
                    <th class="px-6 py-3">Foto User</th>
                    <th class="px-6 py-3">Hak Akses</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm" id="car-gallery">
                @forelse ($users as $index => $user)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4">{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ $user->profile_image ? Storage::url($user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&size=160' }}"
                                target="_blank" class="user-gallery-item" data-lg-size="1600-1067">
                                <img src="{{ $user->profile_image ? Storage::url($user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&size=160' }}"
                                    alt="{{ $user->name }}"
                                    class="h-12 w-12 object-cover rounded-full hover:scale-105 transition" />
                            </a>
                        </td>
                        <td class="px-6 py-4">{{ $user->roles->pluck('name')->first() }}</td>
                        <td class="px-6 py-4">
                            <button
                                class="bg-green-200 text-green-800 px-4 py-1 rounded-full text-xs hover:bg-green-300"
                                wire:click="edit({{ $user->id }})">Edit</button>

                            <button class="bg-red-200 text-red-800 px-4 py-1 rounded-full text-xs ml-2 hover:bg-red-300"
                                wire:click="confirmDelete({{ $user->id }})">
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
        {{ $users->links() }}
    </div>

    @if ($modalVisibleForm)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
            <div class="bg-white w-full max-w-xl rounded-2xl shadow-lg p-8 max-h-[90vh] overflow-y-auto">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">
                    {{ $modalEdit ? 'Edit User' : 'Tambah User' }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Lengkap</label>
                        <input type="text" wire:model.defer="fullname"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600"
                            placeholder="Nama Lengkap" />
                        @error('fullname')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Email</label>
                        <input type="email" wire:model.defer="email"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600"
                            placeholder="Alamat Email" />
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Password</label>
                        <input type="password" wire:model.defer="password"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600"
                            placeholder="Password" />
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Konfirmasi Password</label>
                        <input type="password" wire:model.defer="password_confirmation"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600"
                            placeholder="Konfirmasi Password" />
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Peran</label>
                        <select wire:model.defer="roleId"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600">
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                        @error('roleId')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Foto User</label>
                        <input type="file" wire:model="userImage"
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600" />

                        @error('userImage')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        @if ($userImage)
                            <div class="mt-2">
                                <img src="{{ $userImage->temporaryUrl() }}" class="h-32 rounded shadow" />
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button wire:click="$set('modalVisibleForm', false)"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">Batal</button>

                    @if ($modalEdit)
                        <button wire:click="update"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">Update</button>
                    @else
                        <button wire:click="createUser"
                            class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">Simpan</button>
                    @endif
                </div>
            </div>
        </div>
    @endif


    {{-- Modal Konfirmasi Delete --}}
    @if ($modaldelete)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Konfirmasi Hapus</h3>
                <p class="text-gray-600 mb-6">Apakah kamu yakin ingin menghapus mobil ini?</p>

                <div class="flex justify-end space-x-3">
                    <button wire:click="$set('modaldelete', false)"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Batal
                    </button>
                    <button wire:click="deleteUser" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
<script>
    window.livewire = window.livewire || {};
    window.livewire.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
</script>

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
