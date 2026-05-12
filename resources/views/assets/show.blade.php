<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Detail Asset
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Informasi lengkap dan histori penggunaan asset perusahaan.
                </p>
            </div>

            <a href="{{ route('assets.index') }}"
                class="inline-flex items-center rounded-xl bg-gray-700 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-gray-800">
                Kembali
            </a>

        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div
                    class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800 shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                <div class="grid grid-cols-1 gap-8 p-8 lg:grid-cols-3">

                    <div>

                        <div class="overflow-hidden rounded-2xl bg-gray-100 ring-1 ring-gray-200">

                            @if ($asset->photo)
                                <img src="{{ asset('storage/' . $asset->photo) }}"
                                    class="h-[320px] w-full object-cover">
                            @else
                                <div class="flex h-[320px] items-center justify-center text-6xl text-gray-400">
                                    📦
                                </div>
                            @endif

                        </div>

                        <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-3">

                            <a href="{{ route('assets.qrcode', $asset->id) }}" target="_blank"
                                class="inline-flex items-center justify-center rounded-xl bg-gray-800 px-4 py-3 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-gray-900">
                                QR Code
                            </a>

                            <a href="{{ route('assets.edit', $asset->id) }}"
                                class="inline-flex items-center justify-center rounded-xl bg-yellow-500 px-4 py-3 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-yellow-600">
                                Edit Asset
                            </a>

                            <a href="{{ route('asset-maintenances.create', $asset->id) }}"
                                class="inline-flex items-center justify-center rounded-xl bg-orange-600 px-4 py-3 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-orange-700">
                                Maintenance
                            </a>

                        </div>

                        @if ($asset->status === 'available')
                            <a href="{{ route('assets.assign.create', $asset->id) }}"
                                class="mt-3 inline-flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-3 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-indigo-700">
                                Assign / Pakai Asset
                            </a>
                        @endif

                    </div>

                    <div class="lg:col-span-2">

                        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">

                            <div>
                                <h3 class="text-3xl font-bold text-gray-800">
                                    {{ $asset->name }}
                                </h3>

                                <p class="mt-2 text-sm text-gray-500">
                                    Asset Code: {{ $asset->asset_code }}
                                </p>

                                @if ($asset->serial_number)
                                    <p class="mt-1 text-sm text-gray-400">
                                        Serial Number: {{ $asset->serial_number }}
                                    </p>
                                @endif
                            </div>

                            <div>

                                @if ($asset->status === 'available')
                                    <span
                                        class="inline-flex rounded-full bg-green-100 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-green-700">
                                        Available
                                    </span>
                                @elseif($asset->status === 'in_use')
                                    <span
                                        class="inline-flex rounded-full bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-blue-700">
                                        In Use
                                    </span>
                                @elseif($asset->status === 'maintenance')
                                    <span
                                        class="inline-flex rounded-full bg-yellow-100 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-yellow-700">
                                        Maintenance
                                    </span>
                                @elseif($asset->status === 'broken')
                                    <span
                                        class="inline-flex rounded-full bg-red-100 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-red-700">
                                        Broken
                                    </span>
                                @else
                                    <span
                                        class="inline-flex rounded-full bg-gray-100 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-700">
                                        Disposed
                                    </span>
                                @endif

                            </div>

                        </div>

                        <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-2">

                            <div class="rounded-2xl bg-gray-50 p-5 ring-1 ring-gray-100">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Kategori
                                </p>

                                <p class="mt-2 text-base font-semibold text-gray-800">
                                    {{ $asset->category->name ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-gray-50 p-5 ring-1 ring-gray-100">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Lokasi
                                </p>

                                <p class="mt-2 text-base font-semibold text-gray-800">
                                    {{ $asset->location->name ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-gray-50 p-5 ring-1 ring-gray-100">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Brand & Model
                                </p>

                                <p class="mt-2 text-base font-semibold text-gray-800">
                                    {{ $asset->brand ?? '-' }}
                                    {{ $asset->model ?? '' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-gray-50 p-5 ring-1 ring-gray-100">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Harga Beli
                                </p>

                                <p class="mt-2 text-base font-semibold text-gray-800">
                                    Rp {{ number_format($asset->purchase_price ?? 0, 0, ',', '.') }}
                                </p>
                            </div>

                        </div>

                        <div class="mt-8 rounded-2xl bg-gray-50 p-6 ring-1 ring-gray-100">

                            <h4 class="text-sm font-semibold uppercase tracking-wider text-gray-500">
                                Deskripsi Asset
                            </h4>

                            <p class="mt-3 text-sm leading-relaxed text-gray-700">
                                {{ $asset->description ?: 'Tidak ada deskripsi asset.' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            @if ($asset->activeAssignment)
                <div class="overflow-hidden rounded-2xl border border-blue-200 bg-blue-50 shadow-sm">

                    <div class="border-b border-blue-200 px-6 py-4">
                        <h3 class="text-lg font-semibold text-blue-800">
                            Asset Sedang Dipakai
                        </h3>

                        <p class="mt-1 text-sm text-blue-600">
                            Informasi penggunaan asset saat ini.
                        </p>
                    </div>

                    <div class="p-6">

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                            <div class="rounded-xl bg-white p-4 shadow-sm">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Pemakai
                                </p>

                                <p class="mt-2 font-semibold text-gray-800">
                                    {{ $asset->activeAssignment->employee_name }}
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $asset->activeAssignment->employee_number ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-white p-4 shadow-sm">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Departemen
                                </p>

                                <p class="mt-2 font-semibold text-gray-800">
                                    {{ $asset->activeAssignment->department ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-white p-4 shadow-sm">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Lokasi
                                </p>

                                <p class="mt-2 font-semibold text-gray-800">
                                    {{ $asset->activeAssignment->location->name ?? '-' }}
                                </p>
                            </div>

                        </div>

                        <form action="{{ route('asset-assignments.return', $asset->activeAssignment->id) }}"
                            method="POST" class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-gray-700">
                                    Tanggal Kembali
                                </label>

                                <input type="date" name="returned_date" value="{{ date('Y-m-d') }}"
                                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-gray-700">
                                    Kondisi Asset
                                </label>

                                <select name="condition"
                                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="available">Baik / Available</option>
                                    <option value="maintenance">Maintenance</option>
                                    <option value="broken">Broken</option>
                                </select>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-gray-700">
                                    Catatan Return
                                </label>

                                <input type="text" name="notes" placeholder="Opsional"
                                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div class="flex items-end">
                                <button type="submit" onclick="return confirm('Yakin asset sudah dikembalikan?')"
                                    class="inline-flex w-full items-center justify-center rounded-xl bg-green-600 px-4 py-3 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-green-700">
                                    Return Asset
                                </button>
                            </div>

                        </form>

                    </div>

                </div>
            @endif

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                <div class="border-b border-gray-200 px-6 py-5">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Riwayat Pemakaian Asset
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Histori penggunaan dan perpindahan asset.
                    </p>
                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Pemakai
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Departemen
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Lokasi
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Tanggal Pakai
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Tanggal Return
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Status
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">

                            @forelse($asset->assignments as $assignment)
                                <tr class="transition hover:bg-gray-50">

                                    <td class="px-6 py-4">

                                        <div>
                                            <p class="font-semibold text-gray-800">
                                                {{ $assignment->employee_name }}
                                            </p>

                                            <p class="mt-1 text-xs text-gray-500">
                                                {{ $assignment->employee_number ?? '-' }}
                                            </p>
                                        </div>

                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $assignment->department ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $assignment->location->name ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $assignment->assigned_date }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $assignment->returned_date ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">

                                        @if ($assignment->status === 'active')
                                            <span
                                                class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                                ACTIVE
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                                RETURNED
                                            </span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">

                                        <div class="mx-auto max-w-sm">

                                            <div
                                                class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-2xl text-gray-500">
                                                📋
                                            </div>

                                            <h3 class="text-sm font-semibold text-gray-800">
                                                Belum ada riwayat pemakaian
                                            </h3>

                                            <p class="mt-1 text-sm text-gray-500">
                                                Asset ini belum pernah digunakan.
                                            </p>

                                        </div>

                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                <div class="border-b border-gray-200 px-6 py-5">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Riwayat Maintenance
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Catatan perawatan, perbaikan, dan jadwal maintenance asset.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Tanggal
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Jenis
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Teknisi
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Biaya
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Next Maintenance
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Status
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($asset->maintenances as $maintenance)
                                <tr class="transition hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $maintenance->maintenance_date }}
                                    </td>

                                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">
                                        {{ strtoupper(str_replace('_', ' ', $maintenance->maintenance_type)) }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $maintenance->technician_name ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        Rp {{ number_format($maintenance->cost ?? 0, 0, ',', '.') }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $maintenance->next_maintenance_date ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($maintenance->status === 'scheduled')
                                            <span
                                                class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                                SCHEDULED
                                            </span>
                                        @elseif($maintenance->status === 'in_progress')
                                            <span
                                                class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                                IN PROGRESS
                                            </span>
                                        @else
                                            <span
                                                class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                COMPLETED
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('asset-maintenances.edit', $maintenance->id) }}"
                                                class="rounded-lg bg-yellow-500 px-3 py-2 text-xs font-semibold text-white hover:bg-yellow-600">
                                                Edit
                                            </a>

                                            <form action="{{ route('asset-maintenances.destroy', $maintenance->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin hapus data maintenance ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <div class="mx-auto max-w-sm">
                                            <div
                                                class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-2xl text-gray-500">
                                                🛠️
                                            </div>

                                            <h3 class="text-sm font-semibold text-gray-800">
                                                Belum ada data maintenance
                                            </h3>

                                            <p class="mt-1 text-sm text-gray-500">
                                                Tambahkan data maintenance untuk mencatat perawatan asset.
                                            </p>

                                            <a href="{{ route('asset-maintenances.create', $asset->id) }}"
                                                class="mt-4 inline-flex rounded-xl bg-orange-600 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white hover:bg-orange-700">
                                                + Tambah Maintenance
                                            </a>
                                        </div>
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
