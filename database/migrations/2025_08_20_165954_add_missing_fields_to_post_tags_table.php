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
        Schema::table('post_tags', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('color');
            $table->boolean('is_featured')->default(false)->after('is_active');
            $table->string('meta_title')->nullable()->after('is_featured');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->text('meta_keywords')->nullable()->after('meta_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_tags', function (Blueprint $table) {
            $table->dropColumn(['icon', 'is_featured', 'meta_title', 'meta_description', 'meta_keywords']);
        });
    }
};
