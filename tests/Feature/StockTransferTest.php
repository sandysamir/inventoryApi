<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Warehouse;
use App\Models\InventoryItem;
use App\Models\Stock;
use App\Models\StockTransfer;

class StockTransferTest extends TestCase
{

 public function it_fails_when_trying_to_transfer_more_than_available()
    {
        $warehouse = Warehouse::create(['name' => 'Main', 'location' => 'Cairo']);
        $item = InventoryItem::create(['name' => 'Laptop', 'sku' => 'LP-001', 'price' => 1000]);

        Stock::create([
            'warehouse_id' => $warehouse->id,
            'inventory_item_id' => $item->id,
            'quantity' => 5,
            'reorder_threshold' => 2,
        ]);

        $response = $this->postJson('/api/stock-transfers', [
            'from_warehouse_id' => $warehouse->id,
            'to_warehouse_id'   => $warehouse->id, 
            'inventory_item_id' => $item->id,
            'quantity'          => 10,
        ]);

        $response->assertStatus(422);
        $response->assertJson(['message' => 'Out of stock']);
    }
}
