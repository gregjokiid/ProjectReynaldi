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
        $total_pay = $subtotal + $request['shipping_cost'];
        $dataOrder = [
            'invoice_number' => auth()->user()->id.date("YmdHis"),
            'total_pay' => $total_pay,
            'recipient_name' => $request['recipient_name'],
            'destination' =>  $request['city_id'] . ', ' . $request['province_id'] ,
            'address_detail' => $request['address_detail'],
            'courier' => $request['courier'],
            'subtotal' => $subtotal,
            'shipping_cost' => $request['shipping_cost'],
            'shipping_method' => $request['shipping_method'],
            'total_weight' => $request['total_weight'],
            'status' => 0,
            'user_id' => auth()->user()->id
        ];
        $orderStore = $this->order->store($dataOrder);
        foreach($userCart as $cart){
            $this->orderDetail->store([
                'order_id' => $orderStore->id,
                'product_id' => $cart->product_id,
                'qty' => $cart->qty
            ]);
        }
        $this->cartService->deleteUserCart();
    }

}
