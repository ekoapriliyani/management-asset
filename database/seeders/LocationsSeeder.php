<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            [
                'code' => 'QC',
                'name' => 'Ruang QC',
                'department' => 'Quality Control',
                'description' => 'Lokasi untuk aktivitas Quality Control',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'OPR',
                'name' => 'Ruang Operation',
                'department' => 'Operation',
                'description' => 'Lokasi untuk aktivitas operasional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'TS',
                'name' => 'Ruang Technical Support',
                'department' => 'Technical Support',
                'description' => 'Lokasi untuk tim Technical Support',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PRO',
                'name' => 'Area Produksi',
                'department' => 'Produksi',
                'description' => 'Lokasi untuk kegiatan produksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'HRGA',
                'name' => 'Ruang HRGA',
                'department' => 'HRGA',
                'description' => 'Lokasi untuk aktivitas HRGA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'WH',
                'name' => 'Warehouse',
                'department' => 'Warehouse',
                'description' => 'Lokasi warehouse perusahaan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
