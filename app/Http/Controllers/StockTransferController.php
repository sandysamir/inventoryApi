<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StockRepositoryInterface;
use App\Models\StockTransfer;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use App\Events\LowStockDetected;
use DomainException;  
use Illuminate\Support\Facades\Cache;

class StockTransferController extends Controller
{
    public function __construct(private StockRepositoryInterface $stocks) {
            
        $this->stocks = $stocks;

    }

    /**
     * Display a listing of the resource.
     */
    public function store(Request $request)
    {
        $itemId = $request->inventory_item_id;
        $fromId = $request->from_warehouse_id;
        $toId   = $request->to_warehouse_id;
        $qty    = $request->quantity;

        try {
            DB::transaction(function () use ($fromId, $toId, $itemId, $qty) {
                $fromStock = $this->stocks->getForUpdate($fromId, $itemId);

                if (!$fromStock || $fromStock->quantity < $qty) {
                    throw new DomainException('Out of stock');
                }

                $this->stocks->decrease($fromId, $itemId, $qty);
                $this->stocks->increase($toId, $itemId, $qty);

                StockTransfer::create([
                    'inventory_item_id' => $itemId,
                    'from_warehouse_id' => $fromId,
                    'to_warehouse_id'   => $toId,
                    'quantity'          => $qty
                ]);

                $freshFrom = Stock::where('warehouse_id', $fromId)
                    ->where('inventory_item_id', $itemId)
                    ->first();

                if ($freshFrom && $freshFrom->quantity <= $freshFrom->reorder_threshold) {
                    LowStockDetected::dispatch($freshFrom);
                }
            });

        } catch (DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
        Cache::forget("warehouse:{$fromId}:inventory");
        Cache::forget("warehouse:{$toId}:inventory");

        return response()->json(['message' => 'Transfer completed'], 201);
    }
}
