@section('title', 'Edit Kategori Asset - Asset Management')
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Edit Kategori Asset
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Perbarui informasi kategori asset perusahaan.
                </p>
            </div>

            <a href="{{ route('asset-categories.index') }}"
                class="inline-flex items-center justify-center rounded-lg bg-gray-700 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-gray-800">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                <div class="border-b border-gray-200 bg-gray-50 px-6 py-5">
                    <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Form Edit Kategori
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Data kategori: {{ $assetCategory->name }}
                            </p>
                        </div>

                        <span
                            class="inline-flex w-fit rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                            {{ $assetCategory->code }}
                        </span>
                    </div>
                </div>

                <div class="p-6">

                    <form action="{{ route('asset-categories.update', $assetCategory->id) }}" method="POST"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-gray-700">
                                    Kode Kategori
                                </label>

                                <input type="text" name="code" value="{{ old('code', $assetCategory->code) }}"
                                    placeholder="Contoh: IT, MCH, PRD"
                                    class="block w-full rounded-xl border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500">

                                <p class="mt-1 text-xs text-gray-500">
                                    Kode harus unik dan mudah dikenali.
                                </p>

                                @error('code')
                                    <p class="mt-2 text-sm font-medium text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-gray-700">
                                    Nama Kategori
                                </label>

                                <input type="text" name="name" value="{{ old('name', $assetCategory->name) }}"
                                    placeholder="Contoh: Mesin Produksi"
                                    class="block w-full rounded-xl border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500">

                                <p class="mt-1 text-xs text-gray-500">
                                    Gunakan nama kategori yang jelas.
                                </p>

                                @error('name')
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

                            <textarea name="description" rows="5" placeholder="Keterangan tambahan mengenai kategori asset..."
                                class="block w-full rounded-xl border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $assetCategory->description) }}</textarea>

                            <p class="mt-1 text-xs text-gray-500">
                                Opsional. Jelaskan cakupan kategori asset ini.
                            </p>

                            @error('description')
                                <p class="mt-2 text-sm font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">

                            <a href="{{ route('asset-categories.index') }}"
                                class="inline-flex items-center rounded-lg bg-gray-200 px-5 py-2.5 text-xs font-semibold uppercase tracking-wider text-gray-700 transition hover:bg-gray-300">
                                Batal
                            </a>

                            <button type="submit"
                                class="inline-flex items-center rounded-lg bg-indigo-600 px-5 py-2.5 text-xs font-semibold uppercase tracking-wider text-white shadow-sm transition hover:bg-indigo-700">
                                Update Kategori
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
