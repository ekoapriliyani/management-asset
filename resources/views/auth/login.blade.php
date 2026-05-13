@section('title', 'Login')

<x-guest-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="grid min-h-screen grid-cols-1 lg:grid-cols-2">

            {{-- LEFT BRANDING --}}
            <div
                class="hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 px-16 py-12 text-white lg:flex lg:flex-col lg:justify-between">

                <div>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-600 text-2xl font-black shadow-lg">
                            AMS
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold">
                                Asset Management System
                            </h1>
                            <p class="text-sm text-slate-300">
                                Manufacturing Asset Control
                            </p>
                        </div>
                    </div>

                    <div class="mt-28 max-w-2xl">
                        <p class="text-sm font-bold uppercase tracking-[0.35em] text-indigo-300">
                            Enterprise Asset Platform
                        </p>

                        <h2 class="mt-6 text-5xl font-black leading-tight">
                            Kelola asset perusahaan lebih cepat, rapi, dan terkontrol.
                        </h2>

                        <p class="mt-6 text-lg leading-8 text-slate-300">
                            Sistem informasi untuk monitoring asset, request asset,
                            tracking pemakaian, maintenance, stock opname, QR code,
                            dan laporan perusahaan manufaktur.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-5">
                    <div class="rounded-3xl border border-white/10 bg-white/10 p-6 backdrop-blur">
                        <p class="text-3xl font-black">QR</p>
                        <p class="mt-2 text-sm text-slate-300">Asset Tracking</p>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/10 p-6 backdrop-blur">
                        <p class="text-3xl font-black">REQ</p>
                        <p class="mt-2 text-sm text-slate-300">Asset Request</p>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/10 p-6 backdrop-blur">
                        <p class="text-3xl font-black">PDF</p>
                        <p class="mt-2 text-sm text-slate-300">Report Export</p>
                    </div>
                </div>

            </div>

            {{-- RIGHT LOGIN --}}
            <div class="flex min-h-screen items-center justify-center bg-white px-6 py-12 sm:px-10 lg:px-16">

                <div class="w-full max-w-lg">

                    {{-- MOBILE BRAND --}}
                    <div class="mb-10 lg:hidden">
                        <div
                            class="mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-600 text-xl font-black text-white">
                            AMS
                        </div>

                        <h1 class="text-2xl font-black text-gray-900">
                            Asset Management System
                        </h1>

                        <p class="mt-2 text-sm text-gray-500">
                            Manufacturing Asset Control
                        </p>
                    </div>

                    <div class="mb-10">
                        <p class="text-sm font-bold uppercase tracking-widest text-indigo-600">
                            Welcome Back
                        </p>

                        <h2 class="mt-3 text-4xl font-black text-gray-900">
                            Masuk ke Sistem
                        </h2>

                        <p class="mt-3 text-base text-gray-500">
                            Gunakan akun terdaftar untuk mengakses dashboard manajemen asset.
                        </p>
                    </div>

                    @if (session('status'))
                        <div
                            class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="mb-2 block text-sm font-bold text-gray-700">
                                Email
                            </label>

                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autofocus autocomplete="username" placeholder="Masukkan email"
                                class="block w-full rounded-2xl border-gray-300 px-5 py-4 text-base shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            @error('email')
                                <p class="mt-2 text-sm font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-bold text-gray-700">
                                Password
                            </label>

                            <input id="password" type="password" name="password" required
                                autocomplete="current-password" placeholder="Masukkan password"
                                class="block w-full rounded-2xl border-gray-300 px-5 py-4 text-base shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            @error('password')
                                <p class="mt-2 text-sm font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-3">
                                <input type="checkbox" name="remember"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">

                                <span class="text-sm font-medium text-gray-600">
                                    Ingat saya
                                </span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm font-bold text-indigo-600 hover:text-indigo-800">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <button type="submit"
                            class="w-full rounded-2xl bg-indigo-600 px-5 py-4 text-sm font-black uppercase tracking-widest text-white shadow-xl shadow-indigo-200 transition hover:bg-indigo-700">
                            Masuk Dashboard
                        </button>
                    </form>

                    @if (Route::has('register'))
                        <div class="mt-8 rounded-2xl bg-gray-50 p-5 text-center ring-1 ring-gray-200">
                            <p class="text-sm text-gray-600">
                                Belum punya akun?
                                <a href="{{ route('register') }}"
                                    class="font-bold text-indigo-600 hover:text-indigo-800">
                                    Daftar akun
                                </a>
                            </p>
                        </div>
                    @endif

                    <p class="mt-10 text-sm text-gray-400">
                        © {{ date('Y') }} Asset Management System.
                    </p>

                </div>

            </div>

        </div>
    </div>
</x-guest-layout>
