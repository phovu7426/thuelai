<?php

namespace Database\Seeders;

use App\Models\StoneApplication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateStoneApplicationContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update content for "via-he" application
        $application = StoneApplication::where('slug', 'via-he')->first();
        
        if ($application) {
            $content = '<h2>Đá lát vỉa hè - Giải pháp hoàn hảo cho không gian đô thị</h2>
            <p>Đá lát vỉa hè là một trong những giải pháp được sử dụng rộng rãi trong việc xây dựng các tuyến phố, đường đi bộ, khu đô thị mới. Với đặc tính bền vững, khả năng chịu lực tốt và tính thẩm mỹ cao, đá lát vỉa hè đang ngày càng được ưa chuộng trong các công trình xây dựng hiện đại.</p>
            
            <h3>Đặc điểm nổi bật của đá lát vỉa hè</h3>
            <ul>
                <li><strong>Độ bền cao:</strong> Đá tự nhiên có khả năng chịu lực tốt, chống chịu được tác động của thời tiết và môi trường khắc nghiệt.</li>
                <li><strong>Tính thẩm mỹ:</strong> Đá lát vỉa hè có nhiều màu sắc, kích thước và hoa văn đa dạng, giúp tạo nên không gian đô thị hiện đại và sang trọng.</li>
                <li><strong>Dễ dàng lắp đặt và bảo trì:</strong> Đá lát vỉa hè có thể được lắp đặt một cách dễ dàng và nhanh chóng, đồng thời việc bảo trì cũng rất đơn giản.</li>
                <li><strong>Thân thiện với môi trường:</strong> Đá tự nhiên là vật liệu thân thiện với môi trường, không chứa các chất độc hại và có thể tái sử dụng.</li>
            </ul>
            
            <h3>Ứng dụng của đá lát vỉa hè</h3>
            <p>Đá lát vỉa hè được sử dụng rộng rãi trong các công trình xây dựng đô thị như:</p>
            <ul>
                <li>Vỉa hè các tuyến phố</li>
                <li>Đường đi bộ trong công viên</li>
                <li>Khu vực sân vườn</li>
                <li>Quảng trường</li>
                <li>Khu đô thị mới</li>
            </ul>
            
            <h3>Quy trình lắp đặt đá lát vỉa hè</h3>
            <ol>
                <li>Chuẩn bị mặt bằng: San phẳng mặt bằng, đảm bảo độ dốc thoát nước.</li>
                <li>Thi công lớp đệm: Rải lớp cát đệm dày khoảng 5-7cm.</li>
                <li>Lắp đặt đá: Xếp đá theo thiết kế, đảm bảo độ phẳng và khe hở giữa các viên đá.</li>
                <li>Hoàn thiện: Rải cát mịn lên bề mặt và quét đều để lấp đầy các khe hở.</li>
            </ol>';
            
            $application->update(['content' => $content]);
            
            $this->command->info('Content updated for "via-he" application');
        } else {
            $this->command->error('Application "via-he" not found');
        }
    }
}
