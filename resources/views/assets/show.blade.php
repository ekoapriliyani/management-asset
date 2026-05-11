<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Detail Asset
            </h2>

            <a href="{{ route('assets.index') }}"
                class="rounded-md bg-gray-600 px-4 py-2 text-xs font-semibold uppercase text-white hover:bg-gray-700">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-6xl space-y-6 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="rounded bg-green-100 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="rounded bg-red-100 px-4 py-3 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-3">

                    <div>
                        @if ($asset->photo)
                            <img src="{{ asset('storage/' . $asset->photo) }}"
                                class="w-full rounded border object-cover">
                        @else
                            <div class="flex h-48 items-center justify-center rounded bg-gray-100 text-gray-500">
                                Tidak ada foto
                            </div>
                        @endif
                    </div>

                    <div class="md:col-span-2">
                        <div class="mb-4 flex items-start justify-between">
                            <div>
                                <h3 class="text-2xl font-bold">
                                    {{ $asset->name }}
                                </h3>

                                <p class="text-gray-500">
                                    {{ $asset->asset_code }}
                                </p>
                            </div>

                            <span
                                class="@if ($asset->status === 'available') bg-green-100 text-green-800
                                @elseif($asset->status === 'in_use') bg-blue-100 text-blue-800
                                @elseif($asset->status === 'maintenance') bg-yellow-100 text-yellow-800
                                @elseif($asset->status === 'broken') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif rounded-full px-3 py-1 text-xs font-semibold">
                                {{ strtoupper(str_replace('_', ' ', $asset->status)) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
                            <p><b>Kategori:</b> {{ $asset->category->name ?? '-' }}</p>
                            <p><b>Lokasi:</b> {{ $asset->location->name ?? '-' }}</p>
                            <p><b>Brand:</b> {{ $asset->brand ?? '-' }}</p>
                            <p><b>Model:</b> {{ $asset->model ?? '-' }}</p>
                            <p><b>Serial Number:</b> {{ $asset->serial_number ?? '-' }}</p>
                            <p><b>Tanggal Beli:</b> {{ $asset->purchase_date ?? '-' }}</p>
                            <p><b>Harga Beli:</b> Rp {{ number_format($asset->purchase_price ?? 0, 0, ',', '.') }}</p>
                        </div>

                        <div class="mt-5">
                            <b>Deskripsi:</b>
                            <p class="mt-1 text-gray-700">
                                {{ $asset->description ?? '-' }}
                            </p>
                        </div>

                        <div class="mt-6 flex gap-2">
                            <a href="{{ route('assets.qrcode', $asset->id) }}" target="_blank"
                                class="rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-900">
                                QR Code
                            </a>

                            <a href="{{ route('assets.edit', $asset->id) }}"
                                class="rounded bg-yellow-500 px-4 py-2 text-white hover:bg-yellow-600">
                                Edit Asset
                            </a>

                            @if ($asset->status === 'available')
                                <a href="{{ route('assets.assign.create', $asset->id) }}"
                                    class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                                    Assign / Pakai Asset
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            @if ($asset->activeAssignment)
                <div class="rounded-lg border border-blue-200 bg-blue-50 p-6">
                    <h3 class="mb-3 text-lg font-semibold text-blue-800">
                        Sedang Dipakai
                    </h3>

                    <div class="grid grid-cols-1 gap-3 text-sm md:grid-cols-2">
                        <p><b>Nama Pemakai:</b> {{ $asset->activeAssignment->employee_name }}</p>
                        <p><b>NIK:</b> {{ $asset->activeAssignment->employee_number ?? '-' }}</p>
                        <p><b>Departemen:</b> {{ $asset->activeAssignment->department ?? '-' }}</p>
                        <p><b>Lokasi:</b> {{ $asset->activeAssignment->location->name ?? '-' }}</p>
                        <p><b>Tanggal Pakai:</b> {{ $asset->activeAssignment->assigned_date }}</p>
                        <p><b>Catatan:</b> {{ $asset->activeAssignment->notes ?? '-' }}</p>
                    </div>

                    <form action="{{ route('asset-assignments.return', $asset->activeAssignment->id) }}" method="POST"
                        class="mt-5 grid grid-cols-1 items-end gap-3 md:grid-cols-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Tanggal Kembali
                            </label>
                            <input type="date" name="returned_date" value="{{ date('Y-m-d') }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Kondisi Setelah Kembali
                            </label>
                            <select name="condition" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="available">Baik / Tersedia</option>
                                <option value="maintenance">Butuh Maintenance</option>
                                <option value="broken">Rusak</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Catatan Return
                            </label>
                            <input type="text" name="notes" placeholder="Opsional"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <button type="submit" onclick="return confirm('Yakin asset sudah dikembalikan?')"
                            class="rounded bg-green-600 px-4 py-2 text-white hover:bg-green-700">
                            Return Asset
                        </button>
                    </form>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold">
                        Riwayat Pemakaian Asset
                    </h3>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Pemakai</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Departemen
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Lokasi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Tanggal
                                    Pakai</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Tanggal
                                    Kembali</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($asset->assignments as $assignment)
                                <tr>
                                    <td class="px-4 py-3">
                                        {{ $assignment->employee_name }}
                                        <br>
                                        <span class="text-xs text-gray-500">
                                            {{ $assignment->employee_number ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">{{ $assignment->department ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $assignment->location->name ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $assignment->assigned_date }}</td>
                                    <td class="px-4 py-3">{{ $assignment->returned_date ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="@if ($assignment->status === 'active') bg-blue-100 text-blue-800
                                            @else bg-gray-100 text-gray-800 @endif rounded px-2 py-1 text-xs">
                                            {{ strtoupper($assignment->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                        Belum ada riwayat pemakaian asset.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
