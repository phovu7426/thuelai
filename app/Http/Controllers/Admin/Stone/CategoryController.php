<?php

namespace App\Http\Controllers\Admin\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StoneCategory::with('parent');
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('slug')) {
            $query->where('slug', 'like', '%' . $request->slug . '%');
        }
        if ($request->filled('description')) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }
        if ($request->filled('code')) {
            $query->where('code', 'like', '%' . $request->code . '%');
        }
        $categories = $query->orderBy('order', 'asc')->paginate(10)->appends($request->all());
        return view('admin.stone.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = StoneCategory::whereNull('parent_id')->get();
        return view('admin.stone.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'parent_id' => 'nullable|exists:stone_categories,id',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Upload image if exists
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'stone_categories/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['image'] = $filename;
        }

        StoneCategory::create($data);

        return redirect()->route('admin.stone.categories.index')
            ->with('success', 'Danh mục đá đã được tạo thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoneCategory $category)
    {
        $parentCategories = StoneCategory::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();

        return view('admin.stone.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoneCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'parent_id' => 'nullable|exists:stone_categories,id',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Upload image if exists
        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $image = $request->file('image');
            $filename = 'stone_categories/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['image'] = $filename;
        }

        $category->update($data);

        return redirect()->route('admin.stone.categories.index')
            ->with('success', 'Danh mục đá đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoneCategory $category)
    {
        // Check if category has products
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.stone.categories.index')
                ->with('error', 'Không thể xóa danh mục này vì có sản phẩm liên kết.');
        }

        // Check if category has children
        if ($category->children()->count() > 0) {
            return redirect()->route('admin.stone.categories.index')
                ->with('error', 'Không thể xóa danh mục này vì có danh mục con.');
        }

        // Delete image
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.stone.categories.index')
            ->with('success', 'Danh mục đá đã được xóa thành công.');
    }
}
