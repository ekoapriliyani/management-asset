<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\AssetCategory;
use App\Models\AssetRequest;
use Illuminate\Http\Request;

class AssetRequestController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $requests = AssetRequest::with(['user', 'category', 'assignedAsset'])
                ->latest()
                ->paginate(10);
        } else {
            $requests = AssetRequest::with(['category', 'assignedAsset'])
                ->where('user_id', auth()->id())
                ->latest()
                ->paginate(10);
        }

        return view('asset-requests.index', compact('requests'));
    }

    public function create()
    {
        $categories = AssetCategory::orderBy('name')->get();

        return view('asset-requests.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_category_id' => 'required|exists:asset_categories,id',
            'department' => 'nullable|string|max:255',
            'reason' => 'required|string',
        ]);

        AssetRequest::create([
            'user_id' => auth()->id(),
            'asset_category_id' => $request->asset_category_id,
            'department' => $request->department,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('asset-requests.index')
            ->with('success', 'Request asset berhasil dikirim.');
    }

    public function show(AssetRequest $assetRequest)
    {
        if (auth()->user()->role !== 'admin' && $assetRequest->user_id !== auth()->id()) {
            abort(403);
        }

        $assetRequest->load(['user', 'category', 'assignedAsset']);

        $availableAssets = Asset::where('asset_category_id', $assetRequest->asset_category_id)
            ->where('status', 'available')
            ->orderBy('name')
            ->get();

        return view('asset-requests.show', compact('assetRequest', 'availableAssets'));
    }

    public function approve(Request $request, AssetRequest $assetRequest)
    {
        $request->validate([
            'assigned_asset_id' => 'required|exists:assets,id',
            'admin_notes' => 'nullable|string',
        ]);

        $asset = Asset::where('id', $request->assigned_asset_id)
            ->where('status', 'available')
            ->firstOrFail();

        $assetRequest->update([
            'assigned_asset_id' => $asset->id,
            'status' => 'approved',
            'admin_notes' => $request->admin_notes,
        ]);

        AssetAssignment::create([
            'asset_id' => $asset->id,
            'employee_name' => $assetRequest->user->name,
            'employee_number' => null,
            'department' => $assetRequest->department,
            'location_id' => $asset->location_id,
            'assigned_date' => now()->toDateString(),
            'status' => 'active',
            'notes' => 'Assign dari request asset #' . $assetRequest->id,
        ]);

        $asset->update([
            'status' => 'in_use',
        ]);

        return redirect()
            ->route('asset-requests.index')
            ->with('success', 'Request disetujui dan asset berhasil di-assign.');
    }

    public function reject(Request $request, AssetRequest $assetRequest)
    {
        $request->validate([
            'admin_notes' => 'nullable|string',
        ]);

        $assetRequest->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()
            ->route('asset-requests.index')
            ->with('success', 'Request asset ditolak.');
    }
}
