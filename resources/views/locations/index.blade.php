@section('title', 'Lokasi Asset - Asset Management')
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Data Lokasi Asset
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola lokasi penyimpanan dan penggunaan asset perusahaan.
                </p>
            </div>

            <a href="{{ route('locations.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-indigo-700">
                + Tambah Lokasi
            </a>

        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div
                    class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                <div class="border-b border-gray-200 bg-gray-50 px-6 py-5">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Daftar Lokasi Asset
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Lokasi digunakan untuk memonitor posisi asset di gudang, produksi, QC, kantor, dan area lainnya.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    No
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Kode Lokasi
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Nama Lokasi
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Departemen
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Deskripsi
                                </th>

                                <th
                                    class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($locations as $location)
                                <tr class="transition hover:bg-gray-50">

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                        {{ $locations->firstItem() + $loop->index }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                            {{ $location->code }}
                                        </span>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-800">
                                        {{ $location->name }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                        {{ $location->department ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $location->description ?: '-' }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                        <div class="flex justify-end gap-2">

                                            <a href="{{ route('locations.edit', $location->id) }}"
                                                class="rounded-lg bg-yellow-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-yellow-600">
                                                Edit
                                            </a>

                                            <form action="{{ route('locations.destroy', $location->id) }}"
                                                method="POST" onsubmit="return confirm('Yakin hapus lokasi ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="rounded-lg bg-red-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-red-700">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">

                                        <div class="mx-auto max-w-sm">
                                            <div
                                                class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-500">
                                                📍
                                            </div>

                                            <h3 class="text-sm font-semibold text-gray-800">
                                                Belum ada lokasi asset
                                            </h3>

                                            <p class="mt-1 text-sm text-gray-500">
                                                Tambahkan lokasi untuk mempermudah monitoring posisi asset perusahaan.
                                            </p>

                                            <a href="{{ route('locations.create') }}"
                                                class="mt-4 inline-flex rounded-lg bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white hover:bg-indigo-700">
                                                + Tambah Lokasi
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($locations->hasPages())
                    <div class="border-t border-gray-200 px-6 py-4">
                        {{ $locations->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
