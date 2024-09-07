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
        Schema::create('master_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('category_code',length: 20)->unique();
            $table->string('category',length:50);
            $table->string('sub_category_code',length:50);
            $table->string('sub_category',length:50);
            $table->string('product_code',length:50);
            $table->string('product',length:50);
            $table->json('variants');
            $table->json('attributes');
            $table->string('created_at',length:100);
            $table->string('updated_at',length:100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_mappings');
    }
};
