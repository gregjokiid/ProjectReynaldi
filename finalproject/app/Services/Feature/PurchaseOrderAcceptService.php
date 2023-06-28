<?php
namespace App\Services\Feature;

use App\Models\Feature\Order;
use App\Models\Feature\OrderDetail;
use App\Models\Master\Product;
use App\Models\PurchaseOrder;
use App\Repositories\CrudRepositories;
use Illuminate\Support\Str;

class PurchaseOrderAcceptService{

    protected $order,$ordeDetail,$product, $purchaseOrder;
    public function __construct(Order $order,OrderDetail $orderDetail,Product $product, PurchaseOrder $purchaseOrder)
    {
        $this->order = new CrudRepositories($order);
        $this->orderDetail = new CrudRepositories($orderDetail);
        $this->product = new CrudRepositories($product);
        $this->purchaseOrder = new CrudRepositories($purchaseOrder);
    }

    public function process($request)
    {
        $purchaseOrders = $this->purchaseOrder->Query()->where('id','=',$request)->get();
        foreach ($purchaseOrders as $purchaseOrder2){
            $cek = $this->product->Query()->where(['id' => $purchaseOrder2->product_id])->first();
            $cek->stock = $cek->stock + $purchaseOrder2->qty;
            $cek->update();
        }
    }

}
