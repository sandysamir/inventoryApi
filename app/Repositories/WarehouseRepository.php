<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\CursorPaginator;

interface InventoryItemRepository
{
    public function searchPaginated(?string $q, ?float $minPrice, ?float $maxPrice, ?int $warehouseId, int $perPage = 15): CursorPaginator;
    public function find(int $id);
}


