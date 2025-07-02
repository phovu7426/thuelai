<?php

namespace App\Http\Controllers\Admin\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = StoneVideo::orderBy('order', 'asc')->paginate(10);
        return view('admin.stone.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stone.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        // Upload thumbnail if exists
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $filename = 'stone_videos/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['thumbnail'] = $filename;
        }

        StoneVideo::create($data);

        return redirect()->route('admin.stone.videos.index')
            ->with('success', 'Video đã được tạo thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoneVideo $video)
    {
        return view('admin.stone.videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoneVideo $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        // Upload thumbnail if exists
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($video->thumbnail && Storage::disk('public')->exists($video->thumbnail)) {
                Storage::disk('public')->delete($video->thumbnail);
            }
            
            $image = $request->file('thumbnail');
            $filename = 'stone_videos/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['thumbnail'] = $filename;
        }

        $video->update($data);

        return redirect()->route('admin.stone.videos.index')
            ->with('success', 'Video đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoneVideo $video)
    {
        // Delete thumbnail
        if ($video->thumbnail && Storage::disk('public')->exists($video->thumbnail)) {
            Storage::disk('public')->delete($video->thumbnail);
        }
        
        $video->delete();

        return redirect()->route('admin.stone.videos.index')
            ->with('success', 'Video đã được xóa thành công.');
    }
} 