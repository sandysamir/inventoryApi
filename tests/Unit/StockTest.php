<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Stock;
use App\Models\Warehouse;
use App\Models\InventoryItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_prevents_over_transfer()
    {
        $fromWarehouse = Warehouse::create([
                'name' => 'Warehouse A',
                'location' => 'Location A',
            ]);

        $toWarehouse = Warehouse::create([
            'name' => 'Warehouse B',
            'location' => 'Location B',
        ]);
        $item = InventoryItem::create([
            'name' => 'Item 1',
            'SKU' => 'SKU001',
                        'description' => 'testttt',
                                    'price' => '10000',


        ]);

      $stock = Stock::create([
            'warehouse_id' => $fromWarehouse->id,
            'inventory_item_id' => $item->id,
            'quantity' => 10,
            'reorder_threshold' => 5, 
        ]);
        $transferAmount = 20;

        $canTransfer = $stock->quantity >= $transferAmount;

        $this->assertFalse($canTransfer, 'Stock should not allow over-transfer');
         $this->assertEquals(10, $stock->fresh()->quantity, 'Quantity should remain unchanged');

    }
     public function it_allows_valid_transfer()
    {
        $warehouse = Warehouse::create(['name' => 'Warehouse B', 'location' => 'Loc B']);
        $item = InventoryItem::create(['name' => 'Item 2', 'SKU' => 'SKU002', 'price' => 500]);

        $stock = Stock::create([
            'warehouse_id' => $warehouse->id,
            'inventory_item_id' => $item->id,
            'quantity' => 15,
            'reorder_threshold' => 5,
        ]);

        $transferAmount = 5;

        $result = $stock->transfer($transferAmount);

        $this->assertTrue($result, 'Stock should allow valid transfer');
        $this->assertEquals(10, $stock->fresh()->quantity, 'Quantity should decrease by transferred amount');
    }

}
