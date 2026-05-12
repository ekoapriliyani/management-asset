<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Tambah Maintenance
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Catat aktivitas perawatan atau perbaikan asset.
                </p>
            </div>

            <a href="{{ route('assets.show', $asset->id) }}"
                class="inline-flex rounded-xl bg-gray-700 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white hover:bg-gray-800">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            <div class="mb-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <p class="text-sm text-gray-500">Asset</p>
                <h3 class="mt-1 text-xl font-bold text-gray-800">
                    {{ $asset->name }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    {{ $asset->asset_code }}
                </p>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <form action="{{ route('asset-maintenances.store', $asset->id) }}" method="POST" class="space-y-6">
                    @csrf

                    @include('asset-maintenances._form', ['maintenance' => null])

                    <div class="flex justify-end gap-3 border-t border-gray-100 pt-6">
                        <a href="{{ route('assets.show', $asset->id) }}"
                            class="rounded-xl bg-gray-200 px-5 py-2.5 text-xs font-semibold uppercase tracking-wider text-gray-700 hover:bg-gray-300">
                            Batal
                        </a>

                        <button type="submit"
                            class="rounded-xl bg-indigo-600 px-5 py-2.5 text-xs font-semibold uppercase tracking-wider text-white hover:bg-indigo-700">
                            Simpan Maintenance
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
