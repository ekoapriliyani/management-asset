<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Data Lokasi Asset
            </h2>

            <a href="{{ route('locations.create') }}"
                class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-indigo-700">
                + Tambah Lokasi
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                    No
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                    Kode
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                    Nama Lokasi
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                    Departemen
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                    Deskripsi
                                </th>

                                <th class="px-6 py-3 text-center text-xs font-medium uppercase text-gray-500">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($locations as $location)
                                <tr>
                                    <td class="px-6 py-4">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $location->code }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $location->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $location->department ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $location->description ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('locations.edit', $location->id) }}"
                                            class="inline-flex rounded-md bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600">
                                            Edit
                                        </a>

                                        <form action="{{ route('locations.destroy', $location->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex rounded-md bg-red-600 px-3 py-1 text-white hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Belum ada data lokasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $locations->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
