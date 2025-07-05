<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoneProject;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class StoneProjectSeeder extends Seeder
{
    public function run()
    {
        // Xóa dữ liệu ở bảng phụ thuộc trước
        DB::table('stone_project_products')->delete();
        // Xóa dữ liệu ở bảng chính
        DB::table('stone_projects')->delete();
        // Reset auto increment nếu cần
        DB::statement('ALTER TABLE stone_projects AUTO_INCREMENT = 1');
        
        $faker = Faker::create('vi_VN');
        
        $projectTypes = [
            'Biệt thự cao cấp', 'Biệt thự nghỉ dưỡng', 'Biệt thự song lập', 'Biệt thự đơn lập',
            'Chung cư cao cấp', 'Chung cư thương mại', 'Căn hộ duplex', 'Căn hộ penthouse',
            'Khách sạn 5 sao', 'Khách sạn 6 sao', 'Resort nghỉ dưỡng', 'Resort ven biển',
            'Trung tâm thương mại', 'Tòa nhà văn phòng', 'Trung tâm hội nghị', 'Trung tâm triển lãm',
            'Nhà hàng cao cấp', 'Showroom xe hơi', 'Trung tâm giải trí', 'Sân golf',
            'Bệnh viện quốc tế', 'Trường học quốc tế', 'Trung tâm nghiên cứu', 'Thư viện',
            'Bảo tàng', 'Nhà hát', 'Sân vận động', 'Trung tâm thể thao'
        ];
        
        $locations = [
            'Hà Nội' => [
                'Cầu Giấy' => ['Dịch Vọng', 'Trung Hòa', 'Mai Dịch', 'Yên Hòa', 'Quan Hoa'],
                'Ba Đình' => ['Điện Biên', 'Đội Cấn', 'Ngọc Hà', 'Quán Thánh', 'Trúc Bạch'],
                'Tây Hồ' => ['Quảng An', 'Tứ Liên', 'Xuân La', 'Bưởi', 'Thụy Khuê'],
                'Hoàn Kiếm' => ['Hàng Bông', 'Tràng Tiền', 'Hoàn Kiếm', 'Phan Chu Trinh'],
                'Nam Từ Liêm' => ['Mỹ Đình', 'Cầu Diễn', 'Phú Đô', 'Mễ Trì', 'Tây Mỗ']
            ],
            'Hồ Chí Minh' => [
                'Quận 1' => ['Bến Nghé', 'Bến Thành', 'Đa Kao', 'Nguyễn Thái Bình', 'Phạm Ngũ Lão'],
                'Thủ Đức' => ['An Phú', 'Bình Thọ', 'Hiệp Bình Chánh', 'Linh Đông', 'Tam Bình'],
                'Quận 7' => ['Tân Phong', 'Tân Thuận Đông', 'Tân Thuận Tây', 'Phú Mỹ', 'Bình Thuận'],
                'Quận 2' => ['Thảo Điền', 'An Phú', 'Bình An', 'Bình Trưng Đông', 'Bình Trưng Tây'],
                'Bình Thạnh' => ['Phường 1', 'Phường 2', 'Phường 3', 'Phường 11', 'Phường 12']
            ],
            'Đà Nẵng' => [
                'Sơn Trà' => ['An Hải Bắc', 'An Hải Đông', 'An Hải Tây', 'Mân Thái', 'Phước Mỹ'],
                'Ngũ Hành Sơn' => ['Mỹ An', 'Khuê Mỹ', 'Hoà Quý', 'Hoà Hải'],
                'Hải Châu' => ['Hải Châu 1', 'Hải Châu 2', 'Nam Dương', 'Phước Ninh', 'Thạch Thang']
            ],
            'Nha Trang' => [
                'Trung tâm' => ['Lộc Thọ', 'Phước Tiến', 'Phước Tân', 'Vĩnh Nguyên', 'Vĩnh Thọ'],
                'Ven biển' => ['Vĩnh Hòa', 'Vĩnh Phước', 'Xương Huân', 'Phước Long', 'Vĩnh Trường']
            ],
            'Phú Quốc' => [
                'Dương Đông' => ['Khu 1', 'Khu 2', 'Khu 3', 'Khu 4', 'Khu 5'],
                'An Thới' => ['Khu Phố 1', 'Khu Phố 2', 'Khu Phố 3', 'Khu Phố 4', 'Khu Phố 5']
            ],
            'Hạ Long' => [
                'Bãi Cháy' => ['Khu 1', 'Khu 2', 'Khu 3', 'Khu 4', 'Khu 5'],
                'Hòn Gai' => ['Khu A', 'Khu B', 'Khu C', 'Khu D', 'Khu E']
            ]
        ];

        $clients = [
            'Tập đoàn' => [
                'Vingroup', 'Sun Group', 'FLC Group', 'BIM Group', 'Novaland Group',
                'Hòa Phát Group', 'Mường Thanh Group', 'CEO Group', 'Đất Xanh Group',
                'Nam Long Group', 'Hưng Thịnh Corp', 'Phú Long Corp', 'Ecopark Corp'
            ],
            'Công ty BĐS' => [
                'Công ty TNHH Phát triển BĐS Phú Mỹ Hưng',
                'Công ty CP Đầu tư và Phát triển Sunshine',
                'Công ty CP Đầu tư LDG',
                'Công ty CP Đầu tư Nam Long',
                'Công ty CP Phát triển BĐS Phát Đạt'
            ],
            'Đơn vị xây dựng' => [
                'Công ty CP Xây dựng Coteccons',
                'Công ty CP Xây dựng Hoà Bình',
                'Công ty CP Xây dựng Central',
                'Công ty TNHH Xây dựng Unicons',
                'Công ty CP Xây dựng Ricons'
            ]
        ];

        $stoneTypes = [
            'Đá granite' => [
                'Đá Granite Đen Ấn Độ', 'Đá Granite Trắng Suối Lau',
                'Đá Granite Đỏ Ruby', 'Đá Granite Xám Đậm',
                'Đá Granite Tím Mongcai', 'Đá Granite Trắng Bình Định'
            ],
            'Đá marble' => [
                'Đá Marble Trắng Ý', 'Đá Marble Kem Ai Cập',
                'Đá Marble Nâu Tây Ban Nha', 'Đá Marble Xanh Persian',
                'Đá Marble Đen Marquina', 'Đá Marble Hồng Nghệ An'
            ],
            'Đá tự nhiên' => [
                'Đá Bazan Đen', 'Đá Bluestone',
                'Đá Sandstone Vàng', 'Đá Slate Đa Sắc',
                'Đá Pebble', 'Đá Travertine'
            ],
            'Đá thạch anh' => [
                'Đá Thạch Anh Trắng Tuyết', 'Đá Thạch Anh Vàng Ánh Kim',
                'Đá Thạch Anh Xám Khói', 'Đá Thạch Anh Đen Starlight',
                'Đá Thạch Anh Calacatta', 'Đá Thạch Anh Crystal'
            ]
        ];

        for ($i = 0; $i < 100; $i++) {
            $projectType = $faker->randomElement($projectTypes);
            $province = $faker->randomElement(array_keys($locations));
            $district = $faker->randomElement(array_keys($locations[$province]));
            $ward = $faker->randomElement($locations[$province][$district]);
            
            // Tạo tên dự án
            $prefix = $faker->randomElement(['The', 'Royal', 'Golden', 'Diamond', 'Luxury', 'Elite', 'Premium']);
            $name = $prefix . ' ' . $projectType . ' ' . $ward;
            
            // Đảm bảo slug là duy nhất
            $baseSlug = Str::slug($name);
            $slug = $baseSlug;
            $suffix = 1;
            while (\App\Models\StoneProject::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $suffix;
                $suffix++;
            }
            
            // Chọn khách hàng
            $clientType = $faker->randomElement(array_keys($clients));
            $client = $faker->randomElement($clients[$clientType]);
            
            // Chọn loại đá và ứng dụng
            $stoneApplications = [];
            foreach ($stoneTypes as $type => $stones) {
                $selectedStones = $faker->randomElements($stones, $faker->numberBetween(1, 3));
                foreach ($selectedStones as $stone) {
                    $stoneApplications[] = [
                        'type' => $type,
                        'name' => $stone,
                        'usage' => $this->getStoneUsage($type)
                    ];
                }
            }
            
            StoneProject::create([
                'name' => $name,
                'slug' => $slug,
                'description' => $this->generateDescription($projectType, $ward, $district, $province),
                'content' => $this->generateContent($projectType, $ward, $district, $province, $stoneApplications),
                'client' => $client,
                'location' => $this->generateAddress($ward, $district, $province),
                'province' => $province,
                'region' => $this->getRegion($province),
                'budget' => $faker->numberBetween(100_000_000, 2_000_000_000), // 100 triệu - 2 tỷ
                'completed_date' => $faker->dateTimeBetween('-2 years', '+3 years'),
                'main_image' => 'default/default_image.png',
                'gallery' => json_encode(['default/default_image.png']),
                'status' => $faker->boolean(80), // 80% khả năng active
                'is_featured' => $faker->boolean(20), // 20% khả năng là dự án nổi bật
                'order' => $i + 1,
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-6 months', 'now'),
            ]);
        }
    }

    private function generateDescription($projectType, $ward, $district, $province)
    {
        $descriptions = [
            "Dự án {$projectType} đẳng cấp tại {$ward}, {$district}, {$province} với thiết kế sang trọng và độc đáo",
            "Kiệt tác kiến trúc {$projectType} tọa lạc tại vị trí đắc địa {$ward}, {$district}, {$province}",
            "Công trình {$projectType} cao cấp kết hợp với nghệ thuật sử dụng đá tự nhiên tại {$district}, {$province}",
            "{$projectType} - Biểu tượng của sự sang trọng và đẳng cấp tại {$ward}, {$district}, {$province}"
        ];
        
        // Sử dụng faker để chọn ngẫu nhiên
        $faker = app(\Faker\Generator::class);
        return $faker->randomElement($descriptions);
    }

    private function generateContent($projectType, $ward, $district, $province, $stoneApplications)
    {
        $content = "# Tổng quan dự án\n\n";
        $content .= "Dự án " . mb_strtolower($projectType) . " tọa lạc tại vị trí đắc địa thuộc " . $ward . ", " . $district . ", " . $province;
        $content .= ". Với thiết kế sang trọng và đẳng cấp, dự án hứa hẹn mang đến không gian sống tiện nghi và đẳng cấp.\n\n";
        
        $content .= "# Quy mô dự án\n\n";
        $content .= "- Diện tích đất: " . rand(10000, 100000) . "m²\n";
        $content .= "- Diện tích xây dựng: " . rand(5000, 50000) . "m²\n";
        $content .= "- Mật độ xây dựng: " . rand(40, 60) . "%\n";
        $content .= "- Số tầng cao: " . rand(20, 50) . " tầng\n";
        if (strpos($projectType, 'Chung cư') !== false || strpos($projectType, 'Căn hộ') !== false) {
            $content .= "- Số căn hộ: " . rand(500, 2000) . " căn\n";
            $content .= "- Diện tích căn hộ: " . rand(45, 60) . "m² - " . rand(150, 200) . "m²\n";
        }
        $content .= "\n";
        
        $content .= "# Vật liệu đá sử dụng\n\n";
        foreach ($stoneApplications as $stone) {
            $content .= "## " . $stone['name'] . "\n";
            $content .= "- Loại đá: " . $stone['type'] . "\n";
            $content .= "- Ứng dụng: " . $stone['usage'] . "\n\n";
        }
        
        $content .= "# Tiến độ dự án\n\n";
        $content .= "1. Khởi công: Q" . rand(1,4) . "/2023\n";
        $content .= "2. Hoàn thiện phần thô: Q" . rand(1,4) . "/2024\n";
        $content .= "3. Lắp đặt hoàn thiện: Q" . rand(1,4) . "/2024\n";
        $content .= "4. Lắp đặt nội thất: Q" . rand(1,4) . "/2025\n";
        $content .= "5. Bàn giao: Q" . rand(1,4) . "/2025\n\n";
        
        $content .= "# Đơn vị thi công\n\n";
        $content .= "- Chủ đầu tư: " . $this->generateCompanyName() . "\n";
        $content .= "- Tổng thầu: " . $this->generateCompanyName() . "\n";
        $content .= "- Thiết kế: " . $this->generateCompanyName() . "\n";
        $content .= "- Giám sát: " . $this->generateCompanyName() . "\n";
        $content .= "- Thi công đá: Công ty TNHH " . $this->generateCompanyName() . "\n\n";
        
        $content .= "# Thông tin liên hệ\n\n";
        $content .= "- Hotline: " . $this->generatePhoneNumber() . "\n";
        $content .= "- Email: contact@" . strtolower(Str::random(8)) . ".com\n";
        $content .= "- Website: www." . strtolower(Str::random(8)) . ".com\n";
        $content .= "- Địa chỉ văn phòng: " . $this->generateAddress($ward, $district, $province);
        
        return $content;
    }

    private function generateAddress($ward, $district, $province)
    {
        return "Số " . rand(1, 200) . " " . 
               "Đường " . $this->generateStreetName() . ", " .
               "Phường " . $ward . ", " .
               $district . ", " .
               $province;
    }

    private function generateStreetName()
    {
        $streets = [
            'Nguyễn Huệ', 'Lê Lợi', 'Trần Hưng Đạo', 'Lý Thái Tổ', 'Lê Thánh Tông',
            'Phan Chu Trinh', 'Đinh Tiên Hoàng', 'Trần Phú', 'Lê Duẩn', 'Võ Văn Kiệt',
            'Phạm Văn Đồng', 'Nguyễn Văn Linh', 'Điện Biên Phủ', 'Cách Mạng Tháng Tám',
            'Nguyễn Thị Minh Khai', 'Hai Bà Trưng', 'Nam Kỳ Khởi Nghĩa', 'Tôn Đức Thắng'
        ];
        return $streets[array_rand($streets)];
    }

    private function generateCompanyName()
    {
        $prefixes = ['Xây dựng', 'Kiến trúc', 'Đầu tư', 'Phát triển', 'Tư vấn', 'Thiết kế'];
        $names = ['Phú Hưng', 'Thành Công', 'Hoàng Gia', 'Đại Phát', 'Tân Hoàng Minh', 'An Phú', 'Phú Mỹ'];
        return $prefixes[array_rand($prefixes)] . ' ' . $names[array_rand($names)];
    }

    private function generatePhoneNumber()
    {
        $prefixes = ['0902', '0903', '0904', '0905', '0906', '0907', '0908', '0909'];
        return $prefixes[array_rand($prefixes)] . rand(100000, 999999);
    }

    private function getStoneUsage($stoneType)
    {
        $usages = [
            'Đá granite' => [
                'Ốp mặt tiền tòa nhà',
                'Lát sảnh chính',
                'Ốp cột và tường ngoài',
                'Lát khu vực công cộng'
            ],
            'Đá marble' => [
                'Ốp tường sảnh chính',
                'Lát sàn khu vực cao cấp',
                'Trang trí nội thất',
                'Ốp cầu thang'
            ],
            'Đá tự nhiên' => [
                'Lát sân vườn',
                'Trang trí cảnh quan',
                'Lát đường dạo',
                'Ốp tường trang trí'
            ],
            'Đá thạch anh' => [
                'Mặt bàn bếp',
                'Ốp tường phòng tắm',
                'Mặt bàn reception',
                'Quầy bar và bàn ăn'
            ]
        ];
        
        return $usages[$stoneType][array_rand($usages[$stoneType])];
    }

    private function getRegion($province)
    {
        $regions = [
            'Bắc' => ['Hà Nội', 'Hải Phòng', 'Quảng Ninh', 'Hạ Long', 'Bắc Ninh', 'Hải Dương'],
            'Trung' => ['Đà Nẵng', 'Huế', 'Nha Trang', 'Quảng Nam', 'Bình Định', 'Phú Yên'],
            'Nam' => ['Hồ Chí Minh', 'Bình Dương', 'Đồng Nai', 'Vũng Tàu', 'Cần Thơ', 'Phú Quốc']
        ];

        foreach ($regions as $region => $provinces) {
            if (in_array($province, $provinces)) {
                return $region;
            }
        }

        return 'Khác';
    }
} 