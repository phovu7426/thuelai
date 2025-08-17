<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostCategoryController extends Controller
{
    public function index()
    {
        $query = PostCategory::latest(); // Removed withCount('posts')

        // Filter by name
        if (request('name')) {
            $query->where('name', 'like', '%' . request('name') . '%');
        }

        $categories = $query->ordered()->paginate(20);

        return view('admin.post-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.post-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'color' => 'nullable|string|max:7',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        PostCategory::create($data);

        return redirect()->route('admin.post-categories.index')
                        ->with('success', 'Danh mục đã được tạo thành công!');
    }

    public function edit(PostCategory $category)
    {
        return view('admin.post-categories.edit', compact('category'));
    }

    public function update(Request $request, PostCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'color' => 'nullable|string|max:7',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.post-categories.index')
                        ->with('success', 'Danh mục đã được cập nhật thành công!');
    }

    public function destroy(PostCategory $category)
    {
        if ($category->posts()->count() > 0) {
            return redirect()->back()
                            ->with('error', 'Không thể xóa danh mục có bài viết!');
        }

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        
        $category->delete();

        return redirect()->route('admin.post-categories.index')
                        ->with('success', 'Danh mục đã được xóa thành công!');
    }

    public function toggleStatus(PostCategory $category)
    {
        try {
            $category->update(['is_active' => !$category->is_active]);
            
            $status = $category->is_active ? 'kích hoạt' : 'vô hiệu hóa';
            return response()->json([
                'success' => true,
                'message' => "Danh mục đã được {$status} thành công!",
                'status' => $category->is_active
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}


