<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StockRepositoryInterface;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Cache;

class WarehouseController extends Controller
{
    public function __construct(private StockRepositoryInterface $stocks) {}

    public function show(Warehouse $warehouse)
    {
        $cacheKey = "warehouse:{$warehouse->id}:inventory";

        $data = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($warehouse) {
            return $this->stocks->forWarehouse($warehouse->id);
        });

        return response()->json([
            'warehouse' => $warehouse->only(['id','name','location']),
            'inventory' => $data,
        ], 200);
    }
}
