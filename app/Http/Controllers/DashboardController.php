<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\AssetCategory;
use App\Models\AssetMaintenance;
use App\Models\AssetRequest;
use App\Models\Location;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAssets = Asset::count();

        $availableAssets = Asset::where('status', 'available')->count();

        $inUseAssets = Asset::where('status', 'in_use')->count();

        $maintenanceAssets = Asset::where('status', 'maintenance')->count();

        $brokenAssets = Asset::where('status', 'broken')->count();

        $disposedAssets = Asset::where('status', 'disposed')->count();
        $pendingRequests = AssetRequest::where('status', 'pending')->count();

        $totalCategories = AssetCategory::count();

        $totalLocations = Location::count();

        $assetStatuses = [
            'Available' => $availableAssets,
            'In Use' => $inUseAssets,
            'Maintenance' => $maintenanceAssets,
            'Broken' => $brokenAssets,
            'Disposed' => $disposedAssets,
        ];

        $recentAssignments = AssetAssignment::with([
            'asset',
            'location'
        ])
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
            'pendingRequests',
            'assetStatuses',
            'recentAssignments',
            'recentMaintenances'
        ));
    }
}
