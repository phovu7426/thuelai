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
        Schema::table('testimonials', function (Blueprint $table) {
            // Thêm các cột phục vụ luồng mời đánh giá qua email
            $table->string('customer_email')->nullable()->after('customer_title');
            $table->string('customer_phone')->nullable()->after('customer_email');
            $table->string('review_token')->nullable()->unique()->after('sort_order');
            $table->timestamp('reviewed_at')->nullable()->after('review_token');
        });

        // Cho phép nội dung có thể null để tạo bản ghi mời trước rồi khách hàng điền sau
        Schema::table('testimonials', function (Blueprint $table) {
            $table->text('content')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            // Không thể đổi lại content NOT NULL an toàn nếu có dữ liệu null; bỏ qua bước này
            $table->dropColumn(['customer_email', 'customer_phone', 'review_token', 'reviewed_at']);
        });
    }
};






