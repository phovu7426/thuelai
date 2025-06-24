<?php

namespace Database\Seeders;

use App\Models\StoneApplication;
use App\Models\StoneCategory;
use App\Models\StoneMaterial;
use App\Models\StoneProduct;
use App\Models\StoneSurface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoneProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy thông tin danh mục
        $daOpLatCategory = StoneCategory::where('name', 'Đá ốp lát')->first();
        $daMyNgheCategory = StoneCategory::where('name', 'Đá mỹ nghệ')->first();

        $daNoiThatCategory = StoneCategory::where('name', 'Đá ốp lát nội thất')->first();
        $daNgoaiThatCategory = StoneCategory::where('name', 'Đá ốp lát ngoại thất')->first();
        $daBoViaCategory = StoneCategory::where('name', 'Đá bó vỉa')->first();
        $daCubicCategory = StoneCategory::where('name', 'Đá cubic')->first();

        $daLangMoCategory = StoneCategory::where('name', 'Đá mỹ nghệ lăng mộ')->first();
        $daDinhChuaCategory = StoneCategory::where('name', 'Đá mỹ nghệ đình chùa')->first();
        $daNhaThoCatehory = StoneCategory::where('name', 'Đá mỹ nghệ nhà thờ')->first();

        // Lấy thông tin chất liệu đá
        $daGhiSang = StoneMaterial::where('name', 'Đá ghi sáng')->first();
        $daXanhDen = StoneMaterial::where('name', 'Đá xanh đen')->first();
        $daXanhReu = StoneMaterial::where('name', 'Đá xanh rêu')->first();
        $daBazan = StoneMaterial::where('name', 'Đá bazan')->first();
        $daAanhKim = StoneMaterial::where('name', 'Đá ánh kim')->first();
        $daSocDua = StoneMaterial::where('name', 'Đá sọc dưa')->first();

        // Lấy thông tin bề mặt đá
        $bamNham = StoneSurface::where('name', 'Băm nhám')->first();
        $bamTrangTri = StoneSurface::where('name', 'Băm trang trí')->first();
        $xeTho = StoneSurface::where('name', 'Xẻ thô')->first();
        $maiTho = StoneSurface::where('name', 'Mài thô')->first();
        $maiHone = StoneSurface::where('name', 'Mài hone')->first();
        $maiBong = StoneSurface::where('name', 'Mài bóng')->first();

        // Lấy thông tin ứng dụng
        $viaHe = StoneApplication::where('name', 'Vỉa hè')->first();
        $sanVuon = StoneApplication::where('name', 'Sân vườn')->first();
        $quangTruong = StoneApplication::where('name', 'Quảng trường')->first();
        $beBoi = StoneApplication::where('name', 'Bể bơi')->first();
        $bacTamCap = StoneApplication::where('name', 'Bậc tam cấp')->first();

        $sanNha = StoneApplication::where('name', 'Sàn nhà')->first();
        $matTien = StoneApplication::where('name', 'Mặt tiền')->first();
        $cauThangBo = StoneApplication::where('name', 'Cầu thang bộ')->first();
        $banBep = StoneApplication::where('name', 'Bàn bếp')->first();

        // Tạo các sản phẩm đá ốp lát ngoại thất
        $exteriorProducts = [
            [
                'name' => 'Đá xanh đen băm toàn phần 30x60',
                'code' => 'XD-BTP-3060',
                'short_description' => 'Đá xanh đen băm toàn phần kích thước 30x60cm, chất lượng cao, bền đẹp.',
                'description' => 'Đá xanh đen băm toàn phần kích thước 30x60cm là sản phẩm cao cấp, được sử dụng phổ biến trong các công trình vỉa hè, sân vườn, quảng trường. Với kích thước 30x60cm và bề mặt băm toàn phần, sản phẩm tạo độ nhám, chống trơn trượt hiệu quả. Đá có độ bền cao, chịu được thời tiết khắc nghiệt, dễ dàng lau chùi và bảo dưỡng.',
                'main_image' => 'stone_products/da-xanh-den-bam-toan-phan-30x60.jpg',
                'gallery' => json_encode([
                    'stone_products/da-xanh-den-bam-toan-phan-30x60-1.jpg',
                    'stone_products/da-xanh-den-bam-toan-phan-30x60-2.jpg',
                    'stone_products/da-xanh-den-bam-toan-phan-30x60-3.jpg',
                ]),
                'price' => 350000,
                'sale_price' => 320000,
                'specifications' => json_encode([
                    'Kích thước' => '30x60cm',
                    'Độ dày' => '3cm',
                    'Khối lượng' => '~12kg/viên',
                    'Số viên/m2' => '~5.5 viên',
                ]),
                'stone_category_id' => $daNgoaiThatCategory ? $daNgoaiThatCategory->id : null,
                'stone_material_id' => $daXanhDen->id,
                'stone_surface_id' => $bamNham->id,
                'is_featured' => 1,
                'applications' => [$viaHe->id, $sanVuon->id, $quangTruong->id],
            ],
            [
                'name' => 'Đá xanh đen băm toàn phần 40x40',
                'code' => 'XD-BTP-4040',
                'short_description' => 'Đá xanh đen băm toàn phần kích thước 40x40cm, chất lượng cao, bền đẹp.',
                'description' => 'Đá xanh đen băm toàn phần kích thước 40x40cm là sản phẩm cao cấp, được sử dụng phổ biến trong các công trình vỉa hè, sân vườn, quảng trường. Với kích thước 40x40cm và bề mặt băm toàn phần, sản phẩm tạo độ nhám, chống trơn trượt hiệu quả. Đá có độ bền cao, chịu được thời tiết khắc nghiệt, dễ dàng lau chùi và bảo dưỡng.',
                'main_image' => 'stone_products/da-xanh-den-bam-toan-phan-40x40.jpg',
                'gallery' => json_encode([
                    'stone_products/da-xanh-den-bam-toan-phan-40x40-1.jpg',
                    'stone_products/da-xanh-den-bam-toan-phan-40x40-2.jpg',
                ]),
                'price' => 420000,
                'sale_price' => 400000,
                'specifications' => json_encode([
                    'Kích thước' => '40x40cm',
                    'Độ dày' => '3cm',
                    'Khối lượng' => '~13kg/viên',
                    'Số viên/m2' => '~6.25 viên',
                ]),
                'stone_category_id' => $daNgoaiThatCategory ? $daNgoaiThatCategory->id : null,
                'stone_material_id' => $daXanhDen->id,
                'stone_surface_id' => $bamNham->id,
                'is_featured' => 1,
                'applications' => [$viaHe->id, $sanVuon->id, $quangTruong->id, $beBoi->id],
            ],
            [
                'name' => 'Đá xanh đen băm trừ viền hone',
                'code' => 'XD-BTVH',
                'short_description' => 'Đá xanh đen băm trừ viền hone, chất lượng cao, bền đẹp.',
                'description' => 'Đá xanh đen băm trừ viền hone là sản phẩm cao cấp, được chế tác tinh xảo với phần viền được mài hone mịn, phần giữa được băm nhám tạo độ nhám, chống trơn trượt hiệu quả. Sản phẩm được sử dụng phổ biến trong các công trình vỉa hè, sân vườn, quảng trường. Đá có độ bền cao, chịu được thời tiết khắc nghiệt, dễ dàng lau chùi và bảo dưỡng.',
                'main_image' => 'stone_products/da-xanh-den-bam-tru-vien-hone.jpg',
                'gallery' => json_encode([
                    'stone_products/da-xanh-den-bam-tru-vien-hone-1.jpg',
                    'stone_products/da-xanh-den-bam-tru-vien-hone-2.jpg',
                ]),
                'price' => 450000,
                'sale_price' => 430000,
                'specifications' => json_encode([
                    'Kích thước' => '30x60cm',
                    'Độ dày' => '3cm',
                    'Khối lượng' => '~12kg/viên',
                    'Số viên/m2' => '~5.5 viên',
                ]),
                'stone_category_id' => $daNgoaiThatCategory ? $daNgoaiThatCategory->id : null,
                'stone_material_id' => $daXanhDen->id,
                'stone_surface_id' => $bamNham->id,
                'is_featured' => 1,
                'applications' => [$viaHe->id, $sanVuon->id, $quangTruong->id, $bacTamCap->id],
            ],
            [
                'name' => 'Đá xanh rêu thô tinh',
                'code' => 'XR-TT',
                'short_description' => 'Đá xanh rêu thô tinh, chất lượng cao, bền đẹp.',
                'description' => 'Đá xanh rêu thô tinh là sản phẩm cao cấp, được chế tác với bề mặt thô tự nhiên nhưng đã được xử lý tinh tế, tạo vẻ đẹp tự nhiên cho công trình. Sản phẩm được sử dụng phổ biến trong các công trình sân vườn, quảng trường, bậc tam cấp. Đá có độ bền cao, chịu được thời tiết khắc nghiệt, dễ dàng lau chùi và bảo dưỡng.',
                'main_image' => 'stone_products/da-xanh-reu-tho-tinh.jpg',
                'gallery' => json_encode([
                    'stone_products/da-xanh-reu-tho-tinh-1.jpg',
                    'stone_products/da-xanh-reu-tho-tinh-2.jpg',
                ]),
                'price' => 380000,
                'sale_price' => 360000,
                'specifications' => json_encode([
                    'Kích thước' => '30x60cm',
                    'Độ dày' => '3cm',
                    'Khối lượng' => '~12kg/viên',
                    'Số viên/m2' => '~5.5 viên',
                ]),
                'stone_category_id' => $daNgoaiThatCategory ? $daNgoaiThatCategory->id : null,
                'stone_material_id' => $daXanhReu->id,
                'stone_surface_id' => $xeTho->id,
                'is_featured' => 1,
                'applications' => [$sanVuon->id, $quangTruong->id, $bacTamCap->id],
            ],
        ];

        // Tạo các sản phẩm đá ốp lát nội thất
        $interiorProducts = [
            [
                'name' => 'Đá granite tự nhiên đen ốp cầu thang',
                'code' => 'GR-DEN-CT',
                'short_description' => 'Đá granite tự nhiên đen ốp cầu thang, chất lượng cao, bền đẹp.',
                'description' => 'Đá granite tự nhiên đen ốp cầu thang là sản phẩm cao cấp, được chế tác tinh xảo với bề mặt mài bóng tạo vẻ đẹp sang trọng cho công trình. Sản phẩm được sử dụng phổ biến trong các công trình cầu thang bộ, sàn nhà, mặt tiền. Đá có độ bền cao, dễ dàng lau chùi và bảo dưỡng.',
                'main_image' => 'stone_products/da-granite-tu-nhien-den-op-cau-thang.jpg',
                'gallery' => json_encode([
                    'stone_products/da-granite-tu-nhien-den-op-cau-thang-1.jpg',
                    'stone_products/da-granite-tu-nhien-den-op-cau-thang-2.jpg',
                ]),
                'price' => 850000,
                'sale_price' => 800000,
                'specifications' => json_encode([
                    'Kích thước' => 'Theo yêu cầu',
                    'Độ dày' => '2-3cm',
                    'Độ bóng' => '>95%',
                ]),
                'stone_category_id' => $daNoiThatCategory->id,
                'stone_material_id' => $daXanhDen->id,
                'stone_surface_id' => $maiBong->id,
                'is_featured' => 1,
                'applications' => [$cauThangBo->id, $sanNha->id],
            ],
            [
                'name' => 'Đá ghi sáng mài bóng ốp mặt tiền',
                'code' => 'GS-MB-MT',
                'short_description' => 'Đá ghi sáng mài bóng ốp mặt tiền, chất lượng cao, bền đẹp.',
                'description' => 'Đá ghi sáng mài bóng ốp mặt tiền là sản phẩm cao cấp, được chế tác tinh xảo với bề mặt mài bóng tạo vẻ đẹp sang trọng cho công trình. Sản phẩm được sử dụng phổ biến trong các công trình mặt tiền, sàn nhà. Đá có độ bền cao, dễ dàng lau chùi và bảo dưỡng.',
                'main_image' => 'stone_products/da-ghi-sang-mai-bong-op-mat-tien.jpg',
                'gallery' => json_encode([
                    'stone_products/da-ghi-sang-mai-bong-op-mat-tien-1.jpg',
                    'stone_products/da-ghi-sang-mai-bong-op-mat-tien-2.jpg',
                ]),
                'price' => 750000,
                'sale_price' => 700000,
                'specifications' => json_encode([
                    'Kích thước' => 'Theo yêu cầu',
                    'Độ dày' => '2-3cm',
                    'Độ bóng' => '>95%',
                ]),
                'stone_category_id' => $daNoiThatCategory->id,
                'stone_material_id' => $daGhiSang->id,
                'stone_surface_id' => $maiBong->id,
                'is_featured' => 1,
                'applications' => [$matTien->id, $sanNha->id],
            ],
            [
                'name' => 'Đá marble trắng ốp bàn bếp',
                'code' => 'MB-TR-BB',
                'short_description' => 'Đá marble trắng ốp bàn bếp, chất lượng cao, bền đẹp.',
                'description' => 'Đá marble trắng ốp bàn bếp là sản phẩm cao cấp, được chế tác tinh xảo với bề mặt mài bóng tạo vẻ đẹp sang trọng cho công trình. Sản phẩm được sử dụng phổ biến trong các công trình bàn bếp. Đá có độ bền cao, chống thấm, chịu nhiệt tốt, dễ dàng lau chùi và bảo dưỡng.',
                'main_image' => 'stone_products/da-marble-trang-op-ban-bep.jpg',
                'gallery' => json_encode([
                    'stone_products/da-marble-trang-op-ban-bep-1.jpg',
                    'stone_products/da-marble-trang-op-ban-bep-2.jpg',
                ]),
                'price' => 950000,
                'sale_price' => 900000,
                'specifications' => json_encode([
                    'Kích thước' => 'Theo yêu cầu',
                    'Độ dày' => '2-3cm',
                    'Độ bóng' => '>95%',
                ]),
                'stone_category_id' => $daNoiThatCategory->id,
                'stone_material_id' => $daGhiSang->id,
                'stone_surface_id' => $maiBong->id,
                'is_featured' => 1,
                'applications' => [$banBep->id],
            ],
        ];

        // Tạo các sản phẩm
        foreach ($exteriorProducts as $product) {
            $applications = $product['applications'];
            unset($product['applications']);
            $product['slug'] = Str::slug($product['name']);
            $newProduct = StoneProduct::create($product);
            // Gán ứng dụng cho sản phẩm
            $newProduct->applications()->attach($applications);
        }

        foreach ($interiorProducts as $product) {
            $applications = $product['applications'];
            unset($product['applications']);
            $product['slug'] = Str::slug($product['name']);
            $newProduct = StoneProduct::create($product);
            // Gán ứng dụng cho sản phẩm
            $newProduct->applications()->attach($applications);
        }

        // Tạo sản phẩm mẫu đơn giản (nếu chưa có)
        $product = StoneProduct::create([
            'name' => 'Đá xanh đen băm nhám 30x60',
            'slug' => Str::slug('Đá xanh đen băm nhám 30x60'),
            'code' => 'XD-BN-3060',
            'short_description' => 'Đá xanh đen băm nhám kích thước 30x60cm, bền đẹp, chống trơn trượt.',
            'description' => 'Đá xanh đen băm nhám 30x60 là sản phẩm cao cấp, phù hợp lát vỉa hè, sân vườn, quảng trường. Độ bền cao, chịu thời tiết tốt.',
            'main_image' => 'stone_products/da-xanh-den-bam-nham-30x60.jpg',
            'gallery' => json_encode([
                'stone_products/da-xanh-den-bam-nham-30x60-1.jpg',
                'stone_products/da-xanh-den-bam-nham-30x60-2.jpg',
            ]),
            'price' => 350000,
            'sale_price' => 320000,
            'specifications' => json_encode([
                'Kích thước' => '30x60cm',
                'Độ dày' => '3cm',
                'Khối lượng' => '~12kg/viên',
            ]),
            'stone_category_id' => $daNgoaiThatCategory ? $daNgoaiThatCategory->id : null,
            'stone_material_id' => $daXanhDen ? $daXanhDen->id : null,
            'stone_surface_id' => $bamNham ? $bamNham->id : null,
            'is_featured' => 1,
            'status' => 1,
            'order' => 1,
        ]);
        if ($product && isset($viaHe)) {
            $product->applications()->attach([$viaHe->id]);
        }
    }
}
