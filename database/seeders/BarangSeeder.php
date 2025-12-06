<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('barangs')->insert([
            [
                'nama' => 'Laptop Asus',
                'kategori' => 'Elektronik',
                'stok' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Monitor Samsung',
                'kategori' => 'Elektronik',
                'stok' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Keyboard Logitech',
                'kategori' => 'Aksesoris',
                'stok' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

