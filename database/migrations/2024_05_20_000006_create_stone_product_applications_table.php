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
        Schema::create('stone_product_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stone_product_id');
            $table->unsignedBigInteger('stone_application_id');
            $table->timestamps();

            $table->foreign('stone_product_id')
                ->references('id')
                ->on('stone_products')
                ->onDelete('cascade');
                
            $table->foreign('stone_application_id')
                ->references('id')
                ->on('stone_applications')
                ->onDelete('cascade');
                
            $table->unique(['stone_product_id', 'stone_application_id'], 'product_application_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stone_product_applications');
    }
}; 