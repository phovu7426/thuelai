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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên khu vực
            $table->string('code')->unique(); // Mã khu vực
            $table->string('type'); // Loại khu vực
            $table->string('location'); // Vị trí
            $table->text('description')->nullable(); // Mô tả khu vực
            $table->integer('capacity')->nullable(); // Sức chứa
//            $table->boolean('status')->default(true); // Trạng thái hoạt động
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps(); // Thời gian tạo và cập nhật
            $table->softDeletes(); // Thêm cột deleted_at

            // Khai báo khóa ngoại
            $table->unsignedBigInteger('area_id')->nullable(); // Khai báo cột trước
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
