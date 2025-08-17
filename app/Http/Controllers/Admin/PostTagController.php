<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostTag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    public function index()
    {
        $query = PostTag::latest();

        // Filter by name
        if (request('name')) {
            $query->where('name', 'like', '%' . request('name') . '%');
        }

        $tags = $query->paginate(20);

        return view('admin.post-tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.post-tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        PostTag::create($data);

        return redirect()->route('admin.post-tags.index')
                        ->with('success', 'Tag đã được tạo thành công!');
    }

    public function edit(PostTag $tag)
    {
        return view('admin.post-tags.edit', compact('tag'));
    }

    public function update(Request $request, PostTag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $tag->update($data);

        return redirect()->route('admin.post-tags.index')
                        ->with('success', 'Tag đã được cập nhật thành công!');
    }

    public function destroy(PostTag $tag)
    {
        if ($tag->posts()->count() > 0) {
            return redirect()->back()
                            ->with('error', 'Không thể xóa tag có bài viết!');
        }
        
        $tag->delete();

        return redirect()->route('admin.post-tags.index')
                        ->with('success', 'Tag đã được xóa thành công!');
    }

    public function toggleStatus(PostTag $tag)
    {
        $tag->update(['is_active' => !$tag->is_active]);
        
        $message = $tag->is_active ? 'Tag đã được kích hoạt!' : 'Tag đã được tạm dừng!';
        
        return redirect()->back()->with('success', $message);
    }
}


