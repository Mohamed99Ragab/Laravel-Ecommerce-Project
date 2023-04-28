<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'quantity'=>$this->quantity,
            'product_name'=>$this->product->name,
            'price'=>$this->product->new_price,
            'product_img'=>asset('Imgs/products/'.$this->product->product_img),
            'product_id'=>$this->product->id

        ];
    }
}
