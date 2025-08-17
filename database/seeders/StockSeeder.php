<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stock;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Stock::insert([
            ['warehouse_id' => 1, 'inventory_item_id' => 1, 'quantity' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['warehouse_id' => 1, 'inventory_item_id' => 2, 'quantity' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['warehouse_id' => 2, 'inventory_item_id' => 3, 'quantity' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['warehouse_id' => 3, 'inventory_item_id' => 4, 'quantity' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['warehouse_id' => 2, 'inventory_item_id' => 1, 'quantity' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
