<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['description' => 'Akhlak', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Aqidah', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Buku Umum', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Fiqh', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Ibadah', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
