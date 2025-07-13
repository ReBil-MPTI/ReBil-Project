<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Pemesanan') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <h1 class="text-2xl font-bold mb-4">Daftar Pemesanan Mobil</h1>

        @if (session()->has('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded border border-gray-200">
                <thead class="bg-gray-50 text-gray-500 text-sm">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama Penyewa</th>
                        <th class="px-4 py-2">Kontak</th>
                        <th class="px-4 py-2">Mobil</th>
                        <th class="px-4 py-2">Durasi</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @forelse ($transactions as $index => $item)
                        <tr class="border-t">
                            <td class="px-4 py-2">
                                {{ ($transactions->currentPage() - 1) * $transactions->perPage() + $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $item->user->name }}</td>
                            <td class="px-4 py-2">
                                <ul>
                                    <li>{{ $item->user->email }}</li>
                                    <li>{{ $item->user->phone_number ?? '-' }}</li>
                                </ul>
                            </td>
                            <td class="px-4 py-2">{{ $item->car->car_name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->duration }} hari</td>
                            <td class="px-4 py-2">Rp {{ number_format($item->total_payment, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                @php
                                    $badge = match ($item->status) {
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-600',
                                    };
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $badge }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <button wire:click="showDetail({{ $item->id }})"
                                    class="bg-primary  text-white px-3 py-1 rounded text-sm">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center px-4 py-4 text-gray-400">Belum ada transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL DETAIL --}}
    @if ($modalVisible)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-xl">
                <h2 class="text-xl font-bold mb-4">Detail Transaksi</h2>

                @if ($selectedTransaction)
                    <div class="space-y-2 text-sm text-gray-700">
                        <p><strong>Nama:</strong> {{ $selectedTransaction->user->name }}</p>
                        <p><strong>Email:</strong> {{ $selectedTransaction->user->email }}</p>
                        <p><strong>Telepon:</strong> {{ $selectedTransaction->user->phone_number ?? '-' }}</p>
                        <hr>
                        <p><strong>Mobil:</strong> {{ $selectedTransaction->car->car_name }}</p>
                        <p><strong>Durasi:</strong> {{ $selectedTransaction->duration }} hari</p>
                        <p><strong>Total:</strong> Rp
                            {{ number_format($selectedTransaction->total_payment, 0, ',', '.') }}</p>
                        <p><strong>Status:</strong>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full
                                {{ $selectedTransaction->status === 'pending'
                                    ? 'bg-yellow-100 text-yellow-800'
                                    : ($selectedTransaction->status === 'approved'
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($selectedTransaction->status) }}
                            </span>
                        </p>
                        <p><strong>Bukti Pembayaran:</strong></p>
                        @if ($selectedTransaction->payment_image)
                            <a data-fancybox="gallery" href="{{ Storage::url($selectedTransaction->payment_image) }}">
                                <img src="{{ Storage::url($selectedTransaction->payment_image) }}"
                                    alt="Bukti Pembayaran"
                                    class="w-32 h-auto rounded shadow hover:scale-105 transition duration-200 cursor-pointer">
                            </a>
                        @else
                            <p class="text-sm italic text-gray-400">Belum diunggah</p>
                        @endif
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <button wire:click="$set('modalVisible', false)"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                            Tutup
                        </button>

                        @if ($selectedTransaction->status === 'pending')
                            <button wire:click="approveSelected"
                                class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                Setujui
                            </button>

                            <button wire:click="rejectSelected"
                                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                Tolak
                            </button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    @endif

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
    @endpush

</div>
