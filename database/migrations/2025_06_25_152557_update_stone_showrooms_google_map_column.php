<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stone_showrooms', function (Blueprint $table) {
            $table->text('google_map')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Trước khi rollback, cập nhật dữ liệu dài về null
        DB::table('stone_showrooms')
            ->whereRaw('LENGTH(google_map) > 255')
            ->update(['google_map' => null]);
            
        Schema::table('stone_showrooms', function (Blueprint $table) {
            $table->string('google_map')->nullable()->change();
        });
    }
};
