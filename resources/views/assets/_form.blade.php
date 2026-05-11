<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <label class="block text-sm font-medium text-gray-700">Kode Asset</label>
        <input type="text" name="asset_code" value="{{ old('asset_code', $asset->asset_code ?? '') }}"
            class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="AST-001">
        @error('asset_code')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Nama Asset</label>
        <input type="text" name="name" value="{{ old('name', $asset->name ?? '') }}"
            class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
        @error('name')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Kategori</label>
        <select name="asset_category_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('asset_category_id', $asset->asset_category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('asset_category_id')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Lokasi</label>
        <select name="location_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
            <option value="">-- Pilih Lokasi --</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}" @selected(old('location_id', $asset->location_id ?? '') == $location->id)>
                    {{ $location->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Brand</label>
        <input type="text" name="brand" value="{{ old('brand', $asset->brand ?? '') }}"
            class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Model</label>
        <input type="text" name="model" value="{{ old('model', $asset->model ?? '') }}"
            class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Serial Number</label>
        <input type="text" name="serial_number" value="{{ old('serial_number', $asset->serial_number ?? '') }}"
            class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
            @foreach (['available', 'in_use', 'maintenance', 'broken', 'disposed'] as $status)
                <option value="{{ $status }}" @selected(old('status', $asset->status ?? 'available') == $status)>
                    {{ strtoupper(str_replace('_', ' ', $status)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Beli</label>
        <input type="date" name="purchase_date" value="{{ old('purchase_date', $asset->purchase_date ?? '') }}"
            class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Harga Beli</label>
        <input type="number" name="purchase_price" value="{{ old('purchase_price', $asset->purchase_price ?? '') }}"
            class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700">
            Foto Asset
        </label>

        @if (!empty($asset?->photo))
            <div class="mb-3">
                <img src="{{ asset('storage/' . $asset->photo) }}" class="h-32 rounded border object-cover">

                <p class="mt-1 text-xs text-gray-500">
                    Foto saat ini. Kosongkan upload jika tidak ingin mengganti foto.
                </p>
            </div>
        @endif

        <input type="file" name="photo" accept="image/*"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

        @error('photo')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" rows="4" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $asset->description ?? '') }}</textarea>
    </div>
</div>
