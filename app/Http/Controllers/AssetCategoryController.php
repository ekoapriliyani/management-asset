<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use Illuminate\Http\Request;

class AssetCategoryController extends Controller
{
    public function index()
    {
        $categories = AssetCategory::latest()->paginate(10);

        return view('asset-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('asset-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:asset_categories,code',
            'description' => 'nullable|string',
        ]);

        AssetCategory::create($request->only([
            'name',
            'code',
            'description',
        ]));

        return redirect()
            ->route('asset-categories.index')
            ->with('success', 'Kategori asset berhasil ditambahkan.');
    }

    public function edit(AssetCategory $assetCategory)
    {
        return view('asset-categories.edit', compact('assetCategory'));
    }

    public function update(Request $request, AssetCategory $assetCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:asset_categories,code,' . $assetCategory->id,
            'description' => 'nullable|string',
        ]);

        $assetCategory->update($request->only([
            'name',
            'code',
            'description',
        ]));

        return redirect()
            ->route('asset-categories.index')
            ->with('success', 'Kategori asset berhasil diperbarui.');
    }

    public function destroy(AssetCategory $assetCategory)
    {
        $assetCategory->delete();

        return redirect()
            ->route('asset-categories.index')
            ->with('success', 'Kategori asset berhasil dihapus.');
    }
}
