<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merienda extends Model
{
    protected $guarded = [];
    public function ordered_products()
    {
        return $this->belongsToMany(Order::class, 'ordered_products', 'merienda_id', 'order_id');
        
    }
}
