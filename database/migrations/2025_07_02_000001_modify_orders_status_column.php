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
        // Đảm bảo cột status tồn tại và có default là 'pending'
        if (Schema::hasColumn('orders', 'status')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('status')->default('pending')->change();
            });
        } else {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('status')->default('pending');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nếu muốn rollback, có thể xóa default hoặc xóa cột nếu cần
        if (Schema::hasColumn('orders', 'status')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
