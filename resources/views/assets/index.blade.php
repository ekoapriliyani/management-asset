<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Data Asset
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Kelola seluruh data asset perusahaan manufaktur secara terpusat.
                </p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('assets.export-excel') }}"
                    class="inline-flex items-center rounded-xl bg-green-600 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-green-700">
                    Export Excel
                </a>
                <a href="{{ route('assets.export-pdf') }}"
                    class="inline-flex items-center rounded-xl bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-red-700">
                    Export PDF
                </a>
                <a href="{{ route('assets.create') }}"
                    class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-indigo-700">
                    + Tambah Asset
                </a>
            </div>
        </div>
    </x-slot>
    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div
                    class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <form action="{{ route('assets.index') }}" method="GET">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5">

                        <div class="lg:col-span-2">
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Cari Asset
                            </label>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari kode, nama, brand, model, serial..."
                                class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Kategori
                            </label>

                            <select name="asset_category_id"
                                class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(request('asset_category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Lokasi
                            </label>

                            <select name="location_id"
                                class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Semua Lokasi</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}" @selected(request('location_id') == $location->id)>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Status
                            </label>

                            <select name="status"
                                class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Semua Status</option>
                                <option value="available" @selected(request('status') === 'available')>Available</option>
                                <option value="in_use" @selected(request('status') === 'in_use')>In Use</option>
                                <option value="maintenance" @selected(request('status') === 'maintenance')>Maintenance</option>
                                <option value="broken" @selected(request('status') === 'broken')>Broken</option>
                                <option value="disposed" @selected(request('status') === 'disposed')>Disposed</option>
                            </select>
                        </div>

                    </div>

                    <div class="mt-5 flex flex-wrap justify-end gap-2">
                        <a href="{{ route('assets.index') }}"
                            class="inline-flex rounded-xl bg-gray-200 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-700 transition hover:bg-gray-300">
                            Reset
                        </a>

                        <button type="submit"
                            class="inline-flex rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-indigo-700">
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                <div class="border-b border-gray-200 bg-gray-50 px-6 py-5">

                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Daftar Asset Perusahaan
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Menampilkan {{ $assets->count() }} dari {{ $assets->total() }} data asset.
                            </p>

                            <p class="mt-1 text-sm text-gray-500">
                                Monitoring dan manajemen seluruh asset perusahaan secara real-time.
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-3 lg:flex">

                            <div class="rounded-xl bg-white px-4 py-3 shadow-sm ring-1 ring-gray-200">
                                <p class="text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Total Asset
                                </p>

                                <h4 class="mt-1 text-xl font-bold text-gray-800">
                                    {{ $assets->total() }}
                                </h4>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Asset
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Kategori
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Lokasi
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

                            @forelse($assets as $asset)
                                <tr class="transition hover:bg-gray-50">

                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-4">

                                            <div
                                                class="h-14 w-14 overflow-hidden rounded-xl bg-gray-100 ring-1 ring-gray-200">

                                                @if ($asset->photo)
                                                    <img src="{{ asset('storage/' . $asset->photo) }}"
                                                        class="h-full w-full object-cover">
                                                @else
                                                    <div
                                                        class="flex h-full w-full items-center justify-center text-gray-400">
                                                        📦
                                                    </div>
                                                @endif

                                            </div>

                                            <div>
                                                <p class="font-semibold text-gray-800">
                                                    {{ $asset->name }}
                                                </p>

                                                <p class="mt-1 text-xs text-gray-500">
                                                    {{ $asset->asset_code }}
                                                </p>

                                                @if ($asset->serial_number)
                                                    <p class="mt-1 text-xs text-gray-400">
                                                        SN: {{ $asset->serial_number }}
                                                    </p>
                                                @endif
                                            </div>

                                        </div>

                                    </td>

                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                            {{ $asset->category->name ?? '-' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $asset->location->name ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">

                                        @if ($asset->status === 'available')
                                            <span
                                                class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                AVAILABLE
                                            </span>
                                        @elseif($asset->status === 'in_use')
                                            <span
                                                class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                                IN USE
                                            </span>
                                        @elseif($asset->status === 'maintenance')
                                            <span
                                                class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                                MAINTENANCE
                                            </span>
                                        @elseif($asset->status === 'broken')
                                            <span
                                                class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                BROKEN
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                                DISPOSED
                                            </span>
                                        @endif

                                    </td>

                                    <td class="px-6 py-4 text-right">

                                        <div class="flex justify-end gap-2">

                                            <a href="{{ route('assets.show', $asset->id) }}"
                                                class="rounded-lg bg-blue-600 px-3 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-blue-700">
                                                Detail
                                            </a>

                                            <a href="{{ route('assets.edit', $asset->id) }}"
                                                class="rounded-lg bg-yellow-500 px-3 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-yellow-600">
                                                Edit
                                            </a>

                                            <form action="{{ route('assets.destroy', $asset->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus asset ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-red-700">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>

                                    </td>

                                </tr>
                            @empty

                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">

                                        <div class="mx-auto max-w-sm">

                                            <div
                                                class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-2xl text-gray-500">
                                                📦
                                            </div>

                                            <h3 class="text-sm font-semibold text-gray-800">
                                                Belum ada data asset
                                            </h3>

                                            <p class="mt-1 text-sm text-gray-500">
                                                Tambahkan asset pertama untuk mulai mengelola inventory perusahaan.
                                            </p>

                                            <a href="{{ route('assets.create') }}"
                                                class="mt-4 inline-flex rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white hover:bg-indigo-700">
                                                + Tambah Asset
                                            </a>

                                        </div>

                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                @if ($assets->hasPages())
                    <div class="border-t border-gray-200 px-6 py-4">
                        {{ $assets->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
