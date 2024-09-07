<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('cart_id',length:50);
            $table->string('order_id',length:50);
            $table->string('customer_id',length:50);
            $table->double('amount');
            $table->double('shipping_cost');
            $table->double('net_amount');
            $table->enum('is_cod',['yes','no'])->default('no');
            $table->string('payment_platform',length:100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
