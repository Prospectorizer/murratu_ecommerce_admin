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
        Schema::create('master_brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_code',length:50);
            $table->string('brand',length:50);
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
        Schema::dropIfExists('master_brands');
    }
};
