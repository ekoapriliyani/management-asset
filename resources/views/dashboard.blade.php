@section('title', 'Dashboard - Asset Management')
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Dashboard Asset Management
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Monitoring asset perusahaan secara real-time.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">

                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <p class="text-sm font-medium text-gray-500">
                        Total Asset
                    </p>

                    <h3 class="mt-3 text-4xl font-bold text-gray-800">
                        {{ $totalAssets }}
                    </h3>
                </div>

                <div class="rounded-2xl bg-green-50 p-6 shadow-sm ring-1 ring-green-200">
                    <p class="text-sm font-medium text-green-700">
                        Asset Available
                    </p>

                    <h3 class="mt-3 text-4xl font-bold text-green-800">
                        {{ $availableAssets }}
                    </h3>
                </div>

                <div class="rounded-2xl bg-yellow-50 p-6 shadow-sm ring-1 ring-yellow-200">
                    <p class="text-sm font-medium text-yellow-700">
                        Maintenance
                    </p>

                    <h3 class="mt-3 text-4xl font-bold text-yellow-800">
                        {{ $maintenanceAssets }}
                    </h3>
                </div>

                <div class="rounded-2xl bg-red-50 p-6 shadow-sm ring-1 ring-red-200">
                    <p class="text-sm font-medium text-red-700">
                        Broken Asset
                    </p>

                    <h3 class="mt-3 text-4xl font-bold text-red-800">
                        {{ $brokenAssets }}
                    </h3>
                </div>

            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 lg:col-span-2">

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Asset Status Analytics
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Distribusi status asset perusahaan.
                        </p>
                    </div>

                    <canvas id="assetChart" height="120"></canvas>

                </div>

                <div class="space-y-6">
                    <div class="rounded-2xl bg-gradient-to-br from-yellow-500 to-orange-500 p-6 text-white shadow-lg">

                        <div class="flex items-start justify-between">

                            <div>
                                <p class="text-sm font-semibold uppercase tracking-wider text-yellow-100">
                                    Pending Request
                                </p>

                                <h3 class="mt-3 text-4xl font-black">
                                    {{ $pendingRequests }}
                                </h3>

                                <p class="mt-2 text-sm text-yellow-100">
                                    Asset request menunggu approval
                                </p>
                            </div>

                            <div
                                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/20 text-3xl backdrop-blur">
                                📝
                            </div>

                        </div>

                    </div>

                    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                        <p class="text-sm font-medium text-gray-500">
                            Total Kategori
                        </p>

                        <h3 class="mt-3 text-4xl font-bold text-gray-800">
                            {{ $totalCategories }}
                        </h3>
                    </div>

                    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                        <p class="text-sm font-medium text-gray-500">
                            Total Lokasi
                        </p>

                        <h3 class="mt-3 text-4xl font-bold text-gray-800">
                            {{ $totalLocations }}
                        </h3>
                    </div>

                </div>

            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                    <div class="border-b border-gray-200 px-6 py-5">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Recent Maintenance
                        </h3>
                    </div>

                    <div class="divide-y divide-gray-100">

                        @forelse($recentMaintenances as $maintenance)
                            <div class="px-6 py-4">
                                <div class="flex items-start justify-between">

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $maintenance->asset->name ?? '-' }}
                                        </p>

                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ strtoupper($maintenance->maintenance_type) }}
                                        </p>
                                    </div>

                                    <span
                                        class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                        {{ strtoupper($maintenance->status) }}
                                    </span>

                                </div>
                            </div>

                        @empty

                            <div class="px-6 py-10 text-center text-sm text-gray-500">
                                Belum ada data maintenance
                            </div>
                        @endforelse

                    </div>

                </div>

                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                    <div class="border-b border-gray-200 px-6 py-5">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Recent Asset Assignment
                        </h3>
                    </div>

                    <div class="divide-y divide-gray-100">

                        @forelse($recentAssignments as $assignment)
                            <div class="px-6 py-4">
                                <div class="flex items-start justify-between">

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $assignment->asset->name ?? '-' }}
                                        </p>

                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ $assignment->employee_name }}
                                        </p>
                                    </div>

                                    <span
                                        class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                        {{ strtoupper($assignment->status) }}
                                    </span>

                                </div>
                            </div>

                        @empty

                            <div class="px-6 py-10 text-center text-sm text-gray-500">
                                Belum ada data assignment
                            </div>
                        @endforelse

                    </div>

                </div>

            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('assetChart');

                if (ctx) {
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode(array_keys($assetStatuses)) !!},
                            datasets: [{
                                label: 'Jumlah Asset',
                                data: {!! json_encode(array_values($assetStatuses)) !!},
                                backgroundColor: [
                                    '#22c55e',
                                    '#3b82f6',
                                    '#eab308',
                                    '#ef4444',
                                    '#6b7280'
                                ],
                                borderRadius: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    }
                                }
                            }
                        }
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
