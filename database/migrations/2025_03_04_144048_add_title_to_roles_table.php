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
        Schema::table('roles', function (Blueprint $table) {
//            $table->id(); // ID tự động tăng
//            $table->string('name')->unique(); // Mã quyền (quan trọng để kiểm tra)
//            $table->string('title')->nullable(); // Tên hiển thị cho người dùng
//            $table->text('description')->nullable(); // Mô tả vai trò
//            $table->string('guard_name')->default('web'); // Guard (của Spatie Permission)
//            $table->enum('status', ['active', 'inactive'])->default('active');
//            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            //
        });
    }
};
