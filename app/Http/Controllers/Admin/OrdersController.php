<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{

    public function index(Request $request){
       $orders=  Order::all();
       return view('admin.orders.index',['orders'=>$orders]);
    }
    public function updateStatus(Request $request)
{
    $order = Order::find($request->order_id);
    if ($order) {
        $order->order_status = $request->order_status;
        $order->save();
        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
    return redirect()->back()->with('error', 'Order not found.');
}

public function order(Request $request, $order_id){
  $order=   Order::where('order_number',$order_id)->first();
   return view('frontend.user.order',['order'=>$order]);
}

public function orderByStatus(Request $request , $order_status){
  $orders=   Order::where('order_status',$order_status)->get();
  return view('admin.orders.index',['orders'=>$orders]);

}

}
