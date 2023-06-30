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
        $order = Order::find($id);
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
        // dd($id);
        $request = request();
        $resi = $request->resi;
        $this->orderAcceptService->process($id);
        $this->order->Query()->where('id',$id)->first()->update(['status' => 2, 'receipt_number' => $resi]);
        $data['order'] = $this->order->Query()->where('id',$id)->first();
        $user = User::where('id', '=', $data['order']->user_id)->first();
        Mail::to($user->email)->send(new Invoice($data));
        return back()->with('success',__('message.order_received'));
    }

    public function refuse($id)
    {
        $this->order->Query()->where('id',$id)->first()->update(['status' => 4]);
        $data['order'] = $this->order->Query()->where('id',$id)->first();
        $user = User::where('id', '=', $data['order']->user_id)->first();
        Mail::to($user->email)->send(new Invoice($data));
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
