<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
    
    protected $fillable = ['order_id', 'product_id', 'amount'];
}
