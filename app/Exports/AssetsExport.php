<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssetsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Asset::with(['category', 'location'])
            ->orderBy('asset_code')
            ->get()
            ->map(function ($asset) {
                return [
                    'Kode Asset' => $asset->asset_code,
                    'Nama Asset' => $asset->name,
                    'Kategori' => $asset->category->name ?? '-',
                    'Lokasi' => $asset->location->name ?? '-',
                    'Brand' => $asset->brand ?? '-',
                    'Model' => $asset->model ?? '-',
                    'Serial Number' => $asset->serial_number ?? '-',
                    'Status' => strtoupper(str_replace('_', ' ', $asset->status)),
                    'Tanggal Beli' => $asset->purchase_date ?? '-',
                    'Harga Beli' => $asset->purchase_price ?? 0,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Kode Asset',
            'Nama Asset',
            'Kategori',
            'Lokasi',
            'Brand',
            'Model',
            'Serial Number',
            'Status',
            'Tanggal Beli',
            'Harga Beli',
        ];
    }
}
