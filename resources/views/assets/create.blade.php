<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Tambah Asset
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-5">
                        @csrf

                        @include('assets._form', ['asset' => null])

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('assets.index') }}" class="rounded bg-gray-200 px-4 py-2">
                                Batal
                            </a>
                            <button class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                                Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
