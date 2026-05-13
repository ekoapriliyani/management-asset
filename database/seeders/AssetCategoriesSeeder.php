<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('asset_categories')->insert([
            [
                'name' => 'Furnitur',
                'code' => 'F',
                'description' => 'Kategori aset berupa furnitur seperti meja, kursi, lemari.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mesin',
                'code' => 'M',
                'description' => 'Kategori aset berupa mesin produksi atau operasional.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Peralatan Kantor',
                'code' => 'PK',
                'description' => 'Kategori aset berupa peralatan kantor seperti komputer, printer.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kendaraan',
                'code' => 'K',
                'description' => 'Kategori aset berupa kendaraan operasional perusahaan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
