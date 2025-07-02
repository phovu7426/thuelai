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
        // Đổi tên cột status_new thành status sử dụng raw SQL
        DB::statement('ALTER TABLE orders CHANGE status_new status VARCHAR(255) NOT NULL DEFAULT "pending"');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Đổi tên cột status thành status_new sử dụng raw SQL
        DB::statement('ALTER TABLE orders CHANGE status status_new VARCHAR(255) NOT NULL DEFAULT "pending"');
    }
}; 