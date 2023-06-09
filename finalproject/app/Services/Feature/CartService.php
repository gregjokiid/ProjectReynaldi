<?php
namespace App\Services\Feature;

use App\Models\Feature\Cart;
use App\Models\Master\Product;
use App\Repositories\CrudRepositories;
use Illuminate\Support\Str;
class CartService{

    protected $cart;
    public function __construct(Cart $cart)
    {
        $this->cart = new CrudRepositories($cart);
    }

    public function store($data)
    {
        $cek = $this->cart->Query()->where(['user_id' => auth()->user()->id,'product_id' => $data['cart_product_id']])->first();
        $product = Product::where('id', $data['cart_product_id'])->first();
        if($cek){
            $cek->qty = $cek->qty + $data['cart_qty'];
            if($cek->qty <= $product->stock){
                $cek->update();
            } else{
                $cek->qty = $product->stock;
                $cek->update();
            }
        }else{
            $this->cart->store([
                'product_id' => $data['cart_product_id'],
                'price'      => $data['cart_price'],
                'qty'        => $data['cart_qty'],
                'user_id'    => auth()->user()->id,
            ]);
        }
    }

    public function update($data)
    {
        $cek = $this->cart->Query()->where(['user_id' => auth()->user()->id,'product_id' => $data['cart_product_id']])->first();
        $product = Product::where('id', $data['cart_product_id'])->first();
        if($cek){
            $cek->qty = $cek->qty + $data['cart_qty'];
            if($cek->qty <= $product->stock){
                $cek->update();
            } else{
                $cek->qty = $product->stock;
                $cek->update();
            }
        }else{
            $this->cart->store([
                'product_id' => $data['cart_product_id'],
                'price'      => $data['cart_price'],
                'qty'        => $data['cart_qty'],
                'user_id'    => auth()->user()->id,
            ]);
        }
    }

    public function getUserCart()
    {
        return $this->cart->Query()->where('user_id',auth()->user()->id)->get();
    }

    public function deleteUserCart()
    {
        return $this->cart->Query()->where('user_id',auth()->user()->id)->delete();
    }

}
