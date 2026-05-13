<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetRequest extends Model
{
    protected $fillable = [
        'user_id',
        'asset_category_id',
        'assigned_asset_id',
        'department',
        'reason',
        'status',
        'admin_notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    public function assignedAsset()
    {
        return $this->belongsTo(Asset::class, 'assigned_asset_id');
    }
}
