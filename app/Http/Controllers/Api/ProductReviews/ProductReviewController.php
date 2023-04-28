<?php

namespace App\Http\Controllers\Api\ProductReviews;

use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponse;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductReviewController extends Controller
{
        use HttpResponse;



    public function storeReview(Request $request)
    {
        $rules = [
            'rate' => 'required|numeric',
            'review'=>'required'
        ];

        $messages = [
            'rate.required' => 'must enter your rate',
            'rate.numeric' => 'rate must type numeric value',
            'review.required' => 'please enter your feedback',

        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            return $this->responseJson(null,$validator->errors()->first(),false);
        }
        $product_id = $request->product_id;
        $userReviews = User::with(['reviews'=>function($q) use($product_id){
            return $q->where('product_id',$product_id)->get();
        }])->find(Auth::guard('api')->id());

//        return $userReviews->reviews;

        if($userReviews->reviews->count() <1){
            ProductReview::create([
                'product_id'=>$request->product_id,
                'user_id'=>Auth::guard('api')->id(),
                'rate'=>$request->rate,
                'review'=>$request->review
            ]);

            return $this->responseJson(null,'thanks for your review',true);
        }
        else{
            return $this->responseJson(null,"you can't send more than feedback",false);

        }




    }

    public function showReview($id){

        $review = ProductReview::find($id);

        if (isset($review) && !empty($review))
        {
            return $this->responseJson($review,null,true);

        }
        return $this->responseJson(null,'No reviews on this product yet.',false);

    }


    public function editReview(Request $request,$id){

        $rules = [
            'rate' => 'required|numeric',
            'review'=>'required'
        ];

        $messages = [
            'rate.required' => 'must enter your rate',
            'rate.numeric' => 'rate must type numeric value',
            'review.required' => 'please enter your feedback',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            return $this->responseJson(null,$validator->errors()->first(),false);
        }


        $review = ProductReview::find($id);

        if (isset($review) && !empty($review))
        {
            $review->update([
                'rate'=>$request->rate,
                'review'=>$request->review
            ]);

            return $this->responseJson(null,'review updated success',true);

        }
        return $this->responseJson(null,'review not found',false);

    }


    public function deleteReview($id){

        $review = ProductReview::find($id);

        if (isset($review) && !empty($review))
        {
            $review->delete();

            return $this->responseJson(null,'review deleted success',true);

        }
        return $this->responseJson(null,'review not found',false);

    }


}
