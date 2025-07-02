<?php

namespace App\Http\Controllers\Admin\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneSurface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SurfaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surfaces = StoneSurface::orderBy('order', 'asc')->paginate(10);
        return view('admin.stone.surfaces.index', compact('surfaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stone.surfaces.create');
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
            $filename = 'stone_surfaces/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['image'] = $filename;
        }

        StoneSurface::create($data);

        return redirect()->route('admin.stone.surfaces.index')
            ->with('success', 'Bề mặt đá đã được tạo thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoneSurface $surface)
    {
        return view('admin.stone.surfaces.edit', compact('surface'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoneSurface $surface)
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
            if ($surface->image && Storage::disk('public')->exists($surface->image)) {
                Storage::disk('public')->delete($surface->image);
            }
            
            $image = $request->file('image');
            $filename = 'stone_surfaces/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['image'] = $filename;
        }

        $surface->update($data);

        return redirect()->route('admin.stone.surfaces.index')
            ->with('success', 'Bề mặt đá đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoneSurface $surface)
    {
        // Check if surface has products
        if ($surface->products()->count() > 0) {
            return redirect()->route('admin.stone.surfaces.index')
                ->with('error', 'Không thể xóa bề mặt này vì có sản phẩm liên kết.');
        }
        
        // Delete image
        if ($surface->image && Storage::disk('public')->exists($surface->image)) {
            Storage::disk('public')->delete($surface->image);
        }
        
        $surface->delete();

        return redirect()->route('admin.stone.surfaces.index')
            ->with('success', 'Bề mặt đá đã được xóa thành công.');
    }
} 