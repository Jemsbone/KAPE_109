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
            $table->string('admin_email')->unique()->nullable()->after('admin_name');
            $table->string('otp_code', 6)->nullable()->after('admin_password');
            $table->timestamp('otp_expires_at')->nullable()->after('otp_code');
            $table->timestamp('email_verified_at')->nullable()->after('otp_expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coffee_shop_admin', function (Blueprint $table) {
            $table->dropColumn(['admin_email', 'otp_code', 'otp_expires_at', 'email_verified_at']);
        });
    }
};
