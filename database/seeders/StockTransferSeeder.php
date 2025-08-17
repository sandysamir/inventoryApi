<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StockTransfer;

class StockTransferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       StockTransfer::insert([
            ['from_warehouse_id' => 1, 'to_warehouse_id' => 2, 'inventory_item_id' => 1, 'quantity' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['from_warehouse_id' => 3, 'to_warehouse_id' => 1, 'inventory_item_id' => 4, 'quantity' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['from_warehouse_id' => 2, 'to_warehouse_id' => 3, 'inventory_item_id' => 3, 'quantity' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
