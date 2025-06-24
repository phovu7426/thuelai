<?php

namespace App\Http\Controllers\Admin\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneShowroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ShowroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $showrooms = StoneShowroom::orderBy('order', 'asc')->paginate(20);
        return view('admin.stone.showrooms.index', compact('showrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stone.showrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'working_hours' => 'nullable|string|max:255',
            'location' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        
        // Upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'stone_showrooms/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['image'] = $filename;
        }
        
        // Upload gallery images
        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $filename = 'stone_showrooms/' . time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $path = Storage::disk('public')->putFileAs('', $image, $filename);
                $gallery[] = $filename;
            }
        }
        $data['gallery'] = $gallery;

        StoneShowroom::create($data);

        return redirect()->route('admin.stone.showrooms.index')
            ->with('success', 'Showroom đá đã được tạo thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoneShowroom $showroom)
    {
        return view('admin.stone.showrooms.edit', compact('showroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoneShowroom $showroom)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'working_hours' => 'nullable|string|max:255',
            'location' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
            'remove_gallery' => 'nullable|array',
            'remove_gallery.*' => 'string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        
        // Upload image
        if ($request->hasFile('image')) {
            // Delete old image
            if ($showroom->image && Storage::disk('public')->exists($showroom->image)) {
                Storage::disk('public')->delete($showroom->image);
            }
            
            $image = $request->file('image');
            $filename = 'stone_showrooms/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['image'] = $filename;
        }
        
        // Handle gallery images
        $gallery = $showroom->gallery ?? [];
        
        // Remove selected gallery images
        if (isset($data['remove_gallery']) && !empty($data['remove_gallery'])) {
            foreach ($data['remove_gallery'] as $removeImage) {
                if (in_array($removeImage, $gallery)) {
                    // Delete file
                    if (Storage::disk('public')->exists($removeImage)) {
                        Storage::disk('public')->delete($removeImage);
                    }
                    
                    // Remove from gallery array
                    $gallery = array_diff($gallery, [$removeImage]);
                }
            }
        }
        
        // Upload new gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $filename = 'stone_showrooms/' . time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $path = Storage::disk('public')->putFileAs('', $image, $filename);
                $gallery[] = $filename;
            }
        }
        
        $data['gallery'] = array_values($gallery); // Reset array keys

        $showroom->update($data);

        return redirect()->route('admin.stone.showrooms.index')
            ->with('success', 'Showroom đá đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoneShowroom $showroom)
    {
        // Delete image
        if ($showroom->image && Storage::disk('public')->exists($showroom->image)) {
            Storage::disk('public')->delete($showroom->image);
        }
        
        // Delete gallery images
        if ($showroom->gallery) {
            foreach ($showroom->gallery as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }
        
        $showroom->delete();

        return redirect()->route('admin.stone.showrooms.index')
            ->with('success', 'Showroom đá đã được xóa thành công.');
    }
} 