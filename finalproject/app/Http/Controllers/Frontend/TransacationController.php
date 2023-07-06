<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Invoice;
use App\Models\Feature\Order;
use App\Repositories\CrudRepositories;
use App\Services\Feature\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $order = $this->order->Query()->where('invoice_number',$invoice_number)->first();
        $data['order'] = $order;
        if(isset($order->receipt_number)){
            $key = env('BINDERBYTE_KEY', 'some32charstring');
            $ch = curl_init();
            $url = "https://api.binderbyte.com/v1/track?api_key=".$key."&courier=jne&awb=".$order->receipt_number;
            // dd($url);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);

            $order['tracking'] = json_decode($output);
            // dd(json_decode($output));

        }
        $path = '/storage/file/order/payment/';
        $file_path = $data['order']->proof;
        return view('frontend.transaction.show',compact(['data', 'path', 'file_path']));
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
        return back()->with('success',__('message.order_received'));
    }

    public function offlinePayment($invoice_number)
    {
        $this->order->Query()->where('invoice_number',$invoice_number)->first()->update(['status' => 5]);
        return back()->with('success',__('message.order_received'));
    }

    public function email($invoice_number)
    {
        $data['order'] = $this->order->Query()->where('invoice_number',$invoice_number)->first();
        Mail::to(Auth::user()->email)->send(new Invoice($data));
        return back()->with('success',__('message.order_received'));
    }
}
