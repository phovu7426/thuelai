<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneApplication;
use Illuminate\Http\Request;

class ApplicationDetailController extends Controller
{
    /**
     * Hiển thị chi tiết ứng dụng với cách tiếp cận mới
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
            
        // Trả về view mới
        return view('stone.applications.detail', [
            'application' => $application,
            'products' => $products,
            'relatedApplications' => $relatedApplications
        ]);
    }
} 