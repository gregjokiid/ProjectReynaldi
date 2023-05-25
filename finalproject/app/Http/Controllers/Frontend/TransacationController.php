<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Feature\Order;
use App\Repositories\CrudRepositories;
use App\Services\Feature\OrderService;
use Illuminate\Http\Request;

class TransacationController extends Controller
{
    protected $orderService;
    protected $order;
    public function __construct(OrderService $orderService,Order $order)
    {
        $this->orderService = $orderService;
        $this->order = new CrudRepositories($order);
    }

    public function index()
    {
        $data['orders'] = $this->orderService->getUserOrder(auth()->user()->id);
        return view('frontend.transaction.index',compact('data'));
    }

    public function show($invoice_number)
    {
        $data['order'] = $this->order->Query()->where('invoice_number',$invoice_number)->first();
        return view('frontend.transaction.show',compact('data'));
    }

    public function received($invoice_number)
    {
        $this->order->Query()->where('invoice_number',$invoice_number)->first()->update(['status' => 3]);
        return back()->with('success',__('message.order_received'));
    }

    public function canceled($invoice_number)
    {
        $this->order->Query()->where('invoice_number',$invoice_number)->first()->update(['status' => 4]);
        return back()->with('success',__('message.order_canceled'));
    }

    public function payment($invoice_number)
    {
        $data['order'] = $this->order->Query()->where('invoice_number',$invoice_number)->first();
        return view('frontend.transaction.payment',compact('data'));
    }

    public function paymentChecking(Request $request,$id)
    {
        if(isset($request->payment)){
            $this->order->update($id,$request->all('_token'),true,['thumbnails'],'product/thumbnails');
        }else{
            $this->order->update($id,$request->except('_token'));
        }
        return redirect()->route('master.product.index')->with('success',__('message.store'));
    }

    public function edit($id)
    {
        $data['product'] = $this->product->find($id);
        $data['category'] = $this->category->get();
        return view('backend.master.product.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        if(isset($request->thumbnails)){
            $this->product->update($id,$request->all('_token'),true,['thumbnails'],'product/thumbnails');
        }else{
            $this->product->update($id,$request->except('_token'));
        }
        return redirect()->route('master.product.index')->with('success',__('message.store'));
    }
}
