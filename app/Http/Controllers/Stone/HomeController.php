<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneApplication;
use App\Models\StoneCategory;
use App\Models\StoneMaterial;
use App\Models\StoneProduct;
use App\Models\StoneProject;
use App\Models\StoneShowroom;
use App\Models\StoneVideo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Hiển thị trang chủ website đá
     */
    public function index()
    {
        // Lấy dữ liệu cho trang chủ
        $featuredProducts = StoneProduct::with(['category', 'material', 'surface'])
            ->where('is_featured', true)
            ->where('status', true)
            ->orderBy('order', 'asc')
            ->take(8)
            ->get();

        $categories = StoneCategory::where('status', true)
            ->orderBy('order', 'asc')
            ->take(6)
            ->get();

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
        return view('stone.home', compact(
            'featuredProducts',
            'categories',
            'applications',
            'featuredProjects',
            'featuredVideos',
            'showrooms'
        ));
    }

    /**
     * Hiển thị trang giới thiệu
     */
    public function about()
    {
        return view('stone.about');
    }

    /**
     * Hiển thị trang liên hệ
     */
    public function contact()
    {
        $showrooms = StoneShowroom::where('status', true)
            ->orderBy('order', 'asc')
            ->get();

        return view('stone.contact', compact('showrooms'));
    }
}
