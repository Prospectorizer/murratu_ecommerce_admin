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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id',length: 20)->unique();
            $table->double('mrp');
            $table->string('category_code',length:50);
            $table->string('sub_category_code',length:50);
            $table->string('product_code',length:50);
            $table->string('brand_code',length:50);
            $table->string('name',length:100);
            $table->json('images');
            $table->string('image_base_path',length:225);
            $table->json('variants');
            $table->json('attributes');
            $table->integer('offer_value');
            $table->enum('offer_type',['price','percentage'])->default('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
