<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Warehouse;
use App\Models\InventoryItem;
use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockTransferFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_transfers_stock_successfully()
    {
        $from = Warehouse::create();
        $to   = Warehouse::create();
        $item = InventoryItem::create();

        Stock::create([
            'warehouse_id' => $from->id,
            'inventory_item_id' => $item->id,
            'quantity' => 20,
        ]);

        $this->postJson('/stock-transfers', [
            'from_warehouse_id' => $from->id,
            'to_warehouse_id' => $to->id,
            'inventory_item_id' => $item->id,
            'quantity' => 5,
        ])->assertStatus(201)
          ->assertJson(['message' => 'Transfer completed']);

        $this->assertDatabaseHas('stocks', [
            'warehouse_id' => $from->id,
            'inventory_item_id' => $item->id,
            'quantity' => 15,
        ]);

        $this->assertDatabaseHas('stocks', [
            'warehouse_id' => $to->id,
            'inventory_item_id' => $item->id,
            'quantity' => 5,
        ]);
    }
}
