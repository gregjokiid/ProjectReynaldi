<?php
namespace App\Services\Feature;

use App\Models\Feature\Order;
use App\Models\Feature\OrderDetail;
use App\Repositories\CrudRepositories;
use Illuminate\Support\Str;

class CheckoutService{

    protected $order,$ordeDetail;
    protected $cartService;
    public function __construct(Order $order,OrderDetail $orderDetail,CartService $cartService)
    {
        $this->order = new CrudRepositories($order);
        $this->orderDetail = new CrudRepositories($orderDetail);
        $this->cartService = $cartService;
    }

    public function process($request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $userCart = $this->cartService->getUserCart();
        $subtotal =  $userCart->sum('total_price_per_product');
        $total_pay = $subtotal + 20000;
        foreach($userCart as $cart){
            $dataOrder = [
                'invoice_number' => $cart->id.auth()->user()->id.date("Ymd"),
                'total_pay' => $total_pay,
                'recipient_name' => $request['recipient_name'],
                'destination' =>  "Surabaya, Jawa Timur",
                'address_detail' => $request['address_detail'],
                'courier' => "kurir",
                'subtotal' => $subtotal,
                'shipping_cost' => "20000",
                'shipping_method' => "kurir",
                'total_weight' => $request['total_weight'],
                'status' => 0,
                'user_id' => auth()->user()->id
            ];
        }
        $orderStore = $this->order->store($dataOrder);
        foreach($userCart as $cart){
            $this->orderDetail->store([
                'order_id' => $orderStore->id,
                'product_id' => $cart->product_id,
                'price' => $cart->price,
                'qty' => $cart->qty
            ]);
        }
        $this->cartService->deleteUserCart();
    }

    public function offlineProcess($request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $userCart = $this->cartService->getUserCart();
        $subtotal =  $userCart->sum('total_price_per_product');
        $total_pay = $subtotal;
        foreach($userCart as $cart){
            $dataOrder = [
                'invoice_number' => $cart->id.auth()->user()->id.date("Ymd"),
                'total_pay' => $total_pay,
                'recipient_name' => auth()->user()->name,
                'destination' =>  "offline",
                'address_detail' => "offline",
                'courier' => "offline",
                'subtotal' => $subtotal,
                'shipping_cost' => "offline",
                'shipping_method' => "offline",
                'total_weight' => "offline",
                'status' => 6,
                'user_id' => auth()->user()->id
            ];
        }
        $orderStore = $this->order->store($dataOrder);
        foreach($userCart as $cart){
            $this->orderDetail->store([
                'order_id' => $orderStore->id,
                'product_id' => $cart->product_id,
                'price' => $cart->price,
                'qty' => $cart->qty
            ]);
        }
        $this->cartService->deleteUserCart();
    }
}
