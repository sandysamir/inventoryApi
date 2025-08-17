<?php

namespace App\Repositories;

interface StockRepositoryInterface
{
    public function forWarehouse(int $warehouseId);
    public function getForUpdate(int $warehouseId, int $itemId);
    public function increase(int $warehouseId, int $itemId, int $qty): void;
    public function decrease(int $warehouseId, int $itemId, int $qty): void;
}