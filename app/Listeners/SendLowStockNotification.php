<?php

namespace App\Listeners;

use App\Events\LowStockDetected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendLowStockNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LowStockDetected $event): void
    {
        Log::info('Low stock detected', [
            'warehouse_id' => $event->stock->warehouse_id,
            'item_id' => $event->stock->inventory_item_id,
            'quantity' => $event->stock->quantity,
        ]);
    }    
}
