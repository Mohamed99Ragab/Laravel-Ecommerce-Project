<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if ($this->old_price !=null){
            $discount_percent = (($this->old_price - $this->new_price)/(($this->old_price + $this->new_price)/2))*100;

        }else{
            $discount_percent = null;
        }


        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'new_price'=>$this->new_price,
            'old_price'=>$this->old_price,
            'discount_percent'=>number_format($discount_percent),
            'desc'=>$this->desc,
            'quantity'=>$this->quantity,
            'product_img'=>asset('Imgs/products/'.$this->product_img),
            'category'=>$this->category->name,
            'max_rate'=>$this->reviews->max('rate')?$this->reviews->max('rate'):0,
            'reviews_count'=>$this->reviews->count(),
            'reviews'=>$this->reviews,

        ];
    }
}
