<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedMerienda extends Model
{
    protected $guarded = [];
    use HasFactory;
    public $table = "ordered_meriendas";
}
