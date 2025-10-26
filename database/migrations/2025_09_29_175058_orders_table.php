<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('order_name', 50);
            $table->integer('order_number');
            $table->string('order_payment_method', 50);
            $table->decimal('order_total_price', 8, 2);
            $table->string('payment_status')->default('pending');
            $table->timestamp('order_date')->useCurrent();
            $table->timestamps();

            $table->foreign('employee_id')
                  ->references('employee_id')
                  ->on('coffee_shop_employee')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
