<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class OrderCtrl extends Controller
{
    //
    public function Orders($type='')
    {
        if($type =='pending'){
            $orders=order::where('delivered','0')->get();
        }elseif ($type == 'delivered'){
            $orders=order::where('delivered','1')->get();
        }else{
            $orders=order::all();
        }

        return view('admin.orders',compact('orders'));
    }

    public function toggledeliver(Request $request,$orderId)
    {
    	$order = order::find($orderId);
    	if($request->has('delivered')){
    	    // $time=Carbon::now()->addMinute(1);
    	    Mail::to($order->user)->send(new OrderShipped($order));
    	    // Mail::to($order->user)->later($time,new OrderShipped($order));

    	    $order->delivered=$request->delivered;
    	}else{
    	    $order->delivered="0";
    	}
    	$order->save();

    	return back();
    }
}
