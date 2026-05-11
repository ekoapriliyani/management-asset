<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Detail Asset
            </h2>

            <a href="{{ route('assets.index') }}" class="rounded-md bg-gray-600 px-4 py-2 text-xs uppercase text-white">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-3">

                    <div>
                        @if ($asset->photo)
                            <img src="{{ asset('storage/' . $asset->photo) }}" class="w-full rounded border">
                        @else
                            <div class="flex h-48 items-center justify-center rounded bg-gray-100 text-gray-500">
                                Tidak ada foto
                            </div>
                        @endif
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="mb-4 text-2xl font-bold">{{ $asset->name }}</h3>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <p><b>Kode:</b> {{ $asset->asset_code }}</p>
                            <p><b>Status:</b> {{ strtoupper(str_replace('_', ' ', $asset->status)) }}</p>
                            <p><b>Kategori:</b> {{ $asset->category->name ?? '-' }}</p>
                            <p><b>Lokasi:</b> {{ $asset->location->name ?? '-' }}</p>
                            <p><b>Brand:</b> {{ $asset->brand ?? '-' }}</p>
                            <p><b>Model:</b> {{ $asset->model ?? '-' }}</p>
                            <p><b>Serial Number:</b> {{ $asset->serial_number ?? '-' }}</p>
                            <p><b>Tanggal Beli:</b> {{ $asset->purchase_date ?? '-' }}</p>
                            <p><b>Harga Beli:</b> Rp {{ number_format($asset->purchase_price ?? 0, 0, ',', '.') }}</p>
                        </div>

                        <div class="mt-6">
                            <b>Deskripsi:</b>
                            <p class="mt-1 text-gray-700">{{ $asset->description ?? '-' }}</p>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('assets.edit', $asset->id) }}"
                                class="rounded bg-yellow-500 px-4 py-2 text-white hover:bg-yellow-600">
                                Edit Asset
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
