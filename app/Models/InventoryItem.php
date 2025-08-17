<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{

    protected $fillable = ['name', 'SKU', 'description', 'price'];

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }


     public function scopeSearch($q, ?string $term)
    {
        if (!$term) return $q;
        return $q->where(fn($w)=>$w->where('name','like',"%{$term}%")
                                   ->orWhere('SKU','like',"%{$term}%"));
    }
    
    public function scopePriceBetween($q, $min=null, $max=null)
    {
        if ($min !== null) $q->where('price','>=',$min);
        if ($max !== null) $q->where('price','<=',$max);
        return $q;
    }
}
