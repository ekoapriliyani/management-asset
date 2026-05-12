<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                QR Scan Stock Opname
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Scan QR asset untuk validasi stock opname.
            </p>
        </div>
    </x-slot>

    @if (session('error'))
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
            {{ session('error') }}
        </div>
    @endif

    {{-- <div class="py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        QR Scanner
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Arahkan kamera ke QR Code asset.
                    </p>
                </div>
                <div id="reader" class="overflow-hidden rounded-2xl border border-gray-200">
                </div>
                <div class="mt-6">
                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Upload Gambar QR / Barcode
                    </label>
                    <input type="file" id="qr-file" accept="image/*"
                        class="block w-full rounded-xl border border-gray-300 bg-white text-sm text-gray-700 file:mr-4 file:border-0 file:bg-indigo-50 file:px-4 file:py-3 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100">
                    <button type="button" id="scan-file-btn"
                        class="mt-4 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                        Scan File QR
                    </button>
                </div>
                <div id="file-reader" class="hidden"></div>
            </div>
        </div> --}}

    <div class="mt-8 rounded-2xl bg-gray-50 p-5 ring-1 ring-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">
            Input Manual Asset
        </h3>

        <p class="mt-1 text-sm text-gray-500">
            Masukkan kode asset jika scanner tidak berjalan.
        </p>

        <form action="{{ route('stock-opname.manual') }}" method="GET" class="mt-4 flex gap-3">
            <input type="text" name="asset_code" placeholder="Contoh: AST-001"
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

            <button type="submit"
                class="rounded-xl bg-indigo-600 px-5 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                Cari
            </button>
        </form>
    </div>
    </div>

    {{-- @push('scripts')
        <script type="module">
            import {
                Html5Qrcode,
                Html5QrcodeScanner
            } from "https://unpkg.com/html5-qrcode?module";

            function handleResult(decodedText) {
                document.getElementById('scan-result').classList.remove('hidden');
                document.getElementById('scan-text').innerText = decodedText;

                setTimeout(() => {
                    window.location.href = decodedText;
                }, 800);
            }

            const cameraScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: 250
                },
                false
            );

            cameraScanner.render(handleResult);

            document.getElementById('scan-file-btn').addEventListener('click', function() {
                const fileInput = document.getElementById('qr-file');

                if (!fileInput.files.length) {
                    alert('Pilih gambar QR terlebih dahulu.');
                    return;
                }

                const imageFile = fileInput.files[0];
                const fileScanner = new Html5Qrcode("file-reader");

                fileScanner.scanFile(imageFile, true)
                    .then(decodedText => {
                        handleResult(decodedText);
                    })
                    .catch(error => {
                        alert('QR tidak terbaca. Pastikan gambar jelas, tidak blur, dan benar-benar QR Code.');
                        console.error(error);
                    });
            });
        </script>
    @endpush --}}
</x-app-layout>
