<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->unsignedBigInteger('admin_id');
            $table->string('product_name', 50);
            $table->string('product_category', 255);
            $table->decimal('product_price', 8, 2);
            $table->integer('product_stock');
            $table->string('product_image')->nullable();
            $table->timestamps();

            $table->foreign('admin_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
