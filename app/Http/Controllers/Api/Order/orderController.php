<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponse;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use App\Notifications\makeOrderNotification;
use App\Notifications\stockProductNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Str;

class orderController extends Controller
{

    use HttpResponse;


    public function index(){


        $orders = Order::with(['user'])->where('user_id',Auth::guard('api')->id())->latest()->get();

        if(isset($orders) && $orders->count()>0)
        {
            return $this->responseJson($orders,null,true);

        }
        return $this->responseJson(null,"no found orders for you yet",false);


    }


    public function orderDetails($order_id){


        $ordersItems = OrderDetail::where('order_id',$order_id)->get();

        if(isset($ordersItems) && $ordersItems->count()>0)
        {
            return $this->responseJson($ordersItems,null,true);

        }
        return $this->responseJson(null,"no order detail with order id",false);


    }

    public function makeOrder(Request $request)
    {

        $order_items = $request->order_items;


//        return $this->responseJson($order_items,null,false);


        $rules = [
            'phone' => 'required|string',
            'address' => 'required|string',
        ];

        $messages = [

            'phone.required' => 'phone is required to make your order',
            'address.required' => "address is required to make your order",

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->responseJson(null, $validator->errors()->first(), false);
        }


        DB::beginTransaction();
        try {



            $order = Order::create([

                'order_num' => "#EGY" . random_int(100000, 999999),
                'user_id' => Auth::guard('api')->id(),
                'phone' => $request->phone,
                'address' => $request->address,
                'transaction_id' => $request->transaction_id,
                'payment_method' => $request->paymentMethod,
                'payment_status' => $request->paymentStatus,
                'total' => $request->total,
                'status' => 'Is Pending'
            ]);




            foreach ($order_items as $item) {

                 $order_details = OrderDetail::create([
                    'order_id' => $order->id,
                    'product_name' => $item['product_name'],
                    'product_img' => $item['product_img'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],

                ]);

                // update quantity of product after order
                $this->updateQuantity($item);


            }

            // empty cart of user after make order
            $this->empty_Cart_Of_User_After_Make_Order();

            // send notification to admin to know that send new order
            $admin = Admin::first();
            Notification::send($admin, new makeOrderNotification(Auth::guard('api')->user(),$order_details->id));

            DB::commit();
            return $this->responseJson(null, 'order sent success', true);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return $this->responseJson($e->getMessage(), null, false);


        }


    }


    public function updateQuantity($item)
    {

        $product = Product::find($item['product_id']);

        $product->update([
            'quantity' => ($product['quantity'] - $item['quantity'])
        ]);

        // check quantity if product to notify admin about stock

        $this->notifyAdminAboutQyt($product);
    }


    public function notifyAdminAboutQyt($product)
    {


        if ($product->quantity < 5) {

            $admin = Admin::first();
//            $admin->notifiy(new stockProductNotification($product->id, $product->name, $product->quantity));
            Notification::send($admin, new stockProductNotification($product->id, $product->name, $product->quantity));
        }
    }


    public function empty_Cart_Of_User_After_Make_Order()
    {
        $userCartIds = Cart::where('user_id', Auth::guard('api')->id())->pluck('id');
        Cart::whereIn('id', $userCartIds)->delete();
    }


}
