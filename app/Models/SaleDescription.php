<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sale_id',
        'price',
        'subtotal',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }
}
