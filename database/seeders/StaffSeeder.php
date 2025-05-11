<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('staff')->insert([
            [
                'name' => 'Eka',
                'no_telepon' => '6287780776114',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'Admin',
                'profile' => 'admin.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Syahril',
                'no_telepon' => '6287780776114',
                'email' => 'syahril@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'Pelanggan',
                'profile' => 'customer.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
