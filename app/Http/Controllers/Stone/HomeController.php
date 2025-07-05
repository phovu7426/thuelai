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
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    /**
     * Hiển thị trang chủ website đá
     */
    public function index()
    {
        // Lấy dữ liệu slide từ database với cache
        $slides = cache()->remember('home_slides', 300, function () {
            return Slide::where('status', 1)
                ->orderBy('id', 'desc')
                ->get();
        });

        // Lấy dữ liệu sản phẩm nổi bật với cache
        $featuredProducts = cache()->remember('home_featured_products', 300, function () {
            return StoneProduct::with(['category', 'material'])
                ->where('is_featured', true)
                ->where('status', true)
                ->orderBy('order', 'asc')
                ->take(8)
                ->get();
        });

        // Lấy danh mục sản phẩm với cache
        $categories = cache()->remember('home_categories', 300, function () {
            return StoneCategory::where('status', true)
                ->whereNull('parent_id') // Chỉ lấy danh mục chính
                ->withCount('products')
                ->withCount('children')
                ->orderBy('order', 'asc')
                ->take(6)
                ->get();
        });
        
        // Lấy ứng dụng với cache
        $applications = cache()->remember('home_applications', 300, function () {
            return StoneApplication::where('status', true)
                ->orderBy('order', 'asc')
                ->take(4)
                ->get();
        });

        // Lấy dự án nổi bật với cache
        $featuredProjects = cache()->remember('home_featured_projects', 300, function () {
            return StoneProject::where('is_featured', true)
                ->where('status', true)
                ->orderBy('order', 'asc')
                ->take(3)
                ->get();
        });

        // Lấy video nổi bật với cache
        $featuredVideos = cache()->remember('home_featured_videos', 300, function () {
            return StoneVideo::where('is_featured', true)
                ->where('status', true)
                ->orderBy('order', 'asc')
                ->take(2)
                ->get();
        });

        // Lấy showroom với cache
        $showrooms = cache()->remember('home_showrooms', 300, function () {
            return StoneShowroom::where('status', true)
                ->orderBy('order', 'asc')
                ->take(3)
                ->get();
        });

        // Lấy màu sắc với cache
        $colors = cache()->remember('home_colors', 300, function () {
            return StoneColor::where('status', true)
                ->orderBy('order', 'asc')
                ->take(8)
                ->get();
        });

        $contactInfo = null;
        if (Schema::hasTable('contact_infos')) {
            $contactInfo = cache()->remember('home_contact_info', 300, function () {
                return ContactInfo::first();
            });
        }

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

        $contactInfo = null;
        if (Schema::hasTable('contact_infos')) {
            $contactInfo = ContactInfo::first();
        }

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
    
    /**
     * Xóa cache của trang chủ
     * Gọi phương thức này khi có cập nhật dữ liệu liên quan đến trang chủ
     */
    public static function clearHomeCache()
    {
        $cacheKeys = [
            'home_slides',
            'home_featured_products',
            'home_categories',
            'home_applications',
            'home_featured_projects',
            'home_featured_videos',
            'home_showrooms',
            'home_colors',
            'home_contact_info'
        ];
        
        foreach ($cacheKeys as $key) {
            cache()->forget($key);
        }
    }
}
