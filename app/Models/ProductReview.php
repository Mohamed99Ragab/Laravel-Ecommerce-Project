<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rate',
        'review',
        'created_at',
        'updated_at'
    ];

    protected $hidden =[
        'user_id',
        'product_id',
        'updated_at',

    ];
    public function getCreatedAtAttribute($value)
    {
        return date_format(Carbon::parse($value),'d M,Y');
    }

    public function product(){

        return $this->belongsTo(Product::class,'product_id');
    }

    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }



}
