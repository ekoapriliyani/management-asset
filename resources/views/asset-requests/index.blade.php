@section('title', 'Asset Request - Asset Management')
<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Asset Request
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Permintaan asset oleh user/karyawan.
                </p>
            </div>

            @if (auth()->user()->role === 'employee')
                <a href="{{ route('asset-requests.create') }}"
                    class="inline-flex rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                    + Request Asset
                </a>
            @endif

        </div>
    </x-slot>

    <div class="py-10">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div
                    class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">

                            <tr>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Requestor
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Kategori Asset
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Status
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Asset Assigned
                                </th>

                                <th
                                    class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">

                            @forelse($requests as $request)
                                <tr class="transition hover:bg-gray-50">

                                    <td class="px-6 py-5">

                                        <div>
                                            <p class="font-semibold text-gray-800">
                                                {{ $request->user->name }}
                                            </p>

                                            <p class="mt-1 text-sm text-gray-500">
                                                {{ $request->department ?? '-' }}
                                            </p>
                                        </div>

                                    </td>

                                    <td class="px-6 py-5">

                                        <p class="font-medium text-gray-700">
                                            {{ $request->category->name }}
                                        </p>

                                    </td>

                                    <td class="px-6 py-5">

                                        @if ($request->status === 'pending')
                                            <span
                                                class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                                PENDING
                                            </span>
                                        @elseif($request->status === 'approved')
                                            <span
                                                class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                APPROVED
                                            </span>
                                        @else
                                            <span
                                                class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                REJECTED
                                            </span>
                                        @endif

                                    </td>

                                    <td class="px-6 py-5">

                                        @if ($request->assignedAsset)
                                            <div>
                                                <p class="font-semibold text-gray-800">
                                                    {{ $request->assignedAsset->name }}
                                                </p>

                                                <p class="mt-1 text-sm text-gray-500">
                                                    {{ $request->assignedAsset->asset_code }}
                                                </p>
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-400">
                                                Belum di-assign
                                            </span>
                                        @endif

                                    </td>

                                    <td class="px-6 py-5 text-right">

                                        <a href="{{ route('asset-requests.show', $request->id) }}"
                                            class="rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white hover:bg-indigo-700">
                                            Detail
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="px-6 py-16 text-center">

                                        <div class="mx-auto max-w-sm">

                                            <div
                                                class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 text-3xl">
                                                📦
                                            </div>

                                            <h3 class="text-lg font-semibold text-gray-800">
                                                Belum ada request asset
                                            </h3>

                                            <p class="mt-2 text-sm text-gray-500">
                                                Request asset akan muncul di sini.
                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="mt-6">
                {{ $requests->links() }}
            </div>

        </div>

    </div>

</x-app-layout>
