<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Assign / Pakai Asset
            </h2>

            <a href="{{ route('assets.show', $asset->id) }}"
                class="rounded-md bg-gray-600 px-4 py-2 text-xs font-semibold uppercase text-white hover:bg-gray-700">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="mb-6 rounded-md bg-gray-50 p-4">
                        <p><b>Kode Asset:</b> {{ $asset->asset_code }}</p>
                        <p><b>Nama Asset:</b> {{ $asset->name }}</p>
                        <p><b>Status:</b> {{ strtoupper(str_replace('_', ' ', $asset->status)) }}</p>
                    </div>

                    <form action="{{ route('assets.assign.store', $asset->id) }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Nama Pemakai
                                </label>
                                <input type="text" name="employee_name" value="{{ old('employee_name') }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                @error('employee_name')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    NIK / Nomor Karyawan
                                </label>
                                <input type="text" name="employee_number" value="{{ old('employee_number') }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Departemen
                                </label>
                                <input type="text" name="department" value="{{ old('department') }}"
                                    placeholder="Contoh: Produksi, QC, Maintenance"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Lokasi Pemakaian
                                </label>
                                <select name="location_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">-- Pilih Lokasi --</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" @selected(old('location_id') == $location->id)>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Tanggal Mulai Dipakai
                                </label>
                                <input type="date" name="assigned_date"
                                    value="{{ old('assigned_date', date('Y-m-d')) }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                @error('assigned_date')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Catatan
                                </label>
                                <textarea name="notes" rows="4" class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                    placeholder="Contoh: Dipakai untuk line produksi A">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('assets.show', $asset->id) }}" class="rounded bg-gray-200 px-4 py-2">
                                Batal
                            </a>

                            <button type="submit"
                                class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                                Simpan Pemakaian
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
