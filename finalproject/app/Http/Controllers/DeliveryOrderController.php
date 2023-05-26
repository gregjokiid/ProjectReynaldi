<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use App\Models\Master\Product;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveryOrders = DeliveryOrder::all();
        $products = Product::all();
        return view('backend.deliveryOrder.index', compact('deliveryOrders', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('backend.deliveryOrder.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string',
            'quantity'=>'required|string',
            'price' => 'required|string',
            'receiver' => 'required|string',
        ]);

        DeliveryOrder::create([
            'product_id' => $data['product_id'],
            'name' => $data['name'],
            'quantity'=> $data['quantity'],
            'price' => $data['price'],
            'receiver' => $data['receiver'],
        ]);

        return redirect()->route('master.deliveryOrder.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryOrder $deliveryOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryOrder $deliveryOrder)
    {
        $products = Product::all();
        return view('backend.deliveryOrder.edit', compact('deliveryOrder', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryOrder $deliveryOrder)
    {
        $deliveryOrder->update($request->all());
        return redirect()->route('master.deliveryOrder.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryOrder $deliveryOrder)
    {
        $deliveryOrder->delete();
        return redirect()->route('master.deliveryOrder.index');
    }
}
