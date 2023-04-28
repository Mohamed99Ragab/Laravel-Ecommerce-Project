<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_num');
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('phone');
            $table->string('address');
            $table->float('total');
            $table->enum('status',['Is Pending','Canceled','In Progress','Completed'])->default('Is Pending');
            $table->string('payment_status')->nullable();
            $table->string('payment_method');
            $table->string('transaction_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
