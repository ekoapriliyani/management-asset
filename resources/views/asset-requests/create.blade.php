<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Request Asset
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Ajukan permintaan asset kepada admin.
            </p>
        </div>
    </x-slot>

    <div class="py-10">

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                <form action="{{ route('asset-requests.store') }}" method="POST" class="space-y-6">

                    @csrf

                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Kategori Asset
                        </label>

                        <select name="asset_category_id"
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            <option value="">
                                -- Pilih Kategori Asset --
                            </option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Departemen
                        </label>

                        <input type="text" name="department" placeholder="Contoh: IT, Produksi, Warehouse"
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                    </div>

                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Alasan Permintaan
                        </label>

                        <textarea name="reason" rows="5" placeholder="Jelaskan kebutuhan asset..."
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>

                    </div>

                    <div class="flex justify-end">

                        <button type="submit"
                            class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                            Submit Request
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
