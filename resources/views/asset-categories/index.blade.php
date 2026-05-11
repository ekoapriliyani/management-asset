<x-app-layout>
    <div class="container mx-auto py-6">

        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold">
                Data Kategori Asset
            </h1>

            <a href="{{ route('asset-categories.create') }}"
                class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                + Tambah Kategori
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 rounded bg-green-100 p-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-lg bg-white shadow">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-3 text-left">No</th>
                        <th class="border p-3 text-left">Kode</th>
                        <th class="border p-3 text-left">Nama</th>
                        <th class="border p-3 text-left">Deskripsi</th>
                        <th class="border p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="border p-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border p-3">
                                {{ $category->code }}
                            </td>

                            <td class="border p-3">
                                {{ $category->name }}
                            </td>

                            <td class="border p-3">
                                {{ $category->description }}
                            </td>

                            <td class="border p-3 text-center">
                                <a href="{{ route('asset-categories.edit', $category->id) }}"
                                    class="rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600">
                                    Edit
                                </a>

                                <form action="{{ route('asset-categories.destroy', $category->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin hapus data?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border p-3 text-center">
                                Belum ada data kategori
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>

    </div>
</x-app-layout>
