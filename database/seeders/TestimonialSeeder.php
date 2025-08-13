<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name' => 'Nguyễn Văn An',
                'customer_title' => 'Doanh nhân',
                'content' => 'Dịch vụ lái xe rất chuyên nghiệp! Tài xế đến đúng giờ, lái xe an toàn và thân thiện. Tôi đã sử dụng dịch vụ này nhiều lần và luôn hài lòng.',
                'rating' => 5,
                'is_featured' => true,
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'customer_name' => 'Trần Thị Bình',
                'customer_title' => 'Nhân viên văn phòng',
                'content' => 'Tôi thường xuyên sử dụng dịch vụ lái xe theo giờ để đi làm. Tài xế rất đáng tin cậy và giá cả hợp lý. Rất tiện lợi cho những ngày mệt mỏi.',
                'rating' => 5,
                'is_featured' => true,
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'customer_name' => 'Lê Văn Cường',
                'customer_title' => 'Giám đốc công ty',
                'content' => 'Công ty chúng tôi đã sử dụng dịch vụ lái xe cho doanh nghiệp trong 2 năm qua. Chất lượng dịch vụ rất tốt, tài xế chuyên nghiệp và đúng giờ.',
                'rating' => 5,
                'is_featured' => true,
                'status' => true,
                'sort_order' => 3,
            ],
            [
                'customer_name' => 'Phạm Thị Dung',
                'customer_title' => 'Khách hàng cá nhân',
                'content' => 'Tôi đã sử dụng dịch vụ lái xe cho sự kiện đám cưới của mình. Tài xế rất chu đáo, xe sạch sẽ và an toàn. Mọi người đều khen ngợi dịch vụ.',
                'rating' => 5,
                'is_featured' => false,
                'status' => true,
                'sort_order' => 4,
            ],
            [
                'customer_name' => 'Hoàng Văn Em',
                'customer_title' => 'Du khách nước ngoài',
                'content' => 'Lần đầu tiên đến Việt Nam, tôi đã sử dụng dịch vụ lái xe theo yêu cầu. Tài xế nói tiếng Anh tốt, rất thân thiện và giúp tôi hiểu thêm về văn hóa Việt Nam.',
                'rating' => 5,
                'is_featured' => false,
                'status' => true,
                'sort_order' => 5,
            ],
            [
                'customer_name' => 'Vũ Thị Phương',
                'customer_title' => 'Khách hàng thường xuyên',
                'content' => 'Tôi đã sử dụng dịch vụ này hơn 1 năm. Tài xế luôn đúng giờ, xe sạch sẽ và giá cả minh bạch. Dịch vụ khách hàng 24/7 rất hữu ích.',
                'rating' => 4,
                'is_featured' => false,
                'status' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
