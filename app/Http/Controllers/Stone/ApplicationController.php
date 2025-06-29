<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneApplication;
use App\Models\StoneProduct;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Hiển thị danh sách ứng dụng
     */
    public function index(Request $request)
    {
        $type = $request->get('type', 'all');
        
        $query = StoneApplication::where('status', 1);
        
        if ($type !== 'all') {
            switch ($type) {
                case 'exterior':
                    $query->where('type', StoneApplication::TYPE_EXTERIOR);
                    break;
                case 'interior':
                    $query->where('type', StoneApplication::TYPE_INTERIOR);
                    break;
                case 'artstone':
                    $query->where('type', StoneApplication::TYPE_ARTSTONE);
                    break;
            }
        }
        
        $applications = $query->orderBy('type')->orderBy('order', 'asc')->paginate(12);
        
        return view('stone.applications.index', compact('applications'));
    }
    
    /**
     * Hiển thị chi tiết ứng dụng
     */
    public function show($slug)
    {
        $application = StoneApplication::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
            
        // Đảm bảo nội dung HTML hiển thị đúng
        if (!$application->content) {
            $application->content = '<p>' . $application->description . '</p>';
        }
            
        // Lấy sản phẩm thuộc ứng dụng này
        $products = $application->products()
            ->where('stone_products.status', 1)
            ->orderBy('stone_products.order', 'asc')
            ->paginate(12);
            
        // Lấy các ứng dụng cùng loại
        $relatedApplications = StoneApplication::where('status', 1)
            ->where('type', $application->type)
            ->where('id', '!=', $application->id)
            ->orderBy('order', 'asc')
            ->limit(6)
            ->get();
            
        return view('stone.applications.show', compact('application', 'products', 'relatedApplications'));
    }
    
    /**
     * Test hiển thị HTML
     */
    public function testHtml($slug)
    {
        $application = StoneApplication::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
            
        return view('stone.applications.test_html', compact('application'));
    }
    
    /**
     * Test đơn giản
     */
    public function simpleTest($slug)
    {
        $application = StoneApplication::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
            
        // Đảm bảo nội dung HTML hiển thị đúng
        if (!$application->content) {
            $application->content = '<p>' . $application->description . '</p>';
        }
            
        return view('stone.applications.simple_test', compact('application'));
    }
    
    /**
     * Test tối giản
     */
    public function testMinimal($slug)
    {
        $application = StoneApplication::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
            
        return view('stone.applications.test_minimal', compact('application'));
    }
    
    /**
     * Trang Via hè tùy chỉnh
     */
    public function viaHe()
    {
        return view('stone.applications.via_he_custom');
    }
} 