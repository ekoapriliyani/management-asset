<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\AssetCategory;
use App\Models\AssetMaintenance;
use App\Models\Location;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAssets = Asset::count();

        $availableAssets = Asset::where('status', 'available')->count();

        $maintenanceAssets = Asset::where('status', 'maintenance')->count();

        $brokenAssets = Asset::where('status', 'broken')->count();

        $totalCategories = AssetCategory::count();

        $totalLocations = Location::count();

        $assetStatuses = [
            'Available' => $availableAssets,
            'Maintenance' => $maintenanceAssets,
            'Broken' => $brokenAssets,
            'In Use' => Asset::where('status', 'in_use')->count(),
            'Disposed' => Asset::where('status', 'disposed')->count(),
        ];

        $recentMaintenances = AssetMaintenance::with('asset')
            ->latest()
            ->take(5)
            ->get();

        $recentAssignments = AssetAssignment::with('asset')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalAssets',
            'availableAssets',
            'maintenanceAssets',
            'brokenAssets',
            'totalCategories',
            'totalLocations',
            'assetStatuses',
            'recentMaintenances',
            'recentAssignments'
        ));
    }
}
