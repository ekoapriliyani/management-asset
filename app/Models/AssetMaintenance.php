<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetMaintenance extends Model
{
    protected $fillable = [
        'asset_id',
        'maintenance_date',
        'maintenance_type',
        'technician_name',
        'cost',
        'problem_description',
        'action_taken',
        'next_maintenance_date',
        'status',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
