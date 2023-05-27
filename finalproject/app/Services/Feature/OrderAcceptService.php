<?php
namespace App\Services\Feature;

use App\Models\Feature\Order;
use App\Models\Feature\OrderDetail;
use App\Models\Master\Product;
use App\Repositories\CrudRepositories;
use Illuminate\Support\Str;

class OrderAcceptService{

    protected $order,$ordeDetail,$product;
    protected $cartService;
    public function __construct(Order $order,OrderDetail $orderDetail,CartService $cartService,Product $product)
    {
        $this->order = new CrudRepositories($order);
        $this->orderDetail = new CrudRepositories($orderDetail);
        $this->product = new CrudRepositories($product);
        $this->cartService = $cartService;
    }

    public function process($request)
    {
        $orders = $this->orderDetail->Query()->where('order_id','=',$request)->get();
        foreach ($orders as $order){
            $cek = $this->product->Query()->where(['id' => $order->product_id])->first();
            $cek->stock = $cek->stock - $order->qty;
            $cek->update();
        }
    }

}
