<?php

namespace App\Http\Controllers\Admin\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StoneApplication::query();
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('slug')) {
            $query->where('slug', 'like', '%' . $request->slug . '%');
        }
        if ($request->filled('description')) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }
        $applications = $query->orderBy('order', 'asc')->paginate(10)->appends($request->all());
        return view('admin.stone.applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stone.applications.create');
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
            'type' => 'required|integer',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Upload image if exists
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'stone_applications/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['image'] = $filename;
        }

        StoneApplication::create($data);

        return redirect()->route('admin.stone.applications.index')
            ->with('success', 'Ứng dụng đá đã được tạo thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoneApplication $application)
    {
        return view('admin.stone.applications.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoneApplication $application)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'type' => 'required|integer',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Upload image if exists
        if ($request->hasFile('image')) {
            // Delete old image
            if ($application->image && Storage::disk('public')->exists($application->image)) {
                Storage::disk('public')->delete($application->image);
            }

            $image = $request->file('image');
            $filename = 'stone_applications/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['image'] = $filename;
        }

        $application->update($data);

        return redirect()->route('admin.stone.applications.index')
            ->with('success', 'Ứng dụng đá đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoneApplication $application)
    {
        // Check if application has products
        if ($application->products()->count() > 0) {
            return redirect()->route('admin.stone.applications.index')
                ->with('error', 'Không thể xóa ứng dụng này vì có sản phẩm liên kết.');
        }

        // Delete image
        if ($application->image && Storage::disk('public')->exists($application->image)) {
            Storage::disk('public')->delete($application->image);
        }

        $application->delete();

        return redirect()->route('admin.stone.applications.index')
            ->with('success', 'Ứng dụng đá đã được xóa thành công.');
    }
}
