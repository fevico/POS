<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderdetails;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;

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
}
