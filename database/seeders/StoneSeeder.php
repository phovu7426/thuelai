<?php

namespace Database\Seeders;

use App\Models\StoneApplication;
use App\Models\StoneCategory;
use App\Models\StoneColor;
use App\Models\StoneMaterial;
use App\Models\StoneProduct;
use App\Models\StoneProductImage;
use App\Models\StoneProject;
use App\Models\StoneShowroom;
use App\Models\StoneSurface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo danh mục đá
        $categories = [
            ['name' => 'Đá Marble', 'slug' => 'da-marble'],
            ['name' => 'Đá Granite', 'slug' => 'da-granite'],
            ['name' => 'Đá Onyx', 'slug' => 'da-onyx'],
            ['name' => 'Đá Travertine', 'slug' => 'da-travertine'],
            ['name' => 'Đá Terrazzo', 'slug' => 'da-terrazzo'],
            ['name' => 'Đá Thạch Anh', 'slug' => 'da-thach-anh'],
        ];
        
        foreach ($categories as $category) {
            StoneCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'status' => true,
                    'order' => 0
                ]
            );
        }
        
        // Tạo chất liệu đá
        $materials = [
            ['name' => 'Đá tự nhiên', 'slug' => 'da-tu-nhien'],
            ['name' => 'Đá nhân tạo', 'slug' => 'da-nhan-tao'],
        ];
        
        foreach ($materials as $material) {
            StoneMaterial::updateOrCreate(
                ['slug' => $material['slug']],
                [
                    'name' => $material['name'],
                    'status' => true,
                    'order' => 0
                ]
            );
        }
        
        // Tạo màu sắc đá
        $colors = [
            ['name' => 'Trắng', 'slug' => 'trang'],
            ['name' => 'Đen', 'slug' => 'den'],
            ['name' => 'Xám', 'slug' => 'xam'],
            ['name' => 'Vàng', 'slug' => 'vang'],
            ['name' => 'Xanh', 'slug' => 'xanh'],
            ['name' => 'Đỏ', 'slug' => 'do'],
            ['name' => 'Nâu', 'slug' => 'nau'],
            ['name' => 'Hồng', 'slug' => 'hong'],
        ];
        
        foreach ($colors as $color) {
            StoneColor::updateOrCreate(
                ['slug' => $color['slug']],
                [
                    'name' => $color['name'],
                    'status' => true,
                    'order' => 0
                ]
            );
        }
        
        // Tạo bề mặt đá
        $surfaces = [
            ['name' => 'Bóng', 'slug' => 'bong'],
            ['name' => 'Mờ', 'slug' => 'mo'],
            ['name' => 'Nhám', 'slug' => 'nham'],
            ['name' => 'Xẻ cắt', 'slug' => 'xe-cat'],
        ];
        
        foreach ($surfaces as $surface) {
            StoneSurface::updateOrCreate(
                ['slug' => $surface['slug']],
                [
                    'name' => $surface['name'],
                    'status' => true,
                    'order' => 0
                ]
            );
        }
        
        // Tạo ứng dụng đá
        $applications = [
            ['name' => 'Mặt bàn bếp', 'slug' => 'mat-ban-bep'],
            ['name' => 'Mặt lavabo', 'slug' => 'mat-lavabo'],
            ['name' => 'Ốp tường', 'slug' => 'op-tuong'],
            ['name' => 'Lát sàn', 'slug' => 'lat-san'],
            ['name' => 'Bậc cầu thang', 'slug' => 'bac-cau-thang'],
            ['name' => 'Mặt tiền', 'slug' => 'mat-tien'],
        ];
        
        foreach ($applications as $application) {
            StoneApplication::updateOrCreate(
                ['slug' => $application['slug']],
                [
                    'name' => $application['name'],
                    'status' => true,
                    'order' => 0
                ]
            );
        }
        
        // Tạo showroom
        $showrooms = [
            [
                'name' => 'Showroom Hải Châu',
                'slug' => 'showroom-hai-chau',
                'address' => '123 Nguyễn Văn Linh, Q. Hải Châu, Đà Nẵng',
                'phone' => '0123.456.789',
                'email' => 'haichau@thanhtungstone.com'
            ],
            [
                'name' => 'Showroom Thanh Khê',
                'slug' => 'showroom-thanh-khe',
                'address' => '456 Lê Duẩn, Q. Thanh Khê, Đà Nẵng',
                'phone' => '0987.654.321',
                'email' => 'thanhkhe@thanhtungstone.com'
            ],
            [
                'name' => 'Showroom Liên Chiểu',
                'slug' => 'showroom-lien-chieu',
                'address' => '789 Nguyễn Tất Thành, Q. Liên Chiểu, Đà Nẵng',
                'phone' => '0909.123.456',
                'email' => 'lienchieu@thanhtungstone.com'
            ],
        ];
        
        foreach ($showrooms as $showroom) {
            StoneShowroom::updateOrCreate(
                ['slug' => $showroom['slug']],
                [
                    'name' => $showroom['name'],
                    'address' => $showroom['address'],
                    'phone' => $showroom['phone'],
                    'email' => $showroom['email'],
                    'status' => true,
                    'order' => 0
                ]
            );
        }
        
        // Tạo dự án
        $projects = [
            [
                'name' => 'Khách sạn Mường Thanh',
                'slug' => 'khach-san-muong-thanh',
                'location' => 'Đà Nẵng',
                'description' => 'Dự án thi công đá marble cho sảnh và phòng tắm khách sạn Mường Thanh',
            ],
            [
                'name' => 'Biệt thự Vinpearl',
                'slug' => 'biet-thu-vinpearl',
                'location' => 'Nha Trang',
                'description' => 'Dự án thi công đá granite cho sàn và cầu thang biệt thự Vinpearl',
            ],
            [
                'name' => 'Chung cư Masteri',
                'slug' => 'chung-cu-masteri',
                'location' => 'TP. Hồ Chí Minh',
                'description' => 'Dự án thi công đá onyx cho quầy bar và bàn bếp chung cư Masteri',
            ],
        ];
        
        foreach ($projects as $project) {
            StoneProject::updateOrCreate(
                ['slug' => $project['slug']],
                [
                    'name' => $project['name'],
                    'location' => $project['location'],
                    'description' => $project['description'],
                    'is_featured' => true,
                    'status' => true,
                    'order' => 0
                ]
            );
        }
        
        // Tạo sản phẩm
        $marbleCategory = StoneCategory::where('slug', 'da-marble')->first();
        $graniteCategory = StoneCategory::where('slug', 'da-granite')->first();
        $onyxCategory = StoneCategory::where('slug', 'da-onyx')->first();
        
        $naturalMaterial = StoneMaterial::where('slug', 'da-tu-nhien')->first();
        $artificialMaterial = StoneMaterial::where('slug', 'da-nhan-tao')->first();
        
        $polishedSurface = StoneSurface::where('slug', 'bong')->first();
        $matteSurface = StoneSurface::where('slug', 'mo')->first();
        
        $whiteColor = StoneColor::where('slug', 'trang')->first();
        $blackColor = StoneColor::where('slug', 'den')->first();
        $grayColor = StoneColor::where('slug', 'xam')->first();
        
        $products = [
            [
                'name' => 'Đá Marble Carrara White',
                'slug' => 'da-marble-carrara-white',
                'code' => 'MCW001',
                'category_id' => $marbleCategory->id,
                'material_id' => $naturalMaterial->id,
                'surface_id' => $polishedSurface->id,
                'color_id' => $whiteColor->id,
                'price' => 1500000,
                'discount_price' => 1350000,
                'discount_percent' => 10,
                'short_description' => 'Đá Marble Carrara White nhập khẩu từ Ý, màu trắng tinh khiết với vân xám nhẹ.',
                'description' => '<p>Đá Marble Carrara White là loại đá tự nhiên cao cấp được khai thác từ mỏ đá nổi tiếng tại vùng Carrara, Ý. Với màu trắng tinh khiết cùng những đường vân xám nhẹ nhàng, thanh thoát, Carrara White mang đến vẻ đẹp sang trọng, tinh tế cho không gian.</p><p>Đá Marble Carrara White thích hợp sử dụng cho các ứng dụng nội thất như mặt bàn bếp, mặt lavabo, ốp tường, lát sàn, bậc cầu thang...</p>',
                'origin' => 'Ý',
                'size' => '300x600mm, 600x600mm, 600x1200mm',
                'thickness' => '15mm, 20mm',
                'is_featured' => true,
                'is_new' => true,
            ],
            [
                'name' => 'Đá Granite Đen Absolute',
                'slug' => 'da-granite-den-absolute',
                'code' => 'GDA002',
                'category_id' => $graniteCategory->id,
                'material_id' => $naturalMaterial->id,
                'surface_id' => $polishedSurface->id,
                'color_id' => $blackColor->id,
                'price' => 1800000,
                'discount_price' => null,
                'discount_percent' => null,
                'short_description' => 'Đá Granite Đen Absolute nhập khẩu từ Ấn Độ, màu đen tuyền, độ cứng cao.',
                'description' => '<p>Đá Granite Đen Absolute là loại đá granite tự nhiên cao cấp được khai thác từ mỏ đá tại Ấn Độ. Với màu đen tuyền, đồng nhất, không vân, Đen Absolute mang đến vẻ đẹp sang trọng, hiện đại cho không gian.</p><p>Đá Granite Đen Absolute có độ cứng cao, khả năng chịu nhiệt tốt, ít thấm nước, dễ dàng vệ sinh và bảo quản. Đây là lựa chọn lý tưởng cho các ứng dụng như mặt bàn bếp, mặt lavabo, ốp tường, lát sàn...</p>',
                'origin' => 'Ấn Độ',
                'size' => '300x600mm, 600x600mm, 600x1200mm',
                'thickness' => '15mm, 20mm',
                'is_featured' => true,
                'is_new' => false,
            ],
            [
                'name' => 'Đá Onyx Honey',
                'slug' => 'da-onyx-honey',
                'code' => 'ONH003',
                'category_id' => $onyxCategory->id,
                'material_id' => $naturalMaterial->id,
                'surface_id' => $polishedSurface->id,
                'color_id' => $whiteColor->id,
                'price' => 2500000,
                'discount_price' => 2250000,
                'discount_percent' => 10,
                'short_description' => 'Đá Onyx Honey nhập khẩu từ Iran, màu vàng mật ong, có khả năng xuyên sáng.',
                'description' => '<p>Đá Onyx Honey là loại đá onyx tự nhiên cao cấp được khai thác từ mỏ đá tại Iran. Với màu vàng mật ong cùng những đường vân đẹp mắt, Onyx Honey mang đến vẻ đẹp sang trọng, độc đáo cho không gian.</p><p>Đặc biệt, đá Onyx Honey có khả năng xuyên sáng, tạo hiệu ứng ánh sáng tuyệt đẹp khi được chiếu sáng từ phía sau. Đây là lựa chọn lý tưởng cho các ứng dụng trang trí nội thất như quầy bar, bàn trà, vách ngăn, đèn trang trí...</p>',
                'origin' => 'Iran',
                'size' => '300x600mm, 600x600mm',
                'thickness' => '10mm, 15mm',
                'is_featured' => true,
                'is_new' => true,
            ],
        ];
        
        foreach ($products as $product) {
            $stoneProduct = StoneProduct::updateOrCreate(
                ['slug' => $product['slug']],
                [
                    'name' => $product['name'],
                    'code' => $product['code'],
                    'stone_category_id' => $product['category_id'],
                    'stone_material_id' => $product['material_id'],
                    'stone_surface_id' => $product['surface_id'],
                    'stone_color_id' => $product['color_id'],
                    'price' => $product['price'],
                    'discount_price' => $product['discount_price'],
                    'discount_percent' => $product['discount_percent'],
                    'short_description' => $product['short_description'],
                    'description' => $product['description'],
                    'origin' => $product['origin'],
                    'size' => $product['size'],
                    'thickness' => $product['thickness'],
                    'is_featured' => $product['is_featured'],
                    'is_new' => $product['is_new'],
                    'status' => true,
                    'order' => 0
                ]
            );
            
            // Tạo hình ảnh cho sản phẩm
            StoneProductImage::updateOrCreate(
                [
                    'stone_product_id' => $stoneProduct->id,
                    'is_main' => true
                ],
                [
                    'path' => 'images/default/default_image.png',
                    'alt' => $stoneProduct->name,
                    'order' => 0
                ]
            );
            
            // Thêm 2 hình ảnh phụ
            for ($i = 1; $i <= 2; $i++) {
                StoneProductImage::updateOrCreate(
                    [
                        'stone_product_id' => $stoneProduct->id,
                        'order' => $i
                    ],
                    [
                        'path' => 'images/default/default_image.png',
                        'alt' => $stoneProduct->name . ' ' . $i,
                        'is_main' => false
                    ]
                );
            }
        }
    }
} 