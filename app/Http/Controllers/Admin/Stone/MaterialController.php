<?php

namespace App\Http\Controllers\Admin\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StoneMaterial::query();
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('slug')) {
            $query->where('slug', 'like', '%' . $request->slug . '%');
        }
        if ($request->filled('description')) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }
        $materials = $query->orderBy('order', 'asc')->paginate(10)->appends($request->all());
        return view('admin.stone.materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stone.materials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Upload image if exists
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'stone_materials/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['image'] = $filename;
        }

        StoneMaterial::create($data);

        return redirect()->route('admin.stone.materials.index')
            ->with('success', 'Chất liệu đá đã được tạo thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoneMaterial $material)
    {
        return view('admin.stone.materials.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoneMaterial $material)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Upload image if exists
        if ($request->hasFile('image')) {
            // Delete old image
            if ($material->image && Storage::disk('public')->exists($material->image)) {
                Storage::disk('public')->delete($material->image);
            }

            $image = $request->file('image');
            $filename = 'stone_materials/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['image'] = $filename;
        }

        $material->update($data);

        return redirect()->route('admin.stone.materials.index')
            ->with('success', 'Chất liệu đá đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoneMaterial $material)
    {
        // Check if material has products
        if ($material->products()->count() > 0) {
            return redirect()->route('admin.stone.materials.index')
                ->with('error', 'Không thể xóa chất liệu này vì có sản phẩm liên kết.');
        }

        // Delete image
        if ($material->image && Storage::disk('public')->exists($material->image)) {
            Storage::disk('public')->delete($material->image);
        }

        $material->delete();

        return redirect()->route('admin.stone.materials.index')
            ->with('success', 'Chất liệu đá đã được xóa thành công.');
    }
}
