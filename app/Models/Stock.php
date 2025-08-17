<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{  
    protected $fillable = ['warehouse_id', 'inventory_item_id', 'quantity'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
   
    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id','id');
    }

}