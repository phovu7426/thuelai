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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên tác giả
            $table->string('pen_name'); // Bút danh
            $table->string('email'); // Bút danh
            $table->string('phone'); // Bút danh
            $table->string('nationality')->nullable(); // Quốc tịch (tuỳ chọn)
            $table->text('biography')->nullable(); // Tiểu sử (tuỳ chọn)
            $table->date('birth_date')->nullable(); // Ngày sinh (tuỳ chọn)
            $table->date('death_date')->nullable(); // Ngày mất (nếu có)
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps(); // Thời gian tạo và cập nhật
            $table->softDeletes(); // Xóa mềm
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
