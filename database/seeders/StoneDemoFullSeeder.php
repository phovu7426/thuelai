<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoneCategory;
use App\Models\StoneMaterial;
use App\Models\StoneProduct;
use App\Models\StoneSurface;
use App\Models\StoneApplication;
use App\Models\StoneProject;
use App\Models\StoneShowroom;
use Illuminate\Support\Str;

class StoneDemoFullSeeder extends Seeder
{
    public function run(): void
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        StoneCategory::truncate();
        StoneMaterial::truncate();
        StoneSurface::truncate();
        StoneApplication::truncate();
        StoneShowroom::truncate();
        StoneProject::truncate();
        StoneProduct::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Danh mục đá
        $categoryNames = [
            'Đá Marble nhập khẩu', 'Đá Granite tự nhiên', 'Đá Onyx xuyên sáng', 'Đá Travertine cao cấp',
            'Đá Bazan lát sân vườn', 'Đá Xanh Thanh Hóa', 'Đá Đen Phú Yên', 'Đá Vàng Nghệ An',
            'Đá Trắng Ý', 'Đá Nâu Tây Ban Nha', 'Đá Đỏ Bình Định', 'Đá Xám Lông Chuột',
            'Đá Xanh Rêu', 'Đá Hoa Cương', 'Đá Cẩm Thạch', 'Đá Mài Bóng', 'Đá Mài Mờ',
            'Đá Băm Nhám', 'Đá Mài Hone', 'Đá Mài Thô', 'Đá Ốp Lát Nội Thất', 'Đá Ốp Lát Ngoại Thất',
            'Đá Sân Vườn', 'Đá Bậc Tam Cấp', 'Đá Mặt Tiền', 'Đá Bàn Bếp', 'Đá Quầy Bar',
            'Đá Trang Trí', 'Đá Nghệ Thuật', 'Đá Công Trình'
        ];
        $categoryDescriptions = [
            'Mang đến vẻ đẹp sang trọng cho mọi không gian sống.',
            'Lựa chọn hoàn hảo cho các công trình hiện đại.',
            'Được ưa chuộng trong thiết kế nội thất cao cấp.',
            'Tạo điểm nhấn độc đáo cho mặt tiền và sân vườn.',
            'Phù hợp với nhiều phong cách kiến trúc khác nhau.',
            'Độ bền vượt trội, thích hợp cho các công trình lớn.',
            'Màu sắc tự nhiên, hài hòa với không gian.',
            'Dễ dàng thi công, bảo trì và vệ sinh.',
            'Giá thành hợp lý, đáp ứng nhu cầu đa dạng.',
            'Chống thấm tốt, phù hợp khu vực ẩm ướt.',
            'Được khai thác từ mỏ đá nổi tiếng.',
            'Khả năng chịu lực cao, an toàn sử dụng.',
            'Mang lại cảm giác mát mẻ cho không gian sống.',
            'Tạo hiệu ứng ánh sáng đẹp mắt.',
            'Bề mặt nhẵn mịn, dễ lau chùi.',
            'Chống trơn trượt hiệu quả.',
            'Thích hợp cho cả nội thất và ngoại thất.',
            'Được nhiều kiến trúc sư lựa chọn.',
            'Tăng giá trị thẩm mỹ cho công trình.',
            'Đa dạng kích thước, dễ dàng lựa chọn.',
            'Phù hợp với xu hướng thiết kế hiện đại.',
            'Đáp ứng tiêu chuẩn chất lượng quốc tế.',
            'Bảo hành dài hạn, yên tâm sử dụng.',
            'Thân thiện với môi trường.',
            'Khả năng chống mài mòn tốt.',
            'Màu sắc bền lâu theo thời gian.',
            'Tạo cảm giác gần gũi với thiên nhiên.',
            'Dễ phối hợp với các vật liệu khác.',
            'Là lựa chọn hàng đầu cho các dự án cao cấp.'
        ];
        // Đảm bảo đủ mô tả cho danh mục
        while (count($categoryDescriptions) < count($categoryNames)) {
            $categoryDescriptions[] = 'Danh mục đá cao cấp, phù hợp nhiều công trình.';
        }
        $categoryIds = [];
        foreach ($categoryNames as $i => $name) {
            $categoryIds[] = StoneCategory::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $categoryDescriptions[$i],
            ])->id;
        }

        // Chất liệu đá
        $materialNames = [
            'Marble Trắng Ý', 'Granite Đen Kim Sa', 'Onyx Xanh Ngọc', 'Travertine Vàng Ai Cập',
            'Bazan Đen Lào', 'Xanh Thanh Hóa', 'Đen Phú Yên', 'Vàng Nghệ An', 'Trắng Sứ',
            'Nâu Tây Ban Nha', 'Đỏ Bình Định', 'Xám Lông Chuột', 'Xanh Rêu', 'Hoa Cương Đỏ',
            'Cẩm Thạch Xanh', 'Mài Bóng', 'Mài Mờ', 'Băm Nhám', 'Mài Hone', 'Mài Thô',
            'Đá Sọc Dưa', 'Đá Ghi Sáng', 'Đá Xanh Đen', 'Đá Bazan Lỗ Rỗ', 'Đá Vàng Ai Cập',
            'Đá Xám Ý', 'Đá Đen Campuchia', 'Đá Trắng Sữa', 'Đá Xanh Brazil', 'Đá Xanh Rêu Thanh Hóa'
        ];
        $materialDescriptions = [
            'Chất liệu bền đẹp, thích hợp cho các công trình ngoài trời.',
            'Màu sắc tự nhiên, dễ dàng phối hợp với nhiều loại đá khác.',
            'Được khai thác từ mỏ đá nổi tiếng, đảm bảo chất lượng.',
            'Khả năng chống thấm và chịu lực tốt.',
            'Mang lại cảm giác mát mẻ cho không gian sống.',
            'Bề mặt sáng bóng, tạo điểm nhấn sang trọng.',
            'Dễ dàng thi công, tiết kiệm chi phí.',
            'Chống trầy xước, giữ vẻ đẹp lâu dài.',
            'Thích hợp cho các hạng mục ốp lát cao cấp.',
            'Được nhiều chủ đầu tư tin dùng.',
            'Khả năng chống cháy tốt.',
            'Không bị phai màu dưới tác động của thời tiết.',
            'Tạo cảm giác rộng rãi cho không gian.',
            'Đáp ứng tiêu chuẩn xây dựng hiện đại.',
            'Dễ bảo trì, vệ sinh.',
            'Phù hợp với nhiều phong cách thiết kế.',
            'Chống bám bẩn hiệu quả.',
            'Được sử dụng trong nhiều dự án lớn.',
            'Giá thành cạnh tranh.',
            'Thân thiện với môi trường.',
            'Độ cứng cao, khó bị nứt vỡ.',
            'Màu sắc đa dạng, phong phú.',
            'Tạo cảm giác ấm cúng cho không gian.',
            'Bề mặt tự nhiên, không trơn trượt.',
            'Khả năng cách âm tốt.',
            'Được kiểm định chất lượng nghiêm ngặt.',
            'Phù hợp với khí hậu Việt Nam.',
            'Tạo điểm nhấn cho mọi công trình.',
            'Là lựa chọn lý tưởng cho nhà ở và biệt thự.'
        ];
        // Đảm bảo đủ mô tả cho chất liệu
        while (count($materialDescriptions) < count($materialNames)) {
            $materialDescriptions[] = 'Chất liệu đá tự nhiên, bền đẹp.';
        }
        $materialIds = [];
        foreach ($materialNames as $i => $name) {
            $materialIds[] = StoneMaterial::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $materialDescriptions[$i],
            ])->id;
        }

        // Bề mặt đá
        $surfaceNames = [
            'Băm nhám', 'Băm trang trí', 'Xẻ thô', 'Mài thô', 'Mài hone', 'Mài bóng', 'Khò lửa', 'Mài mờ',
            'Mài nhẵn', 'Mài sần', 'Mài vân mây', 'Mài sọc', 'Mài lượn sóng', 'Mài vảy cá', 'Mài vân đá',
            'Bóc thô', 'Bóc cạnh', 'Bóc mặt', 'Bóc tự nhiên', 'Bóc nhám', 'Bóc bóng', 'Bóc mờ', 'Bóc sần',
            'Bóc vân mây', 'Bóc sọc', 'Bóc lượn sóng', 'Bóc vảy cá', 'Bóc vân đá', 'Khò nhám', 'Khò bóng'
        ];
        $surfaceDescriptions = [
            'Bề mặt nhám giúp chống trơn trượt hiệu quả.',
            'Tạo hiệu ứng ánh sáng đẹp mắt khi sử dụng trong nhà.',
            'Dễ dàng vệ sinh, bảo dưỡng.',
            'Phù hợp cho các khu vực thường xuyên tiếp xúc nước.',
            'Mang lại cảm giác tự nhiên, gần gũi.',
            'Bề mặt bóng loáng, tăng vẻ sang trọng.',
            'Chống bám bụi, dễ lau chùi.',
            'Tạo chiều sâu cho không gian.',
            'Bề mặt sần độc đáo, tạo điểm nhấn.',
            'Phù hợp với nhiều loại đá khác nhau.',
            'Tăng độ bền cho sản phẩm.',
            'Giúp giảm tiếng ồn khi di chuyển.',
            'Bề mặt vân mây tự nhiên, đẹp mắt.',
            'Chống trầy xước tốt.',
            'Dễ dàng kết hợp với các vật liệu khác.',
            'Bề mặt thô mộc, gần gũi thiên nhiên.',
            'Tạo cảm giác mát lạnh khi chạm vào.',
            'Bề mặt bóng nhẹ, không gây chói mắt.',
            'Chống thấm nước hiệu quả.',
            'Bề mặt nhẵn mịn, an toàn cho trẻ nhỏ.',
            'Tạo hiệu ứng lượn sóng độc đáo.',
            'Bề mặt vảy cá lạ mắt.',
            'Tăng tính thẩm mỹ cho công trình.',
            'Bề mặt sọc cá tính, hiện đại.',
            'Chống mài mòn tốt.',
            'Bề mặt khò lửa tạo nét riêng.',
            'Bề mặt băm nhám truyền thống.',
            'Bề mặt mài hone sang trọng.',
            'Bề mặt mài thô mạnh mẽ.'
        ];
        // Đảm bảo đủ mô tả cho bề mặt
        while (count($surfaceDescriptions) < count($surfaceNames)) {
            $surfaceDescriptions[] = 'Bề mặt đá độc đáo, tạo điểm nhấn.';
        }
        $surfaceIds = [];
        foreach ($surfaceNames as $i => $name) {
            $surfaceIds[] = StoneSurface::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $surfaceDescriptions[$i],
            ])->id;
        }

        // Ứng dụng đá
        $applicationNames = [
            'Ốp tường phòng khách', 'Lát nền biệt thự', 'Cầu thang nhà phố', 'Mặt bếp hiện đại',
            'Bàn ăn sang trọng', 'Quầy bar khách sạn', 'Trang trí nội thất cao cấp', 'Trang trí ngoại thất sân vườn',
            'Sân vườn biệt thự', 'Bậc tam cấp nhà cổ', 'Mặt tiền tòa nhà', 'Bàn trà phòng khách',
            'Vách ngăn nghệ thuật', 'Cột trụ biệt thự', 'Lăng mộ đá xanh', 'Nhà thờ họ', 'Đình chùa cổ',
            'Cổng đá mỹ nghệ', 'Tượng đá nghệ thuật', 'Bồn hoa sân vườn', 'Hồ cá cảnh', 'Bể bơi ngoài trời',
            'Lối đi sân vườn', 'Sân chơi trẻ em', 'Quảng trường trung tâm', 'Bậc cầu thang biệt thự',
            'Ốp cột nhà hàng', 'Ốp mặt bàn bếp', 'Ốp mặt lavabo', 'Ốp tường phòng tắm'
        ];
        $applicationDescriptions = [
            'Giải pháp tối ưu cho không gian phòng khách hiện đại.',
            'Tăng giá trị thẩm mỹ cho biệt thự và nhà phố.',
            'Được nhiều kiến trúc sư lựa chọn cho các dự án lớn.',
            'Phù hợp với xu hướng thiết kế xanh, thân thiện môi trường.',
            'Mang lại sự khác biệt cho công trình của bạn.',
            'Tạo điểm nhấn cho không gian sống.',
            'Giúp tiết kiệm chi phí bảo trì.',
            'Dễ dàng thi công, lắp đặt.',
            'Phù hợp với nhiều loại đá tự nhiên.',
            'Tăng độ bền cho công trình.',
            'Mang lại cảm giác thư giãn, thoải mái.',
            'Tạo không gian mở, gần gũi thiên nhiên.',
            'Đáp ứng nhu cầu sử dụng đa dạng.',
            'Giúp tối ưu hóa diện tích sử dụng.',
            'Tạo phong cách riêng cho từng không gian.',
            'Phù hợp với mọi điều kiện thời tiết.',
            'Tăng tuổi thọ cho công trình.',
            'Dễ dàng phối hợp với các vật liệu khác.',
            'Mang lại vẻ đẹp bền vững theo thời gian.',
            'Tạo cảm giác sang trọng, đẳng cấp.',
            'Giúp không gian trở nên rộng rãi hơn.',
            'Tăng khả năng chống thấm cho công trình.',
            'Phù hợp với nhiều phong cách kiến trúc.',
            'Tạo sự hài hòa cho tổng thể thiết kế.',
            'Giúp tiết kiệm năng lượng.',
            'Tạo điểm nhấn cho mặt tiền.',
            'Mang lại cảm giác an toàn khi sử dụng.',
            'Tăng khả năng cách âm cho không gian.',
            'Là lựa chọn hàng đầu của các nhà thầu.'
        ];
        // Đảm bảo đủ mô tả cho ứng dụng
        while (count($applicationDescriptions) < count($applicationNames)) {
            $applicationDescriptions[] = 'Ứng dụng đá tự nhiên cho nhiều hạng mục.';
        }
        $applicationIds = [];
        foreach ($applicationNames as $i => $name) {
            $applicationIds[] = StoneApplication::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $applicationDescriptions[$i],
            ])->id;
        }

        // Showroom
        $showroomNames = [
            'Showroom Đá Hoa Cương Sài Gòn', 'Showroom Đá Tự Nhiên Phú Mỹ', 'Showroom Đá Cao Cấp Hà Nội',
            'Showroom Đá Mỹ Nghệ Quảng Ninh', 'Showroom Đá Granite Đà Nẵng', 'Showroom Đá Marble Nha Trang',
            'Showroom Đá Nghệ Thuật Cần Thơ', 'Showroom Đá Xanh Thanh Hóa', 'Showroom Đá Đen Phú Yên',
            'Showroom Đá Vàng Nghệ An', 'Showroom Đá Trắng Ý', 'Showroom Đá Nâu Tây Ban Nha',
            'Showroom Đá Đỏ Bình Định', 'Showroom Đá Xám Lông Chuột', 'Showroom Đá Xanh Rêu',
            'Showroom Đá Hoa Cương Đà Lạt', 'Showroom Đá Cẩm Thạch Huế', 'Showroom Đá Mài Bóng Hải Phòng',
            'Showroom Đá Mài Mờ Vũng Tàu', 'Showroom Đá Băm Nhám Bắc Ninh', 'Showroom Đá Mài Hone Bắc Giang',
            'Showroom Đá Mài Thô Quảng Bình', 'Showroom Đá Ốp Lát Nội Thất Sài Gòn',
            'Showroom Đá Ốp Lát Ngoại Thất Hà Nội', 'Showroom Đá Sân Vườn Đà Nẵng',
            'Showroom Đá Bậc Tam Cấp Ninh Bình', 'Showroom Đá Mặt Tiền Bình Dương',
            'Showroom Đá Bàn Bếp Long An', 'Showroom Đá Quầy Bar Tây Ninh', 'Showroom Đá Trang Trí Đồng Nai'
        ];
        $showroomDescriptions = [
            'Không gian trưng bày hiện đại, đa dạng mẫu mã đá tự nhiên.',
            'Đội ngũ tư vấn chuyên nghiệp, tận tâm.',
            'Vị trí thuận tiện, dễ dàng tham quan và lựa chọn sản phẩm.',
            'Cung cấp dịch vụ thiết kế và thi công trọn gói.',
            'Luôn cập nhật các xu hướng đá mới nhất trên thị trường.',
            'Chính sách hậu mãi hấp dẫn.',
            'Giá cả cạnh tranh, nhiều ưu đãi.',
            'Hỗ trợ vận chuyển toàn quốc.',
            'Đảm bảo chất lượng sản phẩm.',
            'Không gian rộng rãi, thoáng mát.',
            'Trưng bày nhiều mẫu đá độc quyền.',
            'Dịch vụ khách hàng tận tình.',
            'Có khu vực trải nghiệm sản phẩm thực tế.',
            'Hỗ trợ tư vấn thiết kế miễn phí.',
            'Đội ngũ kỹ thuật lành nghề.',
            'Thường xuyên tổ chức sự kiện, hội thảo.',
            'Hợp tác với nhiều nhà thầu lớn.',
            'Được khách hàng đánh giá cao.',
            'Có nhiều chi nhánh trên toàn quốc.',
            'Chính sách đổi trả linh hoạt.',
            'Hỗ trợ thanh toán đa dạng.',
            'Không gian thân thiện, gần gũi.',
            'Luôn có sẵn hàng mẫu.',
            'Đảm bảo tiến độ giao hàng.',
            'Có khu vực tiếp khách sang trọng.',
            'Hỗ trợ bảo hành dài hạn.',
            'Đội ngũ giao hàng chuyên nghiệp.',
            'Có bãi đỗ xe rộng rãi.',
            'Luôn lắng nghe ý kiến khách hàng.'
        ];
        // Đảm bảo đủ mô tả cho showroom
        while (count($showroomDescriptions) < count($showroomNames)) {
            $showroomDescriptions[] = 'Showroom đá tự nhiên, đa dạng mẫu mã.';
        }
        $addresses = [
            '12 Nguyễn Trãi, Quận 1, TP.HCM',
            '45 Lê Duẩn, Quận Hải Châu, Đà Nẵng',
            '89 Trần Hưng Đạo, Hoàn Kiếm, Hà Nội',
            '23 Lý Thường Kiệt, TP. Quảng Ninh',
            '56 Nguyễn Văn Linh, Đà Nẵng',
            '101 Trần Phú, Nha Trang',
            '77 Nguyễn Văn Cừ, Cần Thơ',
            '15 Lê Lợi, Thanh Hóa',
            '33 Nguyễn Huệ, Phú Yên',
            '28 Lê Hồng Phong, Nghệ An',
            '66 Pasteur, Quận 3, TP.HCM',
            '99 Nguyễn Chí Thanh, Hà Nội',
            '18 Lý Tự Trọng, Bình Định',
            '21 Nguyễn Thái Học, Hà Nội',
            '37 Lê Quý Đôn, Đà Lạt',
            '41 Bùi Thị Xuân, Huế',
            '53 Điện Biên Phủ, Hải Phòng',
            '60 Trần Hưng Đạo, Vũng Tàu',
            '72 Nguyễn Văn Cừ, Bắc Ninh',
            '84 Lê Lợi, Bắc Giang',
            '91 Nguyễn Trãi, Quảng Bình',
            '105 Lý Thường Kiệt, Sài Gòn',
            '112 Nguyễn Văn Linh, Hà Nội',
            '120 Trần Phú, Đà Nẵng',
            '130 Nguyễn Văn Cừ, Ninh Bình',
            '140 Lê Hồng Phong, Bình Dương',
            '150 Pasteur, Long An',
            '160 Nguyễn Chí Thanh, Tây Ninh',
            '170 Lý Tự Trọng, Đồng Nai',
            '200 Nguyễn Văn Linh, Quận 7, TP.HCM' // Địa chỉ bổ sung cho đủ 30
        ];
        $managers = [
            'Nguyễn Văn An', 'Trần Thị Bình', 'Lê Văn Cường', 'Phạm Thị Dung', 'Vũ Văn Em',
            'Đặng Thị Hạnh', 'Bùi Văn Hòa', 'Ngô Thị Hương', 'Phan Văn Khánh', 'Đỗ Thị Lan',
            'Hoàng Văn Lộc', 'Đinh Thị Mai', 'Lý Văn Nam', 'Tạ Thị Ngọc', 'Trịnh Văn Phát',
            'Chu Thị Quỳnh', 'Đoàn Văn Quý', 'Hồ Thị Sang', 'Kiều Văn Sơn', 'Lương Thị Thảo',
            'Mai Văn Thành', 'Nguyễn Thị Thu', 'Phạm Văn Toàn', 'Trần Thị Trang', 'Vũ Văn Trường',
            'Bùi Thị Tuyết', 'Nguyễn Văn Việt', 'Phạm Thị Xuân', 'Trần Văn Yên', 'Lê Thị Ánh'
        ];
        for ($i = 0; $i < 30; $i++) {
            StoneShowroom::create([
                'name' => $showroomNames[$i],
                'slug' => Str::slug($showroomNames[$i]),
                'address' => $addresses[$i],
                'phone' => '09' . rand(10000000, 99999999),
                'email' => 'contact' . ($i+1) . '@showroom.vn',
                'description' => $showroomDescriptions[$i],
            ]);
        }

        // Dự án
        $projectNames = [
            'Biệt thự Vinhomes Riverside', 'Khách sạn InterContinental Hà Nội', 'Trung tâm thương mại Vincom Mega Mall',
            'Chung cư cao cấp Landmark 81', 'Khu nghỉ dưỡng FLC Sầm Sơn', 'Tòa nhà Bitexco Financial Tower',
            'Bệnh viện Quốc tế Vinmec', 'Trường Đại học Bách Khoa Hà Nội', 'Nhà hát Lớn Hà Nội',
            'Sân bay Quốc tế Nội Bài', 'Cầu Nhật Tân', 'Khu đô thị Sala', 'Bảo tàng Hà Nội',
            'Khu du lịch Bà Nà Hills', 'Công viên nước Hồ Tây', 'Khu đô thị Ecopark', 'Khu đô thị Phú Mỹ Hưng',
            'Khách sạn JW Marriott', 'Khu đô thị Ciputra', 'Khu đô thị Times City', 'Khu đô thị Royal City',
            'Khu đô thị Gamuda Gardens', 'Khu đô thị Splendora', 'Khu đô thị Dương Nội', 'Khu đô thị Văn Phú',
            'Khu đô thị Linh Đàm', 'Khu đô thị Mỹ Đình', 'Khu đô thị Nam Thăng Long', 'Khu đô thị Tây Hồ Tây', 'Khu đô thị An Khánh'
        ];
        $projectDescriptions = [
            'Công trình nổi bật với kiến trúc hiện đại và vật liệu cao cấp.',
            'Dự án sử dụng đá tự nhiên cho toàn bộ mặt tiền và nội thất.',
            'Mang lại không gian sống đẳng cấp, tiện nghi.',
            'Được đánh giá cao về chất lượng thi công và thiết kế.',
            'Là điểm nhấn kiến trúc của khu vực.',
            'Sở hữu vị trí đắc địa, giao thông thuận tiện.',
            'Được nhiều chuyên gia bất động sản đánh giá cao.',
            'Thiết kế hài hòa với cảnh quan xung quanh.',
            'Ứng dụng công nghệ xây dựng hiện đại.',
            'Đảm bảo tiến độ và chất lượng công trình.',
            'Không gian xanh, thân thiện môi trường.',
            'Tối ưu hóa công năng sử dụng.',
            'Đáp ứng nhu cầu sống hiện đại.',
            'Tạo nên cộng đồng dân cư văn minh.',
            'Hệ thống tiện ích đồng bộ, đa dạng.',
            'An ninh đảm bảo 24/7.',
            'Giá trị đầu tư tăng theo thời gian.',
            'Được nhiều khách hàng lựa chọn.',
            'Phong cách thiết kế độc đáo.',
            'Chất lượng vật liệu xây dựng hàng đầu.',
            'Không gian mở, đón ánh sáng tự nhiên.',
            'Gần các trung tâm thương mại lớn.',
            'Dễ dàng kết nối với các khu vực lân cận.',
            'Đội ngũ thi công chuyên nghiệp.',
            'Chính sách bán hàng linh hoạt.',
            'Hỗ trợ khách hàng tận tình.',
            'Được bảo hành dài hạn.',
            'Tạo dựng giá trị bền vững cho cư dân.',
            'Là biểu tượng mới của thành phố.'
        ];
        // Đảm bảo đủ mô tả cho dự án
        while (count($projectDescriptions) < count($projectNames)) {
            $projectDescriptions[] = 'Dự án sử dụng đá tự nhiên cao cấp.';
        }
        $locations = [
            'Long Biên, Hà Nội', 'Quận Tây Hồ, Hà Nội', 'Quận 2, TP.HCM', 'Bình Thạnh, TP.HCM', 'Sầm Sơn, Thanh Hóa',
            'Quận 1, TP.HCM', 'Quận Bình Thạnh, TP.HCM', 'Hai Bà Trưng, Hà Nội', 'Hoàn Kiếm, Hà Nội',
            'Sóc Sơn, Hà Nội', 'Đông Anh, Hà Nội', 'Quận 2, TP.HCM', 'Nam Từ Liêm, Hà Nội', 'Hòa Vang, Đà Nẵng',
            'Tây Hồ, Hà Nội', 'Văn Giang, Hưng Yên', 'Quận 7, TP.HCM', 'Nam Từ Liêm, Hà Nội', 'Bắc Từ Liêm, Hà Nội',
            'Hai Bà Trưng, Hà Nội', 'Thanh Xuân, Hà Nội', 'Hoàng Mai, Hà Nội', 'Hoài Đức, Hà Nội', 'Hà Đông, Hà Nội',
            'Hà Đông, Hà Nội', 'Hoàng Mai, Hà Nội', 'Nam Từ Liêm, Hà Nội', 'Bắc Từ Liêm, Hà Nội', 'Tây Hồ, Hà Nội', 'Hoài Đức, Hà Nội'
        ];
        $investors = [
            'Tập đoàn Vingroup', 'Sun Group', 'Tập đoàn FLC', 'Tập đoàn Novaland', 'Tập đoàn Bitexco',
            'Tập đoàn BRG', 'Tập đoàn Him Lam', 'Tập đoàn Ecopark', 'Tập đoàn Nam Cường', 'Tập đoàn Geleximco',
            'Tập đoàn T&T', 'Tập đoàn Hòa Phát', 'Tập đoàn Đất Xanh', 'Tập đoàn Phú Mỹ Hưng', 'Tập đoàn C.E.O',
            'Tập đoàn CEO Group', 'Tập đoàn Lotte', 'Tập đoàn Keangnam', 'Tập đoàn Gamuda Land', 'Tập đoàn Capitaland',
            'Tập đoàn Sunshine', 'Tập đoàn Masterise', 'Tập đoàn Kinh Bắc', 'Tập đoàn SSG', 'Tập đoàn Văn Phú',
            'Tập đoàn HUD', 'Tập đoàn Licogi', 'Tập đoàn Bắc Hà', 'Tập đoàn Nam Long', 'Tập đoàn An Khánh'
        ];
        for ($i = 0; $i < 30; $i++) {
            StoneProject::create([
                'name' => $projectNames[$i],
                'slug' => Str::slug($projectNames[$i]),
                'description' => $projectDescriptions[$i],
                'location' => $locations[$i],
                'is_featured' => $i < 10 ? 1 : 0,
            ]);
        }

        // Sản phẩm
        $productNames = [
            'Marble Trắng Ý vân mây', 'Granite Đen Kim Sa Trung', 'Onyx Xanh Ngọc xuyên sáng', 'Travertine Vàng Ai Cập',
            'Bazan Đen Lào lát sân', 'Xanh Thanh Hóa băm nhám', 'Đen Phú Yên mài bóng', 'Vàng Nghệ An mài mờ',
            'Trắng Sứ ốp tường', 'Nâu Tây Ban Nha lát nền', 'Đỏ Bình Định bậc tam cấp', 'Xám Lông Chuột mặt bếp',
            'Xanh Rêu trang trí', 'Hoa Cương Đỏ mặt tiền', 'Cẩm Thạch Xanh bàn trà', 'Mài Bóng phòng khách',
            'Mài Mờ phòng tắm', 'Băm Nhám sân vườn', 'Mài Hone cầu thang', 'Mài Thô mặt bàn',
            'Sọc Dưa ốp cột', 'Ghi Sáng lát nền', 'Xanh Đen mặt bếp', 'Bazan Lỗ Rỗ sân chơi',
            'Vàng Ai Cập mặt tiền', 'Xám Ý phòng ngủ', 'Đen Campuchia mặt bếp', 'Trắng Sữa bàn ăn',
            'Xanh Brazil quầy bar', 'Xanh Rêu Thanh Hóa trang trí'
        ];
        $productDescriptions = [
            'Sản phẩm được nhiều khách hàng tin dùng cho các công trình lớn nhỏ.',
            'Đá có vân tự nhiên, màu sắc hài hòa, phù hợp nhiều phong cách.',
            'Chất lượng vượt trội, bền đẹp theo thời gian.',
            'Dễ dàng thi công, bảo trì và vệ sinh.',
            'Giá thành hợp lý, đáp ứng nhu cầu đa dạng của khách hàng.',
            'Được khai thác từ nguồn đá tự nhiên chất lượng cao.',
            'Phù hợp cho cả nội thất và ngoại thất.',
            'Khả năng chống thấm và chịu lực tốt.',
            'Mang lại vẻ đẹp sang trọng cho không gian sống.',
            'Được nhiều kiến trúc sư lựa chọn.',
            'Bề mặt nhẵn mịn, dễ lau chùi.',
            'Chống trơn trượt hiệu quả.',
            'Màu sắc bền lâu theo thời gian.',
            'Tạo điểm nhấn độc đáo cho công trình.',
            'Dễ phối hợp với các vật liệu khác.',
            'Đáp ứng tiêu chuẩn chất lượng quốc tế.',
            'Bảo hành dài hạn, yên tâm sử dụng.',
            'Thân thiện với môi trường.',
            'Khả năng chống mài mòn tốt.',
            'Tạo cảm giác gần gũi với thiên nhiên.',
            'Được kiểm định chất lượng nghiêm ngặt.',
            'Phù hợp với khí hậu Việt Nam.',
            'Tạo hiệu ứng ánh sáng đẹp mắt.',
            'Chống bám bẩn hiệu quả.',
            'Tăng giá trị thẩm mỹ cho công trình.',
            'Giúp tiết kiệm chi phí bảo trì.',
            'Tạo phong cách riêng cho từng không gian.',
            'Giúp tối ưu hóa diện tích sử dụng.',
            'Là lựa chọn hàng đầu cho các dự án cao cấp.'
        ];
        // Đảm bảo đủ mô tả cho sản phẩm
        while (count($productDescriptions) < count($productNames)) {
            $productDescriptions[] = 'Sản phẩm đá tự nhiên chất lượng cao.';
        }
        $productImages = [
            'marble_trang_y.jpg', 'granite_den_kim_sa.jpg', 'onyx_xanh_ngoc.jpg', 'travertine_vang_ai_cap.jpg',
            'bazan_den_lao.jpg', 'xanh_thanh_hoa.jpg', 'den_phu_yen.jpg', 'vang_nghe_an.jpg',
            'trang_su.jpg', 'nau_tay_ban_nha.jpg', 'do_binh_dinh.jpg', 'xam_long_chuot.jpg',
            'xanh_reu.jpg', 'hoa_cuong_do.jpg', 'cam_thach_xanh.jpg', 'mai_bong.jpg',
            'mai_mo.jpg', 'bam_nham.jpg', 'mai_hone.jpg', 'mai_tho.jpg', 'soc_dua.jpg',
            'ghi_sang.jpg', 'xanh_den.jpg', 'bazan_lo_ro.jpg', 'vang_ai_cap.jpg', 'xam_y.jpg',
            'den_campuchia.jpg', 'trang_sua.jpg', 'xanh_brazil.jpg', 'xanh_reu_thanh_hoa.jpg'
        ];
        for ($i = 0; $i < 30; $i++) {
            StoneProduct::create([
                'name' => $productNames[$i],
                'slug' => Str::slug($productNames[$i]),
                'description' => $productDescriptions[$i],
                'price' => rand(1200000, 5000000),
                'sale_price' => rand(1000000, 4900000),
                'quantity' => rand(10, 100),
                'main_image' => 'uploads/products/' . $productImages[$i],
                'stone_category_id' => $categoryIds[array_rand($categoryIds)],
                'stone_material_id' => $materialIds[array_rand($materialIds)],
                'stone_surface_id' => $surfaceIds[array_rand($surfaceIds)],
                'is_featured' => $i < 10 ? 1 : 0,
                // Không seed application_id
            ]);
        }
    }
} 