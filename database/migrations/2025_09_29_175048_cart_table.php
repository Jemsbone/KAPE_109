<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id('cart_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade');
            $table->string('cart_name', 50);
            $table->integer('quantity');
            $table->string('product_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
