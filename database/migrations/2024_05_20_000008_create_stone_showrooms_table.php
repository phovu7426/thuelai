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
        Schema::create('stone_showrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('province')->nullable(); // Tỉnh/thành phố
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('hotline')->nullable();
            $table->string('contact_person')->nullable(); // Người liên hệ
            $table->string('google_map')->nullable(); // iframe Google Map
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1); // 1: active, 0: inactive
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stone_showrooms');
    }
}; 