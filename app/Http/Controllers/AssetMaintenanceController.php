<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetMaintenance;
use Illuminate\Http\Request;

class AssetMaintenanceController extends Controller
{
    public function create(Asset $asset)
    {
        return view('asset-maintenances.create', compact('asset'));
    }

    public function store(Request $request, Asset $asset)
    {
        $request->validate([
            'maintenance_date' => 'required|date',
            'maintenance_type' => 'required|string|max:255',
            'technician_name' => 'nullable|string|max:255',
            'cost' => 'nullable|numeric|min:0',
            'problem_description' => 'nullable|string',
            'action_taken' => 'nullable|string',
            'next_maintenance_date' => 'nullable|date|after_or_equal:maintenance_date',
            'status' => 'required|in:scheduled,in_progress,completed',
        ]);

        AssetMaintenance::create([
            'asset_id' => $asset->id,
            'maintenance_date' => $request->maintenance_date,
            'maintenance_type' => $request->maintenance_type,
            'technician_name' => $request->technician_name,
            'cost' => $request->cost ?? 0,
            'problem_description' => $request->problem_description,
            'action_taken' => $request->action_taken,
            'next_maintenance_date' => $request->next_maintenance_date,
            'status' => $request->status,
        ]);

        if (in_array($request->status, ['scheduled', 'in_progress'])) {
            $asset->update(['status' => 'maintenance']);
        }

        if ($request->status === 'completed') {
            $asset->update(['status' => 'available']);
        }

        return redirect()
            ->route('assets.show', $asset->id)
            ->with('success', 'Data maintenance berhasil ditambahkan.');
    }

    public function edit(AssetMaintenance $maintenance)
    {
        return view('asset-maintenances.edit', compact('maintenance'));
    }

    public function update(Request $request, AssetMaintenance $maintenance)
    {
        $request->validate([
            'maintenance_date' => 'required|date',
            'maintenance_type' => 'required|string|max:255',
            'technician_name' => 'nullable|string|max:255',
            'cost' => 'nullable|numeric|min:0',
            'problem_description' => 'nullable|string',
            'action_taken' => 'nullable|string',
            'next_maintenance_date' => 'nullable|date|after_or_equal:maintenance_date',
            'status' => 'required|in:scheduled,in_progress,completed',
        ]);

        $maintenance->update([
            'maintenance_date' => $request->maintenance_date,
            'maintenance_type' => $request->maintenance_type,
            'technician_name' => $request->technician_name,
            'cost' => $request->cost ?? 0,
            'problem_description' => $request->problem_description,
            'action_taken' => $request->action_taken,
            'next_maintenance_date' => $request->next_maintenance_date,
            'status' => $request->status,
        ]);

        if (in_array($request->status, ['scheduled', 'in_progress'])) {
            $maintenance->asset->update(['status' => 'maintenance']);
        }

        if ($request->status === 'completed') {
            $maintenance->asset->update(['status' => 'available']);
        }

        return redirect()
            ->route('assets.show', $maintenance->asset_id)
            ->with('success', 'Data maintenance berhasil diperbarui.');
    }

    public function destroy(AssetMaintenance $maintenance)
    {
        $assetId = $maintenance->asset_id;

        $maintenance->delete();

        return redirect()
            ->route('assets.show', $assetId)
            ->with('success', 'Data maintenance berhasil dihapus.');
    }
}
