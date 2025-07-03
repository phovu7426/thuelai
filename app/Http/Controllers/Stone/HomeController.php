<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Models\StoneApplication;
use App\Models\StoneCategory;
use App\Models\StoneColor;
use App\Models\StoneMaterial;
use App\Models\StoneProduct;
use App\Models\StoneProject;
use App\Models\StoneShowroom;
use App\Models\StoneVideo;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Hiển thị trang chủ website đá
     */
    public function index()
    {
        // Lấy dữ liệu slide từ database
        $slides = Slide::where('status', 1)
            ->orderBy('id', 'desc')
            ->get();

        // Lấy dữ liệu cho trang chủ
        $featuredProducts = StoneProduct::with(['category', 'material'])
            ->where('is_featured', true)
            ->where('status', true)
            ->orderBy('order', 'asc')
            ->take(8)
            ->get();

        $categories = cache()->store('file')->remember('home_stone_categories', 3600, function () {
            return StoneCategory::where('status', true)
                ->whereNull('parent_id') // Chỉ lấy danh mục chính
                ->withCount('products')
                ->withCount('children')
                ->orderBy('order', 'asc')
                ->take(6)
                ->get();
        });

        $applications = StoneApplication::where('status', true)
            ->orderBy('order', 'asc')
            ->take(4)
            ->get();

        $featuredProjects = StoneProject::where('is_featured', true)
            ->where('status', true)
            ->orderBy('order', 'asc')
            ->take(3)
            ->get();

        $featuredVideos = StoneVideo::where('is_featured', true)
            ->where('status', true)
            ->orderBy('order', 'asc')
            ->take(2)
            ->get();

        $showrooms = StoneShowroom::where('status', true)
            ->orderBy('order', 'asc')
            ->take(3)
            ->get();

        // Thêm dữ liệu màu sắc
        $colors = StoneColor::where('status', true)
            ->orderBy('order', 'asc')
            ->take(8)
            ->get();

        $contactInfo = ContactInfo::first();

        return view('stone.home', compact(
            'slides',
            'featuredProducts',
            'categories',
            'applications',
            'featuredProjects',
            'featuredVideos',
            'showrooms',
            'colors',
            'contactInfo'
        ));
    }

    /**
     * Hiển thị trang giới thiệu
     */
    public function about()
    {
        // Thêm dữ liệu cho trang giới thiệu
        $companyInfo = [
            'name' => 'Thanh Tùng Stone',
            'established' => '2010',
            'experience' => '10+ năm',
            'employees' => '100+',
            'projects' => '500+',
            'description' => 'Thanh Tùng Stone là đơn vị hàng đầu trong lĩnh vực cung cấp và thi công đá tự nhiên cao cấp tại Việt Nam. Với hơn 10 năm kinh nghiệm, chúng tôi tự hào mang đến cho khách hàng những sản phẩm đá tự nhiên chất lượng cao, mẫu mã đa dạng với giá cả cạnh tranh nhất thị trường.',
            'mission' => 'Mang đến những sản phẩm đá tự nhiên cao cấp, đáp ứng mọi nhu cầu thiết kế và trang trí của khách hàng.',
            'vision' => 'Trở thành đơn vị hàng đầu trong lĩnh vực cung cấp và thi công đá tự nhiên tại Việt Nam và khu vực Đông Nam Á.'
        ];

        $team = [
            [
                'name' => 'Nguyễn Văn A',
                'position' => 'Giám đốc',
                'image' => 'images/default/default_image.png',
                'description' => 'Hơn 15 năm kinh nghiệm trong lĩnh vực đá tự nhiên'
            ],
            [
                'name' => 'Trần Thị B',
                'position' => 'Quản lý kinh doanh',
                'image' => 'images/default/default_image.png',
                'description' => 'Chuyên gia tư vấn thiết kế với đá tự nhiên'
            ],
            [
                'name' => 'Lê Văn C',
                'position' => 'Kỹ thuật trưởng',
                'image' => 'images/default/default_image.png',
                'description' => 'Chuyên gia thi công với hơn 10 năm kinh nghiệm'
            ]
        ];

        $partners = [
            'Vingroup',
            'Sungroup',
            'FLC',
            'Masterise Homes',
            'Capital Land',
            'BRG Group'
        ];

        return view('stone.about', compact('companyInfo', 'team', 'partners'));
    }

    /**
     * Hiển thị trang liên hệ
     */
    public function contact()
    {
        $showrooms = StoneShowroom::where('status', true)
            ->orderBy('order', 'asc')
            ->get();

        $contactInfo = ContactInfo::first(); // Lấy bản ghi đầu tiên từ bảng contact_infos

        return view('stone.contact', compact('showrooms', 'contactInfo'));
    }

    /**
     * Xử lý gửi form liên hệ
     */
    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        // Xử lý gửi email hoặc lưu thông tin liên hệ vào database
        // ...

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi sẽ phản hồi trong thời gian sớm nhất!');
    }
}
