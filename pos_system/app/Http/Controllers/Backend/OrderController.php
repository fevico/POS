<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Orderdetails;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class OrderController extends Controller
{
    //
    public function FinalInvoice(Request $request){
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_product'] = $request->total_product;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->vat;
        $data['invoice_no'] = 'FEPOS'.mt_rand(10000000,99999999);
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;
        $data['created_at'] = Carbon::now();

        $order_id = Order::insertGetId($data);
        $contents = Cart::content();

        $pdata = array();
        foreach($contents as $cont){
            $pdata['order_id'] = $order_id;
            $pdata['product_id'] = $cont->id;
            $pdata['quantity'] = $cont->qty;
            $pdata['unit_cost'] = $cont->price;
            $pdata['total'] = $cont->total;

            $insert = Orderdetails::insert($pdata);
        }
        $notification = array(
            'message' => 'Order Completed Successfully',
            'alert-type' => 'success'
             ); 

             Cart::destroy();

        return redirect()->route('dashboard')->with($notification);
    }

    public function PendingOrder(){
      $order = Order::where('order_status',"Pending")->get();
      return view('backend.order.pending_order',compact('order'));
    }

    public function OrderDetails($order_id){
        $order = Order::where('id',$order_id)->first();
        $order_item = Orderdetails::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('backend.order.order_details', compact('order', 'order_item')); 
    }

    public function OrderStatusUpdate(Request $request){
        $order_id = $request->id;

        $product = OrderDetails::where('order_id',$order_id)->get();
        foreach($product as $item){
            product::where('id',$item->product_id)
            ->update(['product_store' => DB::raw('product_store-'.$item->quantity)]);
        }

        Order::findOrFail($order_id)->update([
            'order_status' => "Completed",
        ]);

        $notification = array(
            'message' => 'Order Updated Successfully',
            'alert-type' => 'success'
             ); 

        return redirect()->route('pending-order')->with($notification);
    }

    public function CompleteOrder(){
        $order = Order::where('order_status',"Completed")->get();
        return view('backend.order.complete_order', compact('order'));
    }

    public function StockManage(){
        $product = Product::latest()->get();
        return view('backend.stock.all_stock', compact('product'));
    }

    public function OrderInvoice($order_id){
        $order = Order::where('id',$order_id)->first();
        $orderItem = Orderdetails::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('backend.order.oder_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);

        return $pdf->download('invoice.pdf');
    }
}
