<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'new_price',
        'old_price',
        'category_id',
        'desc',
        'is_feature',
        'quantity',
        'product_img',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'category_id',
        'created_at',
        'updated_at',
    ];


    public function category(){

        return $this->belongsTo(Category::class,'category_id');
    }


    public function reviews(){

        return $this->hasMany(ProductReview::class,'product_id');
    }


    public function carts(){

        return $this->hasMany(Cart::class,'product_id');
    }





}
