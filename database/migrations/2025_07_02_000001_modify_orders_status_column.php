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
        try {
            // Try to modify the status column if it exists
            DB::statement('ALTER TABLE orders MODIFY status VARCHAR(255) DEFAULT "pending" NOT NULL');
        } catch (\Exception $e) {
            // If the column doesn't exist, add it
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
        try {
            // Try to drop the status column if it exists
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        } catch (\Exception $e) {
            // Column doesn't exist, do nothing
        }
    }
};
