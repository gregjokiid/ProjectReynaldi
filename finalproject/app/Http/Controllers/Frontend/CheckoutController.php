<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Feature\Cart;
use App\Models\Feature\Order;
use App\Models\Setting\ShippingAddress;
use App\Repositories\CrudRepositories;
use App\Services\Feature\CartService;
use App\Services\Feature\CheckoutService;
use App\Services\Rajaongkir\RajaongkirService;
use Exception;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    protected $rajaongkirService,$checkoutService,$cartService;
    public function __construct(RajaongkirService $rajaongkirService,CheckoutService $checkoutService,CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->rajaongkirService = $rajaongkirService;
        $this->checkoutService = $checkoutService;
    }

    public function index()
    {
        $data['carts'] = $this->cartService->getUserCart();
        $data['provinces'] = $this->rajaongkirService->getProvince();
        $data['shipping_address'] = ShippingAddress::first();
        return view('frontend.checkout.index',compact('data'));
    }

    public function process(Request $request)
    {
        try{
            $this->checkoutService->process($request->all());
            return redirect()->route('transaction.index')->with('success',__('message.order_success'));
        }catch(Exception $e){
            dd($e);
        }
    }

    public function offline()
    {
        $data['carts'] = $this->cartService->getUserCart();
        $data['provinces'] = $this->rajaongkirService->getProvince();
        $data['shipping_address'] = ShippingAddress::first();
        return view('frontend.checkout.offline',compact('data'));
    }

    public function offlineProcess(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'string',
            'total_pay' => 'string',
            'status' => 'string',
            'destination' => 'string',
            'address_detail' => 'string',
            'courier' => 'string',
            'subtotal' => 'string',
            'shipping_cost' => 'string',
            'shipping_method' => 'string',
            'total_weight' => 'string',
            'invoice_number' => 'string',
            'recipient_name' => 'string',
            'phone_number' => 'string',
        ]);

        Order::create([
            'user_id' => $data['user_id'],
            'total_pay' => $data['total_pay'],
            'status' => $data['status'],
            'destination' => $data['destination'],
            'address_detail' => $data['address_detail'],
            'courier' => $data['courier'],
            'subtotal' => $data['subtotal'],
            'shipping_cost' => $data['shipping_cost'],
            'shipping_method' => $data['shipping_method'],
            'total_weight' => $data['total_weight'],
            'invoice_number' => $data['invoice_number'],
            'recipient_name' => $data['recipient_name'],
            'phone_number' => $data['phone_number'],
        ]);

        return redirect()->route('fragrance.index');
    }
}
