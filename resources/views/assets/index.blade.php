<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Data Asset
            </h2>

            <a href="{{ route('assets.create') }}"
                class="rounded-md bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase text-white hover:bg-indigo-700">
                + Tambah Asset
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded bg-green-100 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Kode</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Nama</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Kategori
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Lokasi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Status</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase text-gray-500">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($assets as $asset)
                                <tr>
                                    <td class="px-4 py-3 font-semibold">{{ $asset->asset_code }}</td>
                                    <td class="px-4 py-3">{{ $asset->name }}</td>
                                    <td class="px-4 py-3">{{ $asset->category->name ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $asset->location->name ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="rounded bg-gray-100 px-2 py-1 text-xs text-gray-700">
                                            {{ strtoupper(str_replace('_', ' ', $asset->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('assets.show', $asset->id) }}"
                                            class="rounded bg-blue-600 px-3 py-1 text-white hover:bg-blue-700">
                                            Detail
                                        </a>

                                        <a href="{{ route('assets.edit', $asset->id) }}"
                                            class="rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600">
                                            Edit
                                        </a>

                                        <form action="{{ route('assets.destroy', $asset->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin hapus asset ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-5 text-center text-gray-500">
                                        Belum ada data asset.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $assets->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
