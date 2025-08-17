<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DriverContact;

class DriverContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'name' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@example.com',
                'phone' => '0123456789',
                'subject' => 'Đăng ký dịch vụ lái xe',
                'message' => 'Tôi muốn đăng ký dịch vụ lái xe cho công ty. Vui lòng liên hệ lại để tư vấn chi tiết.',
                'status' => 'unread',
                'admin_notes' => null,
            ],
            [
                'name' => 'Trần Thị B',
                'email' => 'tranthib@example.com',
                'phone' => '0987654321',
                'subject' => 'Hỏi về giá dịch vụ',
                'message' => 'Tôi muốn biết giá dịch vụ lái xe từ Hà Nội đến Hải Phòng. Có thể gửi báo giá chi tiết không?',
                'status' => 'read',
                'admin_notes' => 'Đã gửi báo giá qua email',
            ],
            [
                'name' => 'Lê Văn C',
                'email' => 'levanc@example.com',
                'phone' => '0369852147',
                'subject' => 'Đặt lịch lái xe',
                'message' => 'Tôi cần đặt lịch lái xe vào ngày 25/8/2025 từ 8h sáng đến 5h chiều. Có thể sắp xếp được không?',
                'status' => 'replied',
                'admin_notes' => 'Đã xác nhận lịch và gửi thông tin tài xế',
            ],
            [
                'name' => 'Phạm Thị D',
                'email' => 'phamthid@example.com',
                'phone' => '0521478963',
                'subject' => 'Khiếu nại dịch vụ',
                'message' => 'Tôi không hài lòng với dịch vụ lái xe hôm qua. Tài xế đến muộn 30 phút và thái độ không tốt.',
                'status' => 'closed',
                'admin_notes' => 'Đã xin lỗi và bồi thường 50% phí dịch vụ',
            ],
            [
                'name' => 'Hoàng Văn E',
                'email' => 'hoangvane@example.com',
                'phone' => '0741258963',
                'subject' => 'Hợp tác kinh doanh',
                'message' => 'Công ty chúng tôi muốn hợp tác với dịch vụ lái xe của bạn. Có thể gặp mặt trao đổi không?',
                'status' => 'unread',
                'admin_notes' => null,
            ],
        ];

        foreach ($contacts as $contact) {
            DriverContact::create($contact);
        }
    }
}
