<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['status_name','status_name_text','one_product','array_product'];

    public function Customer()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function OrderDetail()
    {
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }

    public function OrderTrack()
    {
        return $this->hasMany(OrderTrack::class,'order_id','id');
    }

    public function getStatusNameTextAttribute()
    {
        $status = $this->status;
        if($status == 0){
            return 'Menunggu Pembayaran';
        }elseif($status == 1){
            return 'Mengkonfirmasi Pembayaran';
        }elseif($status == 2){
            return 'Pembayaran Selesai';
        }elseif($status == 3){
            return 'Pesanan Selesai';
        }elseif($status == 4){
            return 'Pesanan Dibatalkan';
        }elseif($status == 5){
            return 'Pesanan Selesai - Offline';
        }elseif($status == 6){
            return 'Menunggu Pembayaran - Offline';
        }
    }

    public function getStatusNameAttribute()
    {
        $status = [
            '0' => '<div class="badge badge-warning">Menunggu Pembayaran</div>',
            '1' => '<div class="badge badge-primary">Mengkonfirmasi Pembayaran</div>',
            '2' => '<div class="badge badge-info">Pembayaran Selesai</div>',
            '3' => '<div class="badge badge-success">Pesanan Selesai</div>',
            '4' => '<div class="badge badge-secondary">Pesanan Dibatalkan</div>',
            '5' => '<div class="badge badge-secondary">Pesanan Selesai - Offline</div>',
            '6' => '<div class="badge badge-secondary">Menunggu Pembayaran - Offline</div>',
        ];
        return $status[$this->status];
    }

    public function getOneProductAttribute()
    {
        $product = $this->OrderDetail[0]->product->name;
        if($this->OrderDetail()->count() > 1){
            $product .= ' & ' . $this->OrderDetail()->count() . 'produk lainnya';
        }
        return $product;
    }

    public function getArrayProductAttribute()
    {
        $product = [];
        foreach($this->OrderDetail()->get() as $detail){
            array_push($product,[
                'id' => $detail->product->id,
                'price' => $detail->product->price,
                'quantity' => $detail->qty,
                'name' => $detail->product->name,
            ]);
        }
        return $product;
    }
}
