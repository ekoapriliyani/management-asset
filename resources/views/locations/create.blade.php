<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Tambah Lokasi Asset
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Tambahkan lokasi baru untuk penyimpanan atau penggunaan asset.
                </p>
            </div>

            <a href="{{ route('locations.index') }}"
                class="inline-flex items-center justify-center rounded-lg bg-gray-700 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-gray-800">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                <div class="border-b border-gray-200 bg-gray-50 px-6 py-5">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Form Lokasi Asset
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Isi data lokasi agar asset lebih mudah dimonitor berdasarkan area dan departemen.
                    </p>
                </div>

                <div class="p-6">
                    <form action="{{ route('locations.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-gray-700">
                                    Kode Lokasi
                                </label>

                                <input type="text" name="code" value="{{ old('code') }}"
                                    placeholder="Contoh: GDG01, PRD01, QC01"
                                    class="block w-full rounded-xl border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500">

                                <p class="mt-1 text-xs text-gray-500">
                                    Gunakan kode unik untuk setiap lokasi.
                                </p>

                                @error('code')
                                    <p class="mt-2 text-sm font-medium text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-gray-700">
                                    Nama Lokasi
                                </label>

                                <input type="text" name="name" value="{{ old('name') }}"
                                    placeholder="Contoh: Gudang Utama"
                                    class="block w-full rounded-xl border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500">

                                <p class="mt-1 text-xs text-gray-500">
                                    Nama area tempat asset berada.
                                </p>

                                @error('name')
                                    <p class="mt-2 text-sm font-medium text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-gray-700">
                                    Departemen
                                </label>

                                <input type="text" name="department" value="{{ old('department') }}"
                                    placeholder="Contoh: Warehouse, Produksi, QC, Maintenance"
                                    class="block w-full rounded-xl border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500">

                                <p class="mt-1 text-xs text-gray-500">
                                    Opsional. Isi jika lokasi ini terhubung dengan departemen tertentu.
                                </p>

                                @error('department')
                                    <p class="mt-2 text-sm font-medium text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Deskripsi
                            </label>

                            <textarea name="description" rows="5" placeholder="Keterangan tambahan mengenai lokasi asset..."
                                class="block w-full rounded-xl border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>

                            <p class="mt-1 text-xs text-gray-500">
                                Opsional. Contoh: area penyimpanan sparepart, line produksi, ruang QC, dan sebagainya.
                            </p>

                            @error('description')
                                <p class="mt-2 text-sm font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                            <a href="{{ route('locations.index') }}"
                                class="inline-flex items-center rounded-lg bg-gray-200 px-5 py-2.5 text-xs font-semibold uppercase tracking-wider text-gray-700 transition hover:bg-gray-300">
                                Batal
                            </a>

                            <button type="submit"
                                class="inline-flex items-center rounded-lg bg-indigo-600 px-5 py-2.5 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-indigo-700">
                                Simpan Lokasi
                            </button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
