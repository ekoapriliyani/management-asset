<?php

use App\Http\Controllers\AssetAssignmentController;
use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
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
});

require __DIR__ . '/auth.php';
