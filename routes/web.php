<?php

use App\Http\Controllers\AssetAssignmentController;
use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetMaintenanceController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\AssetCategory;
use App\Models\AssetMaintenance;
use App\Models\Location;
use App\Models\StockOpname;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $totalAssets = Asset::count();
    $availableAssets = Asset::where('status', 'available')->count();
    $inUseAssets = Asset::where('status', 'in_use')->count();
    $maintenanceAssets = Asset::where('status', 'maintenance')->count();
    $brokenAssets = Asset::where('status', 'broken')->count();
    $disposedAssets = Asset::where('status', 'disposed')->count();
    $totalCategories = AssetCategory::count();
    $totalLocations = Location::count();

    $assetStatuses = [
        'Available' => $availableAssets,
        'In Use' => $inUseAssets,
        'Maintenance' => $maintenanceAssets,
        'Broken' => $brokenAssets,
        'Disposed' => $disposedAssets,
    ];

    $recentAssignments = AssetAssignment::with(['asset', 'location'])
        ->latest()
        ->take(5)
        ->get();

    $recentMaintenances = AssetMaintenance::with('asset')
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard', compact(
        'totalAssets',
        'availableAssets',
        'inUseAssets',
        'maintenanceAssets',
        'brokenAssets',
        'disposedAssets',
        'totalCategories',
        'totalLocations',
        'assetStatuses',
        'recentAssignments',
        'recentMaintenances'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('asset-categories', AssetCategoryController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('assets', AssetController::class);

    Route::get('/assets/{asset}/assign', [AssetAssignmentController::class, 'create'])
        ->name('assets.assign.create');

    Route::post('/assets/{asset}/assign', [AssetAssignmentController::class, 'store'])
        ->name('assets.assign.store');

    Route::put('/asset-assignments/{assignment}/return', [AssetAssignmentController::class, 'returnAsset'])
        ->name('asset-assignments.return');

    Route::get('/assets/{asset}/qrcode', [AssetController::class, 'qrcode'])
        ->name('assets.qrcode');

    Route::get('/assets-export-pdf', [AssetController::class, 'exportPdf'])
        ->name('assets.export-pdf');

    Route::get('/assets-export-excel', [AssetController::class, 'exportExcel'])
        ->name('assets.export-excel');

    // maintenance
    Route::get('/assets/{asset}/maintenances/create', [AssetMaintenanceController::class, 'create'])
        ->name('asset-maintenances.create');

    Route::post('/assets/{asset}/maintenances', [AssetMaintenanceController::class, 'store'])
        ->name('asset-maintenances.store');

    Route::get('/asset-maintenances/{maintenance}/edit', [AssetMaintenanceController::class, 'edit'])
        ->name('asset-maintenances.edit');

    Route::put('/asset-maintenances/{maintenance}', [AssetMaintenanceController::class, 'update'])
        ->name('asset-maintenances.update');

    Route::delete('/asset-maintenances/{maintenance}', [AssetMaintenanceController::class, 'destroy'])
        ->name('asset-maintenances.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::view('/stock-opname/scanner', 'stock-opname.scanner')
        ->name('stock-opname.scanner');

    Route::get('/stock-opname/manual', function () {
        $assetCode = request('asset_code');

        $asset = Asset::where('asset_code', $assetCode)->first();

        if (! $asset) {
            return redirect()
                ->route('stock-opname.scanner')
                ->with('error', 'Asset dengan kode tersebut tidak ditemukan.');
        }

        return redirect()->route('assets.show', $asset->id);
    })->name('stock-opname.manual');
});

Route::post('/assets/{asset}/stock-opname', function (\Illuminate\Http\Request $request, Asset $asset) {

    $request->validate([
        'status' => 'required',
        'notes' => 'nullable|string',
    ]);

    StockOpname::create([
        'asset_id' => $asset->id,
        'opname_date' => now(),
        'status' => $request->status,
        'notes' => $request->notes,
    ]);

    return back()->with('success', 'Validasi stock opname berhasil.');
})
    ->middleware(['auth'])
    ->name('stock-opname.store');

require __DIR__ . '/auth.php';
