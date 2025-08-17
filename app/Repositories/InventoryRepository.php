<?php

namespace App\Repositories;
use App\Repositories\InventoryRepositoryInterface;
use App\Models\InventoryItem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

  class InventoryRepository implements InventoryRepositoryInterface
{
      
public function search(array $filters, int $perPage = 10)
{
    $page = request()->get('page', 1);
    $perPage = min(max((int)($filters['per_page'] ?? $perPage), 1), 100);
    $cacheKey = $this->makeCacheKey($filters, $perPage, $page);

    return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($filters, $perPage, $page) {
        $q = InventoryItem::query();

        if (!empty($filters['q'])) {
            $term = $filters['q'];
            $q->where(function ($w) use ($term) {
                $w->where('name', 'like', "%{$term}%")
                  ->orWhere('sku', 'like', "%{$term}%");
            });
        }

        if (isset($filters['min_price'])) {
            $q->where('price', '>=', (float)$filters['min_price']);
        }

        if (isset($filters['max_price'])) {
            $q->where('price', '<=', (float)$filters['max_price']);
        }

        if (!empty($filters['warehouse_id'])) {
            $wid = (int)$filters['warehouse_id'];
            $q->whereHas('stocks', fn($w) => $w->where('warehouse_id', $wid));
        }

        $results = $q->orderBy('name')->get();

        $total = $results->count();
        $items = $results->forPage($page, $perPage)->values();

        return new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    });
}

   public function find(int $id)
    {
        return Cache::remember("inventory_item_{$id}", now()->addMinutes(10), function () use ($id) {
            return InventoryItem::findOrFail($id);
        });
    }

        protected function makeCacheKey(array $filters, int $perPage, int $page): string
    {
            return 'inventory_search_' . md5(json_encode($filters) . "_page_{$page}_perpage_{$perPage}");

    }
}
