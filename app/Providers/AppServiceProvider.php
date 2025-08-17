<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\InventoryRepositoryInterface;
use App\Repositories\StockRepositoryInterface;
use App\Repositories\WarehouseRepositoryInterface;
use App\Repositories\InventoryRepository;
use App\Repositories\StockRepository;
use App\Repositories\WarehouseRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(InventoryRepositoryInterface::class, InventoryRepository::class);
        $this->app->bind(StockRepositoryInterface::class, StockRepository::class);
        $this->app->bind(WarehouseRepositoryInterface::class, WarehouseRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
