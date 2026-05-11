<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\Location;
use Illuminate\Http\Request;

class AssetAssignmentController extends Controller
{
    public function create(Asset $asset)
    {
        if ($asset->status !== 'available') {
            return redirect()
                ->route('assets.show', $asset->id)
                ->with('error', 'Asset ini tidak tersedia untuk dipakai.');
        }

        $locations = Location::orderBy('name')->get();

        return view('asset-assignments.create', compact('asset', 'locations'));
    }

    public function store(Request $request, Asset $asset)
    {
        if ($asset->status !== 'available') {
            return redirect()
                ->route('assets.show', $asset->id)
                ->with('error', 'Asset ini sedang tidak tersedia.');
        }

        $request->validate([
            'employee_name' => 'required|string|max:255',
            'employee_number' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:255',
            'location_id' => 'nullable|exists:locations,id',
            'assigned_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        AssetAssignment::create([
            'asset_id' => $asset->id,
            'employee_name' => $request->employee_name,
            'employee_number' => $request->employee_number,
            'department' => $request->department,
            'location_id' => $request->location_id,
            'assigned_date' => $request->assigned_date,
            'status' => 'active',
            'notes' => $request->notes,
        ]);

        $asset->update([
            'status' => 'in_use',
            'location_id' => $request->location_id,
        ]);

        return redirect()
            ->route('assets.show', $asset->id)
            ->with('success', 'Asset berhasil dipakai / diberikan ke karyawan.');
    }

    public function returnAsset(Request $request, AssetAssignment $assignment)
    {
        if ($assignment->status !== 'active') {
            return redirect()
                ->route('assets.show', $assignment->asset_id)
                ->with('error', 'Asset ini sudah dikembalikan.');
        }

        $request->validate([
            'returned_date' => 'required|date|after_or_equal:' . $assignment->assigned_date,
            'condition' => 'required|in:available,maintenance,broken',
            'notes' => 'nullable|string',
        ]);

        $assignment->update([
            'returned_date' => $request->returned_date,
            'status' => 'returned',
            'notes' => $request->notes ?? $assignment->notes,
        ]);

        $assignment->asset->update([
            'status' => $request->condition,
        ]);

        return redirect()
            ->route('assets.show', $assignment->asset_id)
            ->with('success', 'Asset berhasil dikembalikan.');
    }
}
