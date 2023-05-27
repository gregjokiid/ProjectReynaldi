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

    public function paymentChecking(Request $request, $invoice_number)
    {
        $request->validate([
            'payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->payment->extension();

        $request->payment->move(storage_path('app/public/file/order/payment'), $imageName);

        $this->order->Query()->where('invoice_number',$invoice_number)->first()->update(['proof' => $imageName]);
        $this->order->Query()->where('invoice_number',$invoice_number)->first()->update(['status' => 1]);

        return redirect()->route('transaction.index')->with('success',__('message.store'));
    }

    public function offline($invoice_number)
    {
        $this->order->Query()->where('invoice_number',$invoice_number)->first()->update(['status' => 6]);
        $data['order'] = $this->order->Query()->where('invoice_number',$invoice_number)->first();
        return view('frontend.transaction.offline',compact('data'));
    }

    public function offlinePayment($invoice_number)
    {
        $this->order->Query()->where('invoice_number',$invoice_number)->first()->update(['status' => 5]);
        return back()->with('success',__('message.order_received'));
    }
}
