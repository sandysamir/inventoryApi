<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Warehouse::insert([
            ['name' => 'Cairo Main Warehouse', 'location' => 'Cairo, Egypt', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alexandria Storage', 'location' => 'Alexandria, Egypt', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Giza Depot', 'location' => 'Giza, Egypt', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
