<?php

namespace App\Models\Master;

use App\Models\DeliveryOrder;
use App\Models\Feature\Order;
use App\Models\Feature\OrderDetail;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['thumbnails_path','price_rupiah','total_sold'];

    public function Category()
    {
        return $this->belongsTo(Category::class,'categories_id');
    }

    public function OrderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getThumbnailsPathAttribute()
    {
        return asset('storage/' . $this->thumbnails);
    }

    public function getPriceRupiahAttribute()
    {
        return "Rp " . number_format($this->price,0,',','.');
    }

    public function getTotalSoldAttribute()
    {
        return $this->OrderDetails()->whereHas('Order',function($q){
            $q->whereIn('status',[2,3]);
        })->sum('qty');
    }

    public function PurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
}
