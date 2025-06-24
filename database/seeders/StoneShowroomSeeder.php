<?php

namespace Database\Seeders;

use App\Models\StoneShowroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoneShowroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $showrooms = [
            [
                'name' => 'Showroom Thanh Thanh Tùng Stone tại Hà Nội',
                'description' => 'Tổng kho đá tự nhiên Thanh Thanh Tùng tại Hà Nội.',
                'address' => '389A Đường Nguyễn Xiển (trụ cầu 141-142) Đại Kim, Hoàng Mai, Hà Nội (đối diện toà nhà EcoGreen, song song bên dưới đường vành đai 3)',
                'province' => 'Hà Nội',
                'phone' => '0981141142',
                'email' => 'thanhthanhtungstones@gmail.com',
                'hotline' => '0914538879',
                'contact_person' => 'Ms Vi',
                'google_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.2745957984775!2d105.81680431500556!3d20.98012798602406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acfb840116c7%3A0x8f94baebe5a9e3e!2zMzg5YSDEkC4gTmd1eeG7hW4gWGnhu4NuLCDEkOG6oWkgS2ltLCBIb8OgbmcgTWFpLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1664343641000!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'image' => 'stone_showrooms/showroom-ha-noi.jpg',
                'order' => 1,
            ],
            [
                'name' => 'Showroom Thanh Thanh Tùng Stone tại HCM',
                'description' => 'Tổng kho đá tự nhiên Thanh Thanh Tùng tại Tp Hồ Chí Minh.',
                'address' => '842 Vườn Lài, phường An Phú Đông, Quận 12, Tp Hồ Chí Minh',
                'province' => 'Hồ Chí Minh',
                'phone' => '0961663636',
                'email' => 'thanhthanhtungstones@gmail.com',
                'hotline' => '0961663636',
                'contact_person' => 'Ms Châu',
                'google_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.5536463565613!2d106.62776415089559!3d10.843938892199882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752b4f2fb7346b%3A0x9b3f6e13c6b68c49!2zODQyIFbGsOG7nW4gTMOgaSwgQW4gUGjDuiDEkMO0bmcsIFF14bqtbiAxMiwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1664343713000!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'image' => 'stone_showrooms/showroom-hcm.jpg',
                'order' => 2,
            ],
            [
                'name' => 'Showroom Thanh Thanh Tùng Stone tại Quảng Ninh',
                'description' => 'Tổng kho đá tự nhiên Thanh Thanh Tùng tại Quảng Ninh.',
                'address' => 'Tổ 15 khu 4B, P. Hùng Thắng, Tp Hạ Long, Quảng Ninh',
                'province' => 'Quảng Ninh',
                'phone' => '0899614888',
                'email' => 'thanhthanhtungstones@gmail.com',
                'hotline' => '0899614888',
                'contact_person' => 'Ms Hiền',
                'google_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.9876123456789!2d107.04893721500512!3d20.95398408605012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a583f7617cd07%3A0x1c5fe0c776a25baf!2zUC4gSMOibmcgVGjhuq9uZywgSMOibmcgVGjhuq9uZywgSMOibmcgVGjhuq9uZywgUXXhuqNuZyBOaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1664343777000!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'image' => 'stone_showrooms/showroom-quang-ninh.jpg',
                'order' => 3,
            ],
            [
                'name' => 'Văn phòng công ty TNHH Thanh Thanh Tùng tại Thanh Hóa',
                'description' => 'Văn phòng công ty TNHH Thanh Thanh Tùng tại Thanh Hóa.',
                'address' => 'Phố Quang, phường An Hưng, Tp Thanh Hóa',
                'province' => 'Thanh Hóa',
                'phone' => '0979298888',
                'email' => 'thanhthanhtungstones@gmail.com',
                'hotline' => '0979298888',
                'contact_person' => 'Mr Tùng',
                'google_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3752.8765432109876!2d105.76542321498603!3d19.80754398667924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3136f81ca6423a71%3A0x2c5de87fc2bc6dd2!2zUGjGsMahbmcgQW4gSMawbmcsIFRwLiBUaGFuaCBIw7NhLCBUaGFuaCBIb8OhLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1664343859000!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'image' => 'stone_showrooms/van-phong-thanh-hoa.jpg',
                'order' => 4,
            ],
            [
                'name' => 'Xưởng sản xuất công ty Thanh Thanh Tùng tại Thanh Hóa',
                'description' => 'Xưởng sản xuất công ty Thanh Thanh Tùng tại Thanh Hóa.',
                'address' => 'Đường 217, KCN Hà Phong, Hà Trung, Thanh Hóa (từ quốc lộ 1A đi vào 800m bên tay trái)',
                'province' => 'Thanh Hóa',
                'phone' => '0979298888',
                'email' => 'thanhthanhtungstones@gmail.com',
                'hotline' => '0979298888',
                'contact_person' => 'Mr Tùng',
                'google_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3751.1357924680864!2d105.86234567654321!3d19.86543211234568!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3136f5a1a9e12345%3A0x3136f5a1a9e12345!2zSMOgIFRydW5nLCBUaGFuaCBIw7NhLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1664343924000!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'image' => 'stone_showrooms/xuong-san-xuat-thanh-hoa.jpg',
                'order' => 5,
            ],
        ];

        foreach ($showrooms as $showroom) {
            StoneShowroom::create([
                'name' => $showroom['name'],
                'slug' => Str::slug($showroom['name']),
                'description' => $showroom['description'],
                'address' => $showroom['address'],
                'province' => $showroom['province'],
                'phone' => $showroom['phone'],
                'email' => $showroom['email'],
                'hotline' => $showroom['hotline'],
                'contact_person' => $showroom['contact_person'],
                'google_map' => $showroom['google_map'],
                'image' => $showroom['image'],
                'status' => 1,
                'order' => $showroom['order'],
            ]);
        }
    }
} 