<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->id('rating_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->tinyInteger('rating')->unsigned()->check('rating >= 1 AND rating <= 10');
            $table->text('rating_message');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rating');
    }
};
