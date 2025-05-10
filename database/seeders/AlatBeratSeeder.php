<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlatBeratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('alats')->insert([
            [
                'nama_alat' => 'Traktor Mini',
                'tipe' => 'Pertanian',
                'stok' => 5,
                'harga_sewa' => 150000.00,
                'deskripsi' => 'Traktor mini cocok untuk lahan sempit dan mudah dioperasikan.',
                'gambar' => 'traktor mini.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_alat' => 'Cultivator',
                'tipe' => 'Pertanian',
                'stok' => 4,
                'harga_sewa' => 200000.00,
                'deskripsi' => 'Mesin pengolah tanah untuk persiapan tanam.',
                'gambar' => 'cultivator.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
