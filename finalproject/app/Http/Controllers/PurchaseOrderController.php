<?php

namespace App\Http\Controllers;

use App\Models\Master\Product;
use App\Models\PurchaseOrder;
use App\Repositories\CrudRepositories;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::all();
        $products = Product::all();
        return view('backend.purchaseOrder.index', compact('purchaseOrders', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('backend.purchaseOrder.create', compact('products'));
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
        ]);

        PurchaseOrder::create([
            'product_id' => $data['product_id'],
            'name' => $data['name'],
            'quantity'=> $data['quantity'],
            'price' => $data['price'],
        ]);

        return redirect()->route('master.purchaseOrder.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $products = Product::all();
        return view('backend.purchaseOrder.edit', compact('purchaseOrder', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->update($request->all());
        return redirect()->route('master.purchaseOrder.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function delete(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return redirect()->route('master.purchaseOrder.index');
    }
}
