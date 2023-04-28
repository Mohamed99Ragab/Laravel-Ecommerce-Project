<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Http\Traits\HttpResponse;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    use HttpResponse;

    public function index(Request $request)
    {



        if(isset($request->categoryId)&& $request->categoryId!=0){

            $products = Product::where('category_id',$request->categoryId)->paginate(6);

        }
        else{
            $products = Product::paginate(6);

        }

        





        if(isset($products) && $products->count() > 0)
        {

            foreach ($products as $product){
                $product['max_rate'] = $product->reviews()->max('rate')?$product->reviews()->max('rate'):0;
                $product['count_reviews'] = $product->reviews()->count();
                $product->product_img = asset('Imgs/products/'.$product->product_img);

                if ($product->old_price !=null){
                    $discount_percent = (($product->old_price - $product->new_price)/(($product->old_price + $product->new_price)/2))*100;
                    $product['discount_percent'] = number_format($discount_percent);
                }else{
                    $product['discount_percent']  = 0;
                }

            }


            return $this->responseJson( $products ,null,true);

        }

        return $this->responseJson(null,'No products Added',false);

    }



    public function getFeaturedProducts()
    {
        $products = Product::where('is_feature','featured')->take(6)->get();

        if(isset($products) && $products->count() > 0)
        {
            foreach ($products as $product){
                $product['max_rate'] = $product->reviews()->max('rate')?$product->reviews()->max('rate'):0;
                $product['count_reviews'] = $product->reviews()->count();
                $product->product_img = asset('Imgs/products/'.$product->product_img);

                if ($product->old_price !=null){
                    $discount_percent = (($product->old_price - $product->new_price)/(($product->old_price + $product->new_price)/2))*100;
                    $product['discount_percent'] = number_format($discount_percent);
                }else{
                    $product['discount_percent']  = 0;
                }

            }

            return $this->responseJson( $products ,null,true);
        }

        return $this->responseJson(null,null,false);


    }


    public function getNewProducts()
    {
        $products = Product::latest()->take(6)->get();

        if(isset($products) && $products->count() > 0)
        {

            foreach ($products as $product){
                $product['max_rate'] = $product->reviews()->max('rate')?$product->reviews()->max('rate'):0;
                $product['count_reviews'] = $product->reviews()->count();
                $product->product_img = asset('Imgs/products/'.$product->product_img);

                if ($product->old_price !=null){
                    $discount_percent = (($product->old_price - $product->new_price)/(($product->old_price + $product->new_price)/2))*100;
                    $product['discount_percent'] = number_format($discount_percent);
                }else{
                    $product['discount_percent']  = 0;
                }

            }

            return $this->responseJson( $products ,null,true);
        }

        return $this->responseJson(null,null,false);


    }



    public function productDetails($id)
    {
        $product = Product::with(['reviews'=>function($q){
            return $q->with(['user'=>function($q){
                return $q->select('id','first_name','last_name')->get();
            }]);
        },'category'=>function($q){
            return $q->select('id','name')->get();

        }])->find($id);

        if (isset($product)&&!empty($product))
        {

            return $this->responseJson(new ProductsResource($product) ,null,true);

            return $this->responseJson($product,null,true);
        }

        return $this->responseJson(null,'no product found by this id',false);

    }


}
