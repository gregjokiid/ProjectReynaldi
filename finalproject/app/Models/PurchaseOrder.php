<?php

namespace App\Models;

use App\Models\Master\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'supplier_id',
        'status',
        'qty',
        'price',
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
}
