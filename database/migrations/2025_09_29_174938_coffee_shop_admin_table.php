<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coffee_shop_admin', function (Blueprint $table) {
            $table->id('admin_id');
            $table->string('admin_name', 50);
            $table->string('admin_password', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coffee_shop_admin');
    }
};
