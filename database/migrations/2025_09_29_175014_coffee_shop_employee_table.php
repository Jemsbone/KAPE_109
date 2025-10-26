<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coffee_shop_employee', function (Blueprint $table) {
            $table->id('employee_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('employee_name', 50);
            $table->string('employee_age', 50);
            $table->string('employee_sex', 50);
            $table->string('employee_phone', 50);
            $table->string('employee_email', 50);
            $table->string('employee_address', 50);
            $table->string('employee_password', 50);
            $table->timestamps();

            $table->foreign('admin_id')
                  ->references('admin_id')
                  ->on('coffee_shop_admin')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coffee_shop_employee');
    }
};
