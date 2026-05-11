<?php

use App\Http\Controllers\AssetAssignmentController;
use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Models\Asset;
use App\Models\AssetAssignment;
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

    $recentAssignments = AssetAssignment::with(['asset', 'location'])
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard', compact(
        'totalAssets',
        'availableAssets',
        'inUseAssets',
        'maintenanceAssets',
        'brokenAssets',
        'recentAssignments'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
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
});

require __DIR__ . '/auth.php';
