<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneVideo;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Hiển thị danh sách video
     */
    public function index()
    {
        $videos = StoneVideo::where('status', 1)
            ->orderBy('order', 'asc')
            ->paginate(12);
            
        // Lấy video nổi bật
        $featuredVideos = StoneVideo::where('status', 1)
            ->where('is_featured', 1)
            ->orderBy('order', 'asc')
            ->limit(5)
            ->get();
            
        return view('stone.videos.index', compact('videos', 'featuredVideos'));
    }
    
    /**
     * Hiển thị chi tiết video
     */
    public function show($slug)
    {
        $video = StoneVideo::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
            
        // Lấy các video khác
        $relatedVideos = StoneVideo::where('status', 1)
            ->where('id', '!=', $video->id)
            ->orderBy('order', 'asc')
            ->limit(6)
            ->get();
            
        return view('stone.videos.show', compact('video', 'relatedVideos'));
    }
} 