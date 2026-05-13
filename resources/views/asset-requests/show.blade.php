<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Detail Asset Request
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Detail permintaan asset.
            </p>
        </div>
    </x-slot>

    <div class="py-10">

        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div>
                        <p class="text-sm text-gray-500">
                            Requestor
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-gray-800">
                            {{ $assetRequest->user->name }}
                        </h3>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Kategori Asset
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-gray-800">
                            {{ $assetRequest->category->name }}
                        </h3>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Department
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-gray-800">
                            {{ $assetRequest->department ?? '-' }}
                        </h3>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Status
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-gray-800">
                            {{ strtoupper($assetRequest->status) }}
                        </h3>
                    </div>

                </div>

                <div class="mt-8">

                    <p class="text-sm text-gray-500">
                        Alasan Permintaan
                    </p>

                    <div class="mt-2 rounded-2xl bg-gray-50 p-5 text-gray-700">
                        {{ $assetRequest->reason }}
                    </div>

                </div>

            </div>

            @if (auth()->user()->role === 'admin' && $assetRequest->status === 'pending')

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                        <h3 class="text-lg font-semibold text-gray-800">
                            Approve Request
                        </h3>

                        <form action="{{ route('asset-requests.approve', $assetRequest->id) }}" method="POST"
                            class="mt-6 space-y-5">

                            @csrf
                            @method('PUT')

                            <div>

                                <label class="mb-2 block text-sm font-semibold text-gray-700">
                                    Pilih Asset Available
                                </label>

                                <select name="assigned_asset_id"
                                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                                    @foreach ($availableAssets as $asset)
                                        <option value="{{ $asset->id }}">
                                            {{ $asset->name }} - {{ $asset->asset_code }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            <div>

                                <label class="mb-2 block text-sm font-semibold text-gray-700">
                                    Catatan Admin
                                </label>

                                <textarea name="admin_notes" rows="4"
                                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>

                            </div>

                            <button type="submit"
                                class="w-full rounded-xl bg-green-600 px-5 py-3 text-sm font-semibold text-white hover:bg-green-700">
                                Approve & Assign Asset
                            </button>

                        </form>

                    </div>

                    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                        <h3 class="text-lg font-semibold text-gray-800">
                            Reject Request
                        </h3>

                        <form action="{{ route('asset-requests.reject', $assetRequest->id) }}" method="POST"
                            class="mt-6 space-y-5">

                            @csrf
                            @method('PUT')

                            <div>

                                <label class="mb-2 block text-sm font-semibold text-gray-700">
                                    Alasan Penolakan
                                </label>

                                <textarea name="admin_notes" rows="5"
                                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>

                            </div>

                            <button type="submit"
                                class="w-full rounded-xl bg-red-600 px-5 py-3 text-sm font-semibold text-white hover:bg-red-700">
                                Reject Request
                            </button>

                        </form>

                    </div>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>
