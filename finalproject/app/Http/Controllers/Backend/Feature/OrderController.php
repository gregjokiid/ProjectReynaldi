<?php

namespace App\Http\Controllers\Backend\Feature;

use App\Http\Controllers\Controller;
use App\Mail\Invoice;
use App\Models\Feature\Order;
use App\Models\User;
use App\Repositories\CrudRepositories;
use App\Services\Feature\OrderAcceptService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    protected $order;
    public function __construct(Order $order, OrderAcceptService $orderAcceptService)
    {
        $this->order = new CrudRepositories($order);
        $this->orderAcceptService = $orderAcceptService;
    }

    public function index($status = null)
    {
        if($status == null){
            $data['order'] = $this->order->get();
        }else{
            $data['order'] = $this->order->Query()->where('status',$status)->get();
        }
        return view('backend.feature.order.index',compact('data'));
    }

    public function show($id)
    {
        $data['order'] = Order::find($id);
        $path = '/storage/file/order/payment/';
        $file_path = $data['order']->proof;
        return view('backend.feature.order.show',compact(['data', 'path', 'file_path']));
    }

    public function inputResi(Request $request)
    {
        $request->merge(['status' => 2]);
        $this->order->Query()->where('invoice_number',$request->invoice_number)->first()->update($request->only('status','receipt_number'));
        return back()->with('success',__('message.order_receipt'));
    }

    public function accept($id)
    {
        $this->orderAcceptService->process($id);
        $this->order->Query()->where('id',$id)->first()->update(['status' => 2]);
        return back()->with('success',__('message.order_received'));
    }

    public function refuse($id)
    {
        $this->order->Query()->where('id',$id)->first()->update(['status' => 4]);
        return back()->with('success',__('message.order_received'));
    }

    public function payOffline($id)
    {
        $this->orderAcceptService->process($id);
        $this->order->Query()->where('id',$id)->first()->update(['status' => 5]);
        $data['order'] = $this->order->Query()->where('id',$id)->first();
        $user = User::where('id', '=', $data['order']->user_id)->first();
        Mail::to($user->email)->send(new Invoice($data));
        return back()->with('success',__('message.order_received'));
    }
}
