<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Dashboard Asset Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
                <div class="rounded-lg bg-white p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Total Asset</p>
                    <h3 class="text-3xl font-bold">{{ $totalAssets }}</h3>
                </div>

                <div class="rounded-lg bg-green-50 p-5 shadow-sm">
                    <p class="text-sm text-green-700">Tersedia</p>
                    <h3 class="text-3xl font-bold text-green-800">{{ $availableAssets }}</h3>
                </div>

                <div class="rounded-lg bg-blue-50 p-5 shadow-sm">
                    <p class="text-sm text-blue-700">Dipakai</p>
                    <h3 class="text-3xl font-bold text-blue-800">{{ $inUseAssets }}</h3>
                </div>

                <div class="rounded-lg bg-yellow-50 p-5 shadow-sm">
                    <p class="text-sm text-yellow-700">Maintenance</p>
                    <h3 class="text-3xl font-bold text-yellow-800">{{ $maintenanceAssets }}</h3>
                </div>

                <div class="rounded-lg bg-red-50 p-5 shadow-sm">
                    <p class="text-sm text-red-700">Rusak</p>
                    <h3 class="text-3xl font-bold text-red-800">{{ $brokenAssets }}</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <div class="rounded-lg bg-white p-6 shadow-sm lg:col-span-2">
                    <h3 class="mb-4 text-lg font-semibold">
                        Ringkasan Status Asset
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <div class="mb-1 flex justify-between text-sm">
                                <span>Tersedia</span>
                                <span>{{ $availableAssets }}</span>
                            </div>
                            <div class="h-3 w-full rounded-full bg-gray-200">
                                <div class="h-3 rounded-full bg-green-500"
                                    style="width: {{ $totalAssets > 0 ? ($availableAssets / $totalAssets) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="mb-1 flex justify-between text-sm">
                                <span>Dipakai</span>
                                <span>{{ $inUseAssets }}</span>
                            </div>
                            <div class="h-3 w-full rounded-full bg-gray-200">
                                <div class="h-3 rounded-full bg-blue-500"
                                    style="width: {{ $totalAssets > 0 ? ($inUseAssets / $totalAssets) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="mb-1 flex justify-between text-sm">
                                <span>Maintenance</span>
                                <span>{{ $maintenanceAssets }}</span>
                            </div>
                            <div class="h-3 w-full rounded-full bg-gray-200">
                                <div class="h-3 rounded-full bg-yellow-500"
                                    style="width: {{ $totalAssets > 0 ? ($maintenanceAssets / $totalAssets) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="mb-1 flex justify-between text-sm">
                                <span>Rusak</span>
                                <span>{{ $brokenAssets }}</span>
                            </div>
                            <div class="h-3 w-full rounded-full bg-gray-200">
                                <div class="h-3 rounded-full bg-red-500"
                                    style="width: {{ $totalAssets > 0 ? ($brokenAssets / $totalAssets) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-lg font-semibold">
                        Menu Cepat
                    </h3>

                    <div class="space-y-3">
                        <a href="{{ route('assets.index') }}"
                            class="block rounded bg-indigo-600 px-4 py-3 text-white hover:bg-indigo-700">
                            Data Asset
                        </a>

                        <a href="{{ route('asset-categories.index') }}"
                            class="block rounded bg-gray-700 px-4 py-3 text-white hover:bg-gray-800">
                            Kategori Asset
                        </a>

                        <a href="{{ route('locations.index') }}"
                            class="block rounded bg-gray-700 px-4 py-3 text-white hover:bg-gray-800">
                            Lokasi Asset
                        </a>

                        <a href="{{ route('assets.create') }}"
                            class="block rounded bg-green-600 px-4 py-3 text-white hover:bg-green-700">
                            Tambah Asset Baru
                        </a>
                    </div>
                </div>

            </div>

            <div class="rounded-lg bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-lg font-semibold">
                    Aktivitas Pemakaian Terbaru
                </h3>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Asset</th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Pemakai</th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Departemen</th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Lokasi</th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Tanggal Pakai
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($recentAssignments as $assignment)
                            <tr>
                                <td class="px-4 py-3">
                                    {{ $assignment->asset->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $assignment->employee_name }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $assignment->department ?? '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $assignment->location->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $assignment->assigned_date }}
                                </td>
                                <td class="px-4 py-3">
                                    <span
                                        class="@if ($assignment->status === 'active') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800 @endif rounded px-2 py-1 text-xs">
                                        {{ strtoupper($assignment->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                    Belum ada aktivitas pemakaian asset.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
