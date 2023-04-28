<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_num',
        'user_id',
        'phone',
        'address',
        'total',
        'status',
        'payment_status',
        'payment_method',
        'transaction_id',
        'created_at',
        'updated_at'
    ];


    protected $hidden = [
        'updated_at'
    ];

// make accessor

    public function getCreatedAtAttribute($value)
    {
        return date_format(Carbon::parse($value),'d/m/Y');
    }


//end




    public function orderDetails(){

        return $this->hasMany(OrderDetail::class,'order_id');
    }

    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }


}
