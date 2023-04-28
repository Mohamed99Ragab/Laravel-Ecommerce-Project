<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Traits\HttpResponse;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    use HttpResponse;

    public function index(){

        $cart = Cart::with(['product'])->get();

        if (isset($cart) && $cart->count()>0){

            return $this->responseJson(CartResource::collection($cart),null,true);
        }

        return $this->responseJson(null,null,false);



    }


    public function addToCart(Request $request)
    {
        $rules = [
            'product_id' => 'required|numeric|exists:products,id',
            'quantity'=>'required|numeric|max:20|min:1'
        ];

        $messages = [
            'product_id.required' => 'must enter product id',
            'product_id.exists' => 'product not found by this id',
            'quantity.required' => 'must enter quantity item of product',
            'quantity.min' => 'product quantity must at least one item',
            'quantity.max' => "product quantity shouldn't be more than 20 item",
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            return $this->responseJson(null,$validator->errors()->first(),false);
        }

        $userProductCart = Cart::where('product_id',$request->product_id)
            ->where('user_id',Auth::guard('api')->id())->first();



          if(isset($userProductCart)&& !empty($userProductCart))
          {
              $userProductCart->update([
                  'quantity'=>$userProductCart->quantity + $request->quantity
              ]);
          }
          else{

              Cart::create([
                  'product_id'=>$request->product_id,
                  'quantity'=>$request->quantity,
                  'user_id'=>Auth::guard('api')->id()
              ]);
          }




        return $this->responseJson(null,'add to cart success',true);

    }


    public function editCart(Request $request){


        $rules = [
            'userCart.*.id' => 'required|exists:carts,id',
            'userCart.*.quantity' => 'required|numeric|min:1|max:20',
        ];

        $messages = [
            'userCart.*.id.required' => 'cart id is required',
            'userCart.*.id.exists' => 'cart id not found',
            'userCart.*.quantity.required' => 'product quantity is required',
            'userCart.*.quantity.min' => 'product item must at least one item',
            'userCart.*.quantity.max' => "product item shouldn't be more than 20 item",

        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            return $this->responseJson(null,$validator->errors()->first(),false);
        }



        $userCart = collect($request->userCart);
        try {

            if (isset($userCart)){

                foreach ($userCart as $cart){

                    $cart_db = Cart::find($cart['id']);


                    $cart_db->update([
                        'quantity'=>$cart['quantity']
                    ]);

                }

                return $this->responseJson(null,'cart updated success',true);
            }

            return $this->responseJson(null,'cart is empty',false);

        }

        catch (\Exception $e) {
            return $this->responseJson(null,$e->getMessage(),false);

        }







    }



    public function updateCartAuto($cart_id , Request  $request){

        $rules = [
            'quantity' => 'numeric|min:1|max:20',
        ];

        $messages = [

            'quantity.min' => 'product item must at least one item',
            'quantity.max' => "product item shouldn't be more than 20 item",

        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            return $this->responseJson(null,$validator->errors()->first(),false);
        }



        $userCart = Cart::find($cart_id);

//        return $userCart;

        if (isset($userCart) && !empty($userCart))
        {
            $userCart->update([
                'quantity'=>$request->quantity
            ]);

            return $this->responseJson(null,'cart updated success',true);

        }
        return $this->responseJson(null,'not found',false);
    }


    public function deleteCart($cart_id){

        $userCart = Cart::find($cart_id);

        if (isset($userCart) && !empty($userCart))
        {
            $userCart->delete();

            return $this->responseJson(null,'removed item success',true);

        }
        return $this->responseJson(null,'not found',false);
    }

}
