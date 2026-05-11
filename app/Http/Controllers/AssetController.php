<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with(['category', 'location'])
            ->latest()
            ->paginate(10);

        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        $categories = AssetCategory::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();

        return view('assets.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_code' => 'required|string|max:100|unique:assets,asset_code',
            'name' => 'required|string|max:255',
            'asset_category_id' => 'required|exists:asset_categories,id',
            'location_id' => 'nullable|exists:locations,id',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric',
            'status' => 'required|in:available,in_use,maintenance,broken,disposed',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('assets', 'public');
        }

        Asset::create($data);

        return redirect()
            ->route('assets.index')
            ->with('success', 'Asset berhasil ditambahkan.');
    }

    public function show(Asset $asset)
    {
        $asset->load([
            'category',
            'location',
            'assignments.location',
            'activeAssignment.location',
        ]);

        return view('assets.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        $categories = AssetCategory::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();

        return view('assets.edit', compact('asset', 'categories', 'locations'));
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'asset_code' => 'required|string|max:100|unique:assets,asset_code,' . $asset->id,
            'name' => 'required|string|max:255',
            'asset_category_id' => 'required|exists:asset_categories,id',
            'location_id' => 'nullable|exists:locations,id',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric',
            'status' => 'required|in:available,in_use,maintenance,broken,disposed',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            if ($asset->photo) {
                Storage::disk('public')->delete($asset->photo);
            }

            $data['photo'] = $request->file('photo')->store('assets', 'public');
        }

        $asset->update($data);

        return redirect()
            ->route('assets.index')
            ->with('success', 'Asset berhasil diperbarui.');
    }

    public function destroy(Asset $asset)
    {
        if ($asset->photo) {
            Storage::disk('public')->delete($asset->photo);
        }

        $asset->delete();

        return redirect()
            ->route('assets.index')
            ->with('success', 'Asset berhasil dihapus.');
    }

    public function qrcode(Asset $asset)
    {
        return view('assets.qrcode', compact('asset'));
    }

    public function exportPdf()
    {
        $assets = Asset::with(['category', 'location'])
            ->orderBy('asset_code')
            ->get();

        $pdf = Pdf::loadView('assets.export-pdf', compact('assets'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-data-asset.pdf');
    }
}
