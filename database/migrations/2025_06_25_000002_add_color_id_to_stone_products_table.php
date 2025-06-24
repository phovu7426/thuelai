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
        Schema::table('stone_products', function (Blueprint $table) {
            $table->foreignId('stone_color_id')->nullable()->after('stone_surface_id')->constrained('stone_colors')->nullOnDelete();
            $table->decimal('discount_price', 15, 2)->nullable()->after('price');
            $table->integer('discount_percent')->nullable()->after('discount_price');
            $table->boolean('is_new')->default(false)->after('is_featured');
            $table->string('hardness')->nullable()->after('thickness');
            $table->string('water_absorption')->nullable()->after('hardness');
            $table->string('heat_resistance')->nullable()->after('water_absorption');
            $table->string('meta_title')->nullable()->after('order');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('meta_keywords')->nullable()->after('meta_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stone_products', function (Blueprint $table) {
            $table->dropForeign(['stone_color_id']);
            $table->dropColumn('stone_color_id');
            $table->dropColumn('discount_price');
            $table->dropColumn('discount_percent');
            $table->dropColumn('is_new');
            $table->dropColumn('hardness');
            $table->dropColumn('water_absorption');
            $table->dropColumn('heat_resistance');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_keywords');
        });
    }
}; 