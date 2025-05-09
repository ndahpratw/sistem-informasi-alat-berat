<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('karyawans')->insert([
            ['name' => 'Andi Saputra',     'Posisi' => 'Manager'],
            ['name' => 'Budi Santoso',     'Posisi' => 'Supervisor'],
            ['name' => 'Citra Dewi',       'Posisi' => 'Staff Administrasi'],
            ['name' => 'Dedi Kurniawan',   'Posisi' => 'Teknisi'],
            ['name' => 'Eka Fitriani',     'Posisi' => 'Customer Service'],
            ['name' => 'Fajar Nugroho',    'Posisi' => 'Marketing'],
            ['name' => 'Gina Amelia',      'Posisi' => 'HRD'],
            ['name' => 'Hendra Saputra',   'Posisi' => 'Logistik'],
            ['name' => 'Indah Permata',    'Posisi' => 'Keuangan'],
            ['name' => 'Joko Priyono',     'Posisi' => 'Security'],
        ]);
    }
}
