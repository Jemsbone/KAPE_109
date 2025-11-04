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
        Schema::table('coffee_shop_admin', function (Blueprint $table) {
            // Change admin_password column length to 255 to accommodate hashed passwords
            $table->string('admin_password', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coffee_shop_admin', function (Blueprint $table) {
            // Revert to original length of 50
            $table->string('admin_password', 50)->change();
        });
    }
};
