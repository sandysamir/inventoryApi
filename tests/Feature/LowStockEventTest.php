<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Stock;
use App\Events\LowStockDetected;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use App\Listeners\SendLowStockNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LowStockEventTest extends TestCase
{
    use RefreshDatabase;

    public function it_dispatches_low_stock_event_and_listener_is_queued()
    {
       Event::fake();

        $from = Warehouse::create(['name' => 'From', 'location' => 'Cairo']);
        $to   = Warehouse::create(['name' => 'To', 'location' => 'Alex']);
        $item = InventoryItem::create(['name' => 'Laptop', 'sku' => 'LP-002', 'price' => 1000]);

        Stock::create([
            'warehouse_id' => $from->id,
            'inventory_item_id' => $item->id,
            'quantity' => 5,
            'reorder_threshold' => 5,
        ]);

        Stock::create([
            'warehouse_id' => $to->id,
            'inventory_item_id' => $item->id,
            'quantity' => 0,
            'reorder_threshold' => 1,
        ]);

        $this->postJson('/api/stock-transfers', [
            'from_warehouse_id' => $from->id,
            'to_warehouse_id'   => $to->id,
            'inventory_item_id' => $item->id,
            'quantity'          => 5,
        ])->assertStatus(201);

        Event::assertDispatched(LowStockDetected::class);
    }
}
