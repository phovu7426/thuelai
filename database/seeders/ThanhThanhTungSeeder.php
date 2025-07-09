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
use App\Models\StoneVideo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ThanhThanhTungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed categories based on Thanh Thanh Tung website
        $categories = [
            ['name' => 'Đá Marble', 'slug' => 'da-marble', 'order' => 1],
            ['name' => 'Đá Granite', 'slug' => 'da-granite', 'order' => 2],
            ['name' => 'Đá Nhân Tạo', 'slug' => 'da-nhan-tao', 'order' => 3],
            ['name' => 'Đá Thạch Anh', 'slug' => 'da-thach-anh', 'order' => 4],
        ];
        
        foreach ($categories as $category) {
            StoneCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'status' => true,
                    'order' => $category['order']
                ]
            );
        }
        
        // Seed materials
        $materials = [
            ['name' => 'Đá tự nhiên', 'slug' => 'da-tu-nhien', 'order' => 1],
            ['name' => 'Đá nhân tạo', 'slug' => 'da-nhan-tao', 'order' => 2],
        ];
        
        foreach ($materials as $material) {
            StoneMaterial::updateOrCreate(
                ['slug' => $material['slug']],
                [
                    'name' => $material['name'],
                    'status' => true,
                    'order' => $material['order']
                ]
            );
        }
        
        // Seed colors
        $colors = [
            ['name' => 'Trắng', 'slug' => 'trang'],
            ['name' => 'Đen', 'slug' => 'den'],
            ['name' => 'Xám', 'slug' => 'xam'],
            ['name' => 'Vàng', 'slug' => 'vang'],
            ['name' => 'Xanh', 'slug' => 'xanh'],
            ['name' => 'Đỏ', 'slug' => 'do'],
            ['name' => 'Nâu', 'slug' => 'nau'],
            ['name' => 'Hồng', 'slug' => 'hong'],
            ['name' => 'Kem', 'slug' => 'kem'],
            ['name' => 'Đa màu', 'slug' => 'da-mau'],
        ];
        
        foreach ($colors as $index => $color) {
            StoneColor::updateOrCreate(
                ['slug' => $color['slug']],
                [
                    'name' => $color['name'],
                    'status' => true,
                    'order' => $index + 1
                ]
            );
        }
        
        // Seed surfaces
        $surfaces = [
            ['name' => 'Bóng', 'slug' => 'bong'],
            ['name' => 'Mờ', 'slug' => 'mo'],
            ['name' => 'Nhám', 'slug' => 'nham'],
            ['name' => 'Xẻ cắt', 'slug' => 'xe-cat'],
            ['name' => 'Mài mịn', 'slug' => 'mai-min'],
        ];
        
        foreach ($surfaces as $index => $surface) {
            StoneSurface::updateOrCreate(
                ['slug' => $surface['slug']],
                [
                    'name' => $surface['name'],
                    'status' => true,
                    'order' => $index + 1
                ]
            );
        }
        
        // Seed applications
        $applications = [
            ['name' => 'Mặt bàn bếp', 'slug' => 'mat-ban-bep'],
            ['name' => 'Mặt lavabo', 'slug' => 'mat-lavabo'],
            ['name' => 'Ốp tường', 'slug' => 'op-tuong'],
            ['name' => 'Lát sàn', 'slug' => 'lat-san'],
            ['name' => 'Bậc cầu thang', 'slug' => 'bac-cau-thang'],
            ['name' => 'Mặt tiền', 'slug' => 'mat-tien'],
            ['name' => 'Quầy bar', 'slug' => 'quay-bar'],
            ['name' => 'Bàn trà', 'slug' => 'ban-tra'],
        ];
        
        foreach ($applications as $index => $application) {
            StoneApplication::updateOrCreate(
                ['slug' => $application['slug']],
                [
                    'name' => $application['name'],
                    'status' => true,
                    'order' => $index + 1
                ]
            );
        }
        
        // Seed showrooms (from Thanh Thanh Tung website)
        $showrooms = [
            [
                'name' => 'Showroom Thanh Hóa',
                'slug' => 'showroom-thanh-hoa',
                'address' => 'Phố Quang, phường An Hưng, Tp Thanh Hóa',
                'phone' => '097.929.8888',
                'email' => 'thanhthanhtungstones@gmail.com',
                'order' => 1
            ],
            [
                'name' => 'Showroom Hà Nội',
                'slug' => 'showroom-ha-noi',
                'address' => '389A Đường Nguyễn Xiển, Đại Kim, Hoàng Mai, Hà Nội',
                'phone' => '0981.141.142',
                'email' => 'thanhthanhtungstones@gmail.com',
                'order' => 2
            ],
            [
                'name' => 'Showroom Hồ Chí Minh',
                'slug' => 'showroom-ho-chi-minh',
                'address' => '842 Vườn Lài, phường An Phú Đông, Quận 12, Tp Hồ Chí Minh',
                'phone' => '0961.66.3636',
                'email' => 'thanhthanhtungstones@gmail.com',
                'order' => 3
            ],
            [
                'name' => 'Showroom Quảng Ninh',
                'slug' => 'showroom-quang-ninh',
                'address' => 'Tổ 15 khu 4B, P. Hùng Thắng, Tp Hạ Long, Quảng Ninh',
                'phone' => '0899.614.888',
                'email' => 'thanhthanhtungstones@gmail.com',
                'order' => 4
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
                    'order' => $showroom['order']
                ]
            );
        }
        
        // Seed projects
        $projects = [
            [
                'name' => 'Khu đô thị Goldmark City',
                'slug' => 'khu-do-thi-goldmark-city',
                'location' => 'Hà Nội',
                'description' => 'Cung cấp và thi công đá ốp lát cho khu đô thị Goldmark City',
                'is_featured' => true,
                'order' => 1
            ],
            [
                'name' => 'Khu nghỉ dưỡng Bãi Dừa',
                'slug' => 'khu-nghi-duong-bai-dua',
                'location' => 'Hà Tĩnh',
                'description' => 'Cung cấp và thi công đá ốp lát cho khu nghỉ dưỡng Bãi Dừa',
                'is_featured' => true,
                'order' => 2
            ],
            [
                'name' => 'Nghĩa trang liệt sỹ Nam Gành',
                'slug' => 'nghia-trang-liet-sy-nam-ganh',
                'location' => 'Thanh Hóa',
                'description' => 'Cung cấp và thi công đá ốp lát cho nghĩa trang liệt sỹ Nam Gành',
                'is_featured' => true,
                'order' => 3
            ],
            [
                'name' => 'Khu du lịch Phong Nha',
                'slug' => 'khu-du-lich-phong-nha',
                'location' => 'Quảng Bình',
                'description' => 'Cung cấp và thi công đá ốp lát cho khu du lịch Phong Nha',
                'is_featured' => true,
                'order' => 4
            ],
            [
                'name' => 'Khu đô thị Xuân An',
                'slug' => 'khu-do-thi-xuan-an',
                'location' => 'Hà Tĩnh',
                'description' => 'Cung cấp và thi công đá ốp lát cho khu đô thị Xuân An',
                'is_featured' => true,
                'order' => 5
            ],
        ];
        
        foreach ($projects as $project) {
            StoneProject::updateOrCreate(
                ['slug' => $project['slug']],
                [
                    'name' => $project['name'],
                    'location' => $project['location'],
                    'description' => $project['description'],
                    'is_featured' => $project['is_featured'],
                    'status' => true,
                    'order' => $project['order']
                ]
            );
        }
        
        // Seed videos
        $videos = [
            [
                'title' => 'Đá xanh đen băm toàn phần 30x60',
                'slug' => 'da-xanh-den-bam-toan-phan-30x60',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Sửa từ youtube_id thành video_url
                'description' => 'Video giới thiệu đá xanh đen băm toàn phần kích thước 30x60',
                'is_featured' => true,
                'order' => 1
            ],
            [
                'title' => 'Đá xanh đen băm toàn phần 40x40',
                'slug' => 'da-xanh-den-bam-toan-phan-40x40',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Sửa từ youtube_id thành video_url
                'description' => 'Video giới thiệu đá xanh đen băm toàn phần kích thước 40x40',
                'is_featured' => true,
                'order' => 2
            ],
            [
                'title' => 'Đá xanh đen băm trừ viền hone',
                'slug' => 'da-xanh-den-bam-tru-vien-hone',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Sửa từ youtube_id thành video_url
                'description' => 'Video giới thiệu đá xanh đen băm trừ viền hone',
                'is_featured' => true,
                'order' => 3
            ],
            [
                'title' => 'Đá xanh rêu thô tinh',
                'slug' => 'da-xanh-reu-tho-tinh',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Sửa từ youtube_id thành video_url
                'description' => 'Video giới thiệu đá xanh rêu thô tinh',
                'is_featured' => true,
                'order' => 4
            ],
        ];
        
        foreach ($videos as $video) {
            StoneVideo::updateOrCreate(
                ['slug' => $video['slug']],
                [
                    'title' => $video['title'],
                    'video_url' => $video['video_url'], // Sửa từ youtube_id thành video_url
                    'description' => $video['description'],
                    'is_featured' => $video['is_featured'],
                    'status' => true,
                    'order' => $video['order']
                ]
            );
        }
        
        // Get references to categories, materials, surfaces, and colors
        $marbleCategory = StoneCategory::where('slug', 'da-marble')->first();
        $graniteCategory = StoneCategory::where('slug', 'da-granite')->first();
        $artificialCategory = StoneCategory::where('slug', 'da-nhan-tao')->first();
        $quartzCategory = StoneCategory::where('slug', 'da-thach-anh')->first();
        
        $naturalMaterial = StoneMaterial::where('slug', 'da-tu-nhien')->first();
        $artificialMaterial = StoneMaterial::where('slug', 'da-nhan-tao')->first();
        
        $polishedSurface = StoneSurface::where('slug', 'bong')->first();
        $matteSurface = StoneSurface::where('slug', 'mo')->first();
        
        $whiteColor = StoneColor::where('slug', 'trang')->first();
        $blackColor = StoneColor::where('slug', 'den')->first();
        $grayColor = StoneColor::where('slug', 'xam')->first();
        $beigeColor = StoneColor::where('slug', 'kem')->first();
        $multiColor = StoneColor::where('slug', 'da-mau')->first();
        
        // Seed products based on Thanh Thanh Tung website
        $products = [
            [
                'name' => 'Đá xanh đen băm toàn phần',
                'slug' => 'da-xanh-den-bam-toan-phan',
                'code' => 'XD001',
                'stone_category_id' => $graniteCategory->id, // Sửa từ category_id thành stone_category_id
                'stone_material_id' => $naturalMaterial->id, // Sửa từ material_id thành stone_material_id
                'stone_surface_id' => $matteSurface->id, // Sửa từ surface_id thành stone_surface_id
                'stone_color_id' => $blackColor->id, // Sửa từ color_id thành stone_color_id
                'price' => 450000,
                'sale_price' => null, // Sửa từ discount_price thành sale_price
                'discount_percent' => null,
                'short_description' => 'Đá xanh đen băm toàn phần, bề mặt nhám, chống trơn trượt.',
                'description' => '<p>Đá xanh đen băm toàn phần là loại đá tự nhiên cao cấp được khai thác từ mỏ đá tại Việt Nam. Với màu đen đặc trưng và bề mặt được băm nhám toàn phần, đá xanh đen mang đến khả năng chống trơn trượt tốt, phù hợp cho các khu vực ngoại thất.</p><p>Đá xanh đen băm toàn phần có độ cứng cao, khả năng chịu lực tốt, ít thấm nước, dễ dàng vệ sinh và bảo quản. Đây là lựa chọn lý tưởng cho các ứng dụng như lát sân vườn, vỉa hè, lối đi...</p>',
                'origin' => 'Việt Nam',
                'size' => '300x600mm, 400x400mm',
                'thickness' => '20mm, 30mm',
                'is_featured' => true,
                'is_new' => false,
                'order' => 1
            ],
            [
                'name' => 'Đá xanh rêu thô tinh',
                'slug' => 'da-xanh-reu-tho-tinh',
                'code' => 'XR002',
                'stone_category_id' => $graniteCategory->id,
                'stone_material_id' => $naturalMaterial->id,
                'stone_surface_id' => $matteSurface->id,
                'stone_color_id' => $grayColor->id, // Sửa từ color_id thành stone_color_id
                'price' => 500000,
                'sale_price' => null,
                'discount_percent' => null,
                'short_description' => 'Đá xanh rêu thô tinh, bề mặt nhám, màu xanh rêu tự nhiên.',
                'description' => '<p>Đá xanh rêu thô tinh là loại đá tự nhiên cao cấp được khai thác từ mỏ đá tại Việt Nam. Với màu xanh rêu đặc trưng và bề mặt thô tinh, đá xanh rêu mang đến vẻ đẹp tự nhiên, phù hợp cho các khu vực ngoại thất.</p><p>Đá xanh rêu thô tinh có độ cứng cao, khả năng chịu lực tốt, ít thấm nước, dễ dàng vệ sinh và bảo quản. Đây là lựa chọn lý tưởng cho các ứng dụng như lát sân vườn, vỉa hè, lối đi...</p>',
                'origin' => 'Việt Nam',
                'size' => '300x600mm, 400x400mm',
                'thickness' => '20mm, 30mm',
                'is_featured' => true,
                'is_new' => false,
                'order' => 2
            ],
            [
                'name' => 'Đá Marble Carrara White',
                'slug' => 'da-marble-carrara-white',
                'code' => 'MCW003',
                'stone_category_id' => $marbleCategory->id,
                'stone_material_id' => $naturalMaterial->id,
                'stone_surface_id' => $polishedSurface->id,
                'stone_color_id' => $whiteColor->id, // Sửa từ color_id thành stone_color_id
                'price' => 1800000,
                'sale_price' => 1650000,
                'discount_percent' => 8,
                'short_description' => 'Đá Marble Carrara White nhập khẩu từ Ý, màu trắng tinh khiết với vân xám nhẹ.',
                'description' => '<p>Đá Marble Carrara White là loại đá tự nhiên cao cấp được khai thác từ mỏ đá nổi tiếng tại vùng Carrara, Ý. Với màu trắng tinh khiết cùng những đường vân xám nhẹ nhàng, thanh thoát, Carrara White mang đến vẻ đẹp sang trọng, tinh tế cho không gian.</p><p>Đá Marble Carrara White thích hợp sử dụng cho các ứng dụng nội thất như mặt bàn bếp, mặt lavabo, ốp tường, lát sàn, bậc cầu thang...</p>',
                'origin' => 'Ý',
                'size' => '300x600mm, 600x600mm, 600x1200mm',
                'thickness' => '15mm, 20mm',
                'is_featured' => true,
                'is_new' => true,
                'order' => 3
            ],
            [
                'name' => 'Đá Granite Đen Absolute',
                'slug' => 'da-granite-den-absolute',
                'code' => 'GDA004',
                'stone_category_id' => $graniteCategory->id,
                'stone_material_id' => $naturalMaterial->id,
                'stone_surface_id' => $polishedSurface->id,
                'stone_color_id' => $blackColor->id, // Sửa từ color_id thành stone_color_id
                'price' => 2200000,
                'sale_price' => null,
                'discount_percent' => null,
                'short_description' => 'Đá Granite Đen Absolute nhập khẩu từ Ấn Độ, màu đen tuyền, độ cứng cao.',
                'description' => '<p>Đá Granite Đen Absolute là loại đá granite tự nhiên cao cấp được khai thác từ mỏ đá tại Ấn Độ. Với màu đen tuyền, đồng nhất, không vân, Đen Absolute mang đến vẻ đẹp sang trọng, hiện đại cho không gian.</p><p>Đá Granite Đen Absolute có độ cứng cao, khả năng chịu nhiệt tốt, ít thấm nước, dễ dàng vệ sinh và bảo quản. Đây là lựa chọn lý tưởng cho các ứng dụng như mặt bàn bếp, mặt lavabo, ốp tường, lát sàn...</p>',
                'origin' => 'Ấn Độ',
                'size' => '300x600mm, 600x600mm, 600x1200mm',
                'thickness' => '15mm, 20mm',
                'is_featured' => true,
                'is_new' => false,
                'order' => 4
            ],
            [
                'name' => 'Đá Marble Calacatta Gold',
                'slug' => 'da-marble-calacatta-gold',
                'code' => 'MCG005',
                'stone_category_id' => $marbleCategory->id,
                'stone_material_id' => $naturalMaterial->id,
                'stone_surface_id' => $polishedSurface->id,
                'stone_color_id' => $whiteColor->id, // Sửa từ color_id thành stone_color_id
                'price' => 2500000,
                'sale_price' => 2250000,
                'discount_percent' => 10,
                'short_description' => 'Đá Marble Calacatta Gold nhập khẩu từ Ý, màu trắng với vân vàng đặc trưng.',
                'description' => '<p>Đá Marble Calacatta Gold là loại đá tự nhiên cao cấp được khai thác từ mỏ đá nổi tiếng tại Ý. Với nền trắng tinh khiết cùng những đường vân vàng đậm đặc trưng, Calacatta Gold mang đến vẻ đẹp sang trọng, đẳng cấp cho không gian.</p><p>Đá Marble Calacatta Gold thích hợp sử dụng cho các ứng dụng nội thất cao cấp như mặt bàn bếp, mặt lavabo, ốp tường, lát sàn...</p>',
                'origin' => 'Ý',
                'size' => '300x600mm, 600x600mm, 600x1200mm',
                'thickness' => '15mm, 20mm',
                'is_featured' => true,
                'is_new' => true,
                'order' => 5
            ],
        ];
        
        // Create products
        foreach ($products as $productData) {
            $product = StoneProduct::updateOrCreate(
                ['slug' => $productData['slug']],
                [
                    'name' => $productData['name'],
                    'code' => $productData['code'],
                    'stone_category_id' => $productData['stone_category_id'],
                    'stone_material_id' => $productData['stone_material_id'],
                    'stone_surface_id' => $productData['stone_surface_id'],
                    'stone_color_id' => $productData['stone_color_id'],
                    'price' => $productData['price'],
                    'sale_price' => $productData['sale_price'],
                    'discount_percent' => $productData['discount_percent'],
                    'short_description' => $productData['short_description'],
                    'description' => $productData['description'],
                    'is_featured' => $productData['is_featured'],
                    'is_new' => $productData['is_new'],
                    'status' => true,
                    'order' => $productData['order']
                ]
            );
            
            // Sửa lại phần tạo product images
            // Create product images
            $imageCount = rand(3, 5);
            for ($i = 1; $i <= $imageCount; $i++) {
                // Sử dụng hình ảnh phù hợp với loại đá
                $imagePath = '';
                if (strpos($product->name, 'Marble') !== false) {
                    $imagePath = 'images/products/marble-' . rand(1, 4) . '.jpg';
                } elseif (strpos($product->name, 'Granite') !== false) {
                    $imagePath = 'images/products/granite-' . rand(1, 4) . '.jpg';
                } elseif (strpos($product->name, 'xanh đen') !== false) {
                    $imagePath = 'images/products/da-xanh-den-' . rand(1, 4) . '.jpg';
                } elseif (strpos($product->name, 'xanh rêu') !== false) {
                    $imagePath = 'images/products/da-xanh-reu-' . rand(1, 4) . '.jpg';
                } else {
                    $imagePath = 'images/products/stone-' . rand(1, 4) . '.jpg';
                }
                
                // Tạo thư mục images/products nếu chưa tồn tại
                if (!file_exists(public_path('images/products'))) {
                    mkdir(public_path('images/products'), 0755, true);
                }
                
                // Sao chép hình ảnh mẫu nếu không tồn tại
                if (!file_exists(public_path($imagePath))) {
                    // Sử dụng hình ảnh mặc định từ public/images
                    $defaultImage = 'images/products/product-' . rand(1, 4) . '.jpg';
                    if (file_exists(public_path($defaultImage))) {
                        copy(public_path($defaultImage), public_path($imagePath));
                    }
                }
                
                StoneProductImage::updateOrCreate(
                    [
                        'stone_product_id' => $product->id,
                        'order' => $i
                    ],
                    [
                        'path' => $imagePath,
                        'alt' => $product->name . ' - Hình ' . $i,
                        'is_main' => ($i == 1), // Hình đầu tiên là hình chính
                        'order' => $i
                    ]
                );
            }
            
            // Connect products with applications
            $applicationIds = StoneApplication::inRandomOrder()->limit(rand(2, 4))->pluck('id')->toArray();
            $product->applications()->sync($applicationIds);
        }
    }
} 