<div class="grid grid-cols-1 gap-6 md:grid-cols-2">

    <div>
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Tanggal Maintenance
        </label>

        <input type="date" name="maintenance_date"
            value="{{ old('maintenance_date', $maintenance->maintenance_date ?? date('Y-m-d')) }}"
            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

        @error('maintenance_date')
            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Jenis Maintenance
        </label>

        <select name="maintenance_type"
            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">-- Pilih Jenis --</option>
            <option value="preventive" @selected(old('maintenance_type', $maintenance->maintenance_type ?? '') === 'preventive')>
                Preventive Maintenance
            </option>
            <option value="corrective" @selected(old('maintenance_type', $maintenance->maintenance_type ?? '') === 'corrective')>
                Corrective Maintenance
            </option>
            <option value="repair" @selected(old('maintenance_type', $maintenance->maintenance_type ?? '') === 'repair')>
                Repair
            </option>
            <option value="inspection" @selected(old('maintenance_type', $maintenance->maintenance_type ?? '') === 'inspection')>
                Inspection
            </option>
        </select>

        @error('maintenance_type')
            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Nama Teknisi
        </label>

        <input type="text" name="technician_name"
            value="{{ old('technician_name', $maintenance->technician_name ?? '') }}"
            placeholder="Contoh: Budi Maintenance"
            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

        @error('technician_name')
            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Biaya Maintenance
        </label>

        <input type="number" name="cost" value="{{ old('cost', $maintenance->cost ?? 0) }}"
            placeholder="Contoh: 250000"
            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

        @error('cost')
            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Jadwal Maintenance Berikutnya
        </label>

        <input type="date" name="next_maintenance_date"
            value="{{ old('next_maintenance_date', $maintenance->next_maintenance_date ?? '') }}"
            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

        @error('next_maintenance_date')
            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Status Maintenance
        </label>

        <select name="status"
            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="scheduled" @selected(old('status', $maintenance->status ?? 'scheduled') === 'scheduled')>
                Scheduled
            </option>
            <option value="in_progress" @selected(old('status', $maintenance->status ?? '') === 'in_progress')>
                In Progress
            </option>
            <option value="completed" @selected(old('status', $maintenance->status ?? '') === 'completed')>
                Completed
            </option>
        </select>

        @error('status')
            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Deskripsi Masalah
        </label>

        <textarea name="problem_description" rows="4" placeholder="Jelaskan masalah atau alasan maintenance..."
            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('problem_description', $maintenance->problem_description ?? '') }}</textarea>

        @error('problem_description')
            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Tindakan Perbaikan
        </label>

        <textarea name="action_taken" rows="4" placeholder="Jelaskan tindakan yang dilakukan teknisi..."
            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('action_taken', $maintenance->action_taken ?? '') }}</textarea>

        @error('action_taken')
            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
        @enderror
    </div>

</div>
