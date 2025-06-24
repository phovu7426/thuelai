<?php

namespace Database\Seeders;

use App\Models\StoneProject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoneProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'name' => 'Bệnh viện đa khoa Phương Đông',
                'description' => 'Cung cấp và lắp đặt đá ốp lát cho Bệnh viện đa khoa Phương Đông.',
                'content' => '<p>Công ty TNHH Thanh Thanh Tùng đã thực hiện dự án cung cấp và lắp đặt đá ốp lát cho Bệnh viện đa khoa Phương Đông. Dự án bao gồm:</p>
                <ul>
                    <li>Đá ghi sáng lát sảnh chính</li>
                    <li>Đá ghi sáng lát khu vực hành lang</li>
                    <li>Đá ghi sáng lát khu vực cầu thang</li>
                    <li>Đá ghi sáng ốp chân tường</li>
                </ul>
                <p>Tổng diện tích đá: 1.200m2</p>',
                'client' => 'Bệnh viện đa khoa Phương Đông',
                'location' => 'Hà Nội',
                'province' => 'Hà Nội',
                'region' => StoneProject::REGION_NORTH,
                'budget' => 978562000,
                'completed_date' => '2023-05-15',
                'main_image' => 'stone_projects/benh-vien-da-khoa-phuong-dong.jpg',
                'gallery' => json_encode([
                    'stone_projects/benh-vien-da-khoa-phuong-dong-1.jpg',
                    'stone_projects/benh-vien-da-khoa-phuong-dong-2.jpg',
                    'stone_projects/benh-vien-da-khoa-phuong-dong-3.jpg',
                ]),
                'is_featured' => 1,
                'order' => 1,
            ],
            [
                'name' => 'Đền liệt sỹ huyện Hoa Lư',
                'description' => 'Cung cấp và lắp đặt đá ốp lát cho Đền liệt sỹ huyện Hoa Lư.',
                'content' => '<p>Công ty TNHH Thanh Thanh Tùng đã thực hiện dự án cung cấp và lắp đặt đá ốp lát cho Đền liệt sỹ huyện Hoa Lư. Dự án bao gồm:</p>
                <ul>
                    <li>Đá xanh đen lát sân</li>
                    <li>Đá xanh đen lát lối đi</li>
                    <li>Đá xanh đen ốp bậc thềm</li>
                    <li>Đá xanh đen làm lan can</li>
                </ul>
                <p>Tổng diện tích đá: 800m2</p>',
                'client' => 'UBND huyện Hoa Lư',
                'location' => 'Huyện Hoa Lư, Ninh Bình',
                'province' => 'Ninh Bình',
                'region' => StoneProject::REGION_NORTH,
                'budget' => 650000000,
                'completed_date' => '2023-07-20',
                'main_image' => 'stone_projects/den-liet-sy-huyen-hoa-lu.jpg',
                'gallery' => json_encode([
                    'stone_projects/den-liet-sy-huyen-hoa-lu-1.jpg',
                    'stone_projects/den-liet-sy-huyen-hoa-lu-2.jpg',
                ]),
                'is_featured' => 1,
                'order' => 2,
            ],
            [
                'name' => 'Dự án cung cấp đá lát sân ngân hàng Sơn La',
                'description' => 'Cung cấp và lắp đặt đá lát sân cho Ngân hàng Sơn La.',
                'content' => '<p>Công ty TNHH Thanh Thanh Tùng đã thực hiện dự án cung cấp và lắp đặt đá lát sân cho Ngân hàng Sơn La. Dự án bao gồm:</p>
                <ul>
                    <li>Đá xanh rêu lát sân</li>
                    <li>Đá xanh rêu lát lối đi</li>
                    <li>Đá xanh rêu ốp bậc thềm</li>
                </ul>
                <p>Tổng diện tích đá: 600m2</p>',
                'client' => 'Ngân hàng Sơn La',
                'location' => 'Thành phố Sơn La, Sơn La',
                'province' => 'Sơn La',
                'region' => StoneProject::REGION_NORTH,
                'budget' => 790000000,
                'completed_date' => '2023-08-10',
                'main_image' => 'stone_projects/ngan-hang-son-la.jpg',
                'gallery' => json_encode([
                    'stone_projects/ngan-hang-son-la-1.jpg',
                    'stone_projects/ngan-hang-son-la-2.jpg',
                ]),
                'is_featured' => 1,
                'order' => 3,
            ],
            [
                'name' => 'Khu du lịch Phong Nha - Bố Trạch - Quảng Bình',
                'description' => 'Cung cấp và lắp đặt đá ốp lát cho Khu du lịch Phong Nha.',
                'content' => '<p>Công ty TNHH Thanh Thanh Tùng đã thực hiện dự án cung cấp và lắp đặt đá ốp lát cho Khu du lịch Phong Nha. Dự án bao gồm:</p>
                <ul>
                    <li>Đá xanh đen lát sân</li>
                    <li>Đá xanh đen lát lối đi</li>
                    <li>Đá xanh đen ốp bậc thềm</li>
                    <li>Đá xanh đen làm lan can</li>
                </ul>
                <p>Tổng diện tích đá: 1.500m2</p>',
                'client' => 'Ban quản lý Khu du lịch Phong Nha',
                'location' => 'Huyện Bố Trạch, Quảng Bình',
                'province' => 'Quảng Bình',
                'region' => StoneProject::REGION_CENTRAL,
                'budget' => 1200000000,
                'completed_date' => '2023-09-20',
                'main_image' => 'stone_projects/khu-du-lich-phong-nha.jpg',
                'gallery' => json_encode([
                    'stone_projects/khu-du-lich-phong-nha-1.jpg',
                    'stone_projects/khu-du-lich-phong-nha-2.jpg',
                ]),
                'is_featured' => 1,
                'order' => 4,
            ],
            [
                'name' => 'Dự án Nam Định Tower',
                'description' => 'Cung cấp và lắp đặt đá ốp lát cho Nam Định Tower.',
                'content' => '<p>Công ty TNHH Thanh Thanh Tùng đã thực hiện dự án cung cấp và lắp đặt đá ốp lát cho Nam Định Tower. Dự án bao gồm:</p>
                <ul>
                    <li>Đá granite tự nhiên lát sảnh chính</li>
                    <li>Đá granite tự nhiên lát khu vực hành lang</li>
                    <li>Đá granite tự nhiên lát khu vực cầu thang</li>
                    <li>Đá granite tự nhiên ốp chân tường</li>
                </ul>
                <p>Tổng diện tích đá: 900m2</p>',
                'client' => 'Công ty CP Đầu tư Nam Định Tower',
                'location' => 'Thành phố Nam Định, Nam Định',
                'province' => 'Nam Định',
                'region' => StoneProject::REGION_NORTH,
                'budget' => 484200000,
                'completed_date' => '2023-10-15',
                'main_image' => 'stone_projects/nam-dinh-tower.jpg',
                'gallery' => json_encode([
                    'stone_projects/nam-dinh-tower-1.jpg',
                    'stone_projects/nam-dinh-tower-2.jpg',
                ]),
                'is_featured' => 1,
                'order' => 5,
            ],
        ];

        foreach ($projects as $project) {
            StoneProject::create([
                'name' => $project['name'],
                'slug' => Str::slug($project['name']),
                'description' => $project['description'],
                'content' => $project['content'],
                'client' => $project['client'],
                'location' => $project['location'],
                'province' => $project['province'],
                'region' => $project['region'],
                'budget' => $project['budget'],
                'completed_date' => $project['completed_date'],
                'main_image' => $project['main_image'],
                'gallery' => $project['gallery'],
                'status' => 1,
                'is_featured' => $project['is_featured'],
                'order' => $project['order'],
            ]);
        }
    }
} 