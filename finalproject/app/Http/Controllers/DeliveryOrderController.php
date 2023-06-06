<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Repositories\CrudRepositories;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    protected $purchaseOrder;
    public function __construct(PurchaseOrder $purchaseOrder)
    {
        $this->purchaseOrder = new CrudRepositories($purchaseOrder);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::where('status', '=', 0)->get();
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('backend.purchaseOrder.index', compact('purchaseOrders', 'products', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('backend.purchaseOrder.create', compact('products', 'suppliers'));
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
            'supplier_id' => 'required|integer',
            'status' => 'required|integer',
            'qty'=>'required|integer',
        ]);

        PurchaseOrder::create([
            'product_id' => $data['product_id'],
            'supplier_id' => $data['supplier_id'],
            'status' => $data['status'],
            'qty' => $data['qty'],
        ]);

        return redirect()->route('purchaseOrder.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchaseOrder = PurchaseOrder::find($id);
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('backend.purchaseOrder.edit', compact('purchaseOrder', 'products', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->purchaseOrder->update($id,$request->except('_token'));
        return redirect()->route('purchaseOrder.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->purchaseOrder->hardDelete($id);
        return back()->with('success',__('message.harddelete'));
    }
}
