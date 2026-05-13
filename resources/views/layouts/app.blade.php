<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title', 'Asset Management System')
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 flex-col bg-slate-900 text-white lg:flex">
            <div class="border-b border-slate-800 px-8 py-6">
                <div class="flex items-center gap-4">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-xl font-bold">
                        A
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">
                            Asset Management
                        </h1>
                        <p class="text-sm text-slate-400">
                            Manufacturing System
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto px-5 py-6">
                <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-widest text-slate-500">
                    Main Menu
                </p>

                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-slate-800">
                        <span>📊</span>
                        Dashboard
                    </a>
                    <a href="{{ route('asset-requests.index') }}"
                        class="{{ request()->routeIs('asset-requests.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-slate-800">
                        <span>📝</span>
                        Asset Request
                    </a>
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('assets.index') }}"
                            class="{{ request()->routeIs('assets.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-slate-800">
                            <span>📦</span>
                            Data Asset
                        </a>
                        <a href="{{ route('asset-categories.index') }}"
                            class="{{ request()->routeIs('asset-categories.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-slate-800">
                            <span>🏷️</span>
                            Kategori Asset
                        </a>

                        <a href="{{ route('locations.index') }}"
                            class="{{ request()->routeIs('locations.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-slate-800">
                            <span>📍</span>
                            Lokasi Asset
                        </a>
                        <a href="{{ route('stock-opname.scanner') }}"
                            class="{{ request()->routeIs('stock-opname.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-slate-800">
                            <span>📷</span>
                            Stock Opname
                        </a>
                </nav>
                <p class="mb-3 mt-8 px-3 text-xs font-semibold uppercase tracking-widest text-slate-500">
                    Reports
                </p>
                <nav class="space-y-2">
                    <a href="{{ route('assets.export-pdf') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition hover:bg-slate-800">
                        <span>📄</span>
                        Export PDF
                    </a>
                    <a href="{{ route('assets.export-excel') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition hover:bg-slate-800">
                        <span>📊</span>
                        Export Excel
                    </a>
                </nav>
                @endif
            </div>
            <div class="border-t border-slate-800 p-5">
                <div class="rounded-2xl bg-slate-800 p-4">
                    <p class="text-sm font-semibold text-white">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="mt-1 text-xs text-slate-400">
                        {{ Auth::user()->email }}
                    </p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="mt-4 w-full rounded-xl bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white transition hover:bg-red-700">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>
        <div class="flex flex-1 flex-col overflow-hidden">
            <header class="border-b border-gray-200 bg-white">
                <div class="flex items-center justify-between px-6 py-4 lg:hidden">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-sm font-bold text-white">
                            A
                        </div>

                        <div>
                            <p class="text-sm font-bold text-gray-800">
                                Asset Management
                            </p>
                            <p class="text-xs text-gray-500">
                                Manufacturing System
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white">
                            Logout
                        </button>
                    </form>
                </div>
                <div class="flex gap-2 overflow-x-auto border-t border-gray-100 px-4 py-3 lg:hidden">
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }} whitespace-nowrap rounded-lg px-3 py-2 text-xs font-semibold">
                        Dashboard
                    </a>
                    <a href="{{ route('asset-requests.index') }}"
                        class="{{ request()->routeIs('asset-requests.*') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }} whitespace-nowrap rounded-lg px-3 py-2 text-xs font-semibold">
                        Request
                    </a>

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('assets.index') }}"
                            class="{{ request()->routeIs('assets.*') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }} whitespace-nowrap rounded-lg px-3 py-2 text-xs font-semibold">
                            Asset
                        </a>
                        <a href="{{ route('asset-categories.index') }}"
                            class="{{ request()->routeIs('asset-categories.*') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }} whitespace-nowrap rounded-lg px-3 py-2 text-xs font-semibold">
                            Kategori
                        </a>
                        <a href="{{ route('locations.index') }}"
                            class="{{ request()->routeIs('locations.*') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }} whitespace-nowrap rounded-lg px-3 py-2 text-xs font-semibold">
                            Lokasi
                        </a>
                        <a href="{{ route('stock-opname.scanner') }}"
                            class="{{ request()->routeIs('stock-opname.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-slate-800">
                            <span>📷</span>
                            Stock Opname
                        </a>
                        <a href="{{ route('assets.export-pdf') }}"
                            class="whitespace-nowrap rounded-lg bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-700">
                            PDF
                        </a>
                        <a href="{{ route('assets.export-excel') }}"
                            class="whitespace-nowrap rounded-lg bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-700">
                            Excel
                        </a>
                    @endif
                </div>
                <div class="hidden items-center justify-between px-6 py-5 lg:flex">
                    <div>
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="hidden text-right lg:block">
                            <p class="text-sm font-semibold text-gray-800">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                Asset Administrator
                            </p>
                        </div>
                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-700">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
                <div class="px-4 py-4 lg:hidden">
                    @isset($header)
                        {{ $header }}
                    @endisset
                </div>
            </header>
            <main class="flex-1 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
    @stack('scripts')
</body>

</html>
