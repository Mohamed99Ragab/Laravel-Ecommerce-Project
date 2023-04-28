<?php

namespace App\Http\Controllers\web\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    public function index(){

        $orders = Order::latest()->get();


        return view('orders.index',compact('orders'));
    }


    public function invoice($order_id){

        $order = Order::findOrfail($order_id);


        return view('orders.invoice',compact('order'));
    }


    public function updateStatusOfOrder(Request $request,$order_id){

        $order = Order::find($order_id);

        $order->update([
            'status'=>$request->status
        ]);

        session()->flash('success','order status updated success');

        return redirect()->back();
    }


    public function destroy($id)
    {
        $order = Order::findOrfail($id);

        if (isset($order)) {


            $order->delete();

            session()->flash('success', 'Order deleted success');
        }

        return redirect()->back();



    }


}
