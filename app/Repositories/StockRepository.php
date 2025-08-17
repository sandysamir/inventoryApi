<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Repositories\StockRepositoryInterface;

class StockRepository implements StockRepositoryInterface
{
    public function forWarehouse(int $warehouseId)
    {
        return Stock::with('item')
            ->where('warehouse_id', $warehouseId)
            ->orderByDesc('updated_at')
            ->get();
    }

    public function getForUpdate(int $warehouseId, int $itemId)
    {
        return Stock::where('warehouse_id', $warehouseId)
            ->where('inventory_item_id', $itemId)
            ->lockForUpdate()
            ->first();
    }

    public function increase(int $warehouseId, int $itemId, int $qty): void
    {
        $stock = Stock::firstOrCreate(
            ['warehouse_id' => $warehouseId, 'inventory_item_id' => $itemId],
            ['quantity' => 0]
        );
        $stock->increment('quantity', $qty);
    }

    public function decrease(int $warehouseId, int $itemId, int $qty): void
    {
        $stock = Stock::where('warehouse_id', $warehouseId)
            ->where('inventory_item_id', $itemId)
            ->first();

        if (!$stock || $stock->quantity < $qty) {
            throw new \DomainException('Out of stock');
        }

        $stock->decrement('quantity', $qty);
    }
}
