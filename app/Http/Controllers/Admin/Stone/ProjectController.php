<?php

namespace App\Http\Controllers\Admin\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StoneProject::query();
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        if ($request->filled('description')) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }
        $projects = $query->orderBy('order', 'asc')->paginate(10)->appends($request->all());
        return view('admin.stone.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stone.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:100',
            'region' => 'required|string|max:50',
            'budget' => 'nullable|numeric',
            'completed_date' => 'nullable|date',
            'main_image' => 'required|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
            'is_featured' => 'boolean',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Upload main image
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $filename = 'stone_projects/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['main_image'] = $filename;
        }

        // Upload gallery images
        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $filename = 'stone_projects/' . time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $path = Storage::disk('public')->putFileAs('', $image, $filename);
                $gallery[] = $filename;
            }
        }
        $data['gallery'] = is_array($gallery) ? $gallery : (empty($gallery) ? [] : (array)json_decode($gallery, true));

        StoneProject::create($data);

        return redirect()->route('admin.stone.projects.index')
            ->with('success', 'Dự án đá đã được tạo thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoneProject $project)
    {
        return view('admin.stone.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoneProject $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:100',
            'region' => 'required|string|max:50',
            'budget' => 'nullable|numeric',
            'completed_date' => 'nullable|date',
            'main_image' => 'nullable|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
            'is_featured' => 'boolean',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
            'remove_gallery' => 'nullable|array',
            'remove_gallery.*' => 'string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Upload main image
        if ($request->hasFile('main_image')) {
            // Delete old main image
            if ($project->main_image && Storage::disk('public')->exists($project->main_image)) {
                Storage::disk('public')->delete($project->main_image);
            }

            $image = $request->file('main_image');
            $filename = 'stone_projects/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['main_image'] = $filename;
        }

        // Handle gallery images
        $gallery = $project->gallery ?? [];
        if (!is_array($gallery)) {
            $gallery = empty($gallery) ? [] : (array)json_decode($gallery, true);
        }

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
                $filename = 'stone_projects/' . time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $path = Storage::disk('public')->putFileAs('', $image, $filename);
                $gallery[] = $filename;
            }
        }

        $data['gallery'] = array_values($gallery); // Reset array keys

        $project->update($data);

        return redirect()->route('admin.stone.projects.index')
            ->with('success', 'Dự án đá đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoneProject $project)
    {
        // Delete main image
        if ($project->main_image && Storage::disk('public')->exists($project->main_image)) {
            Storage::disk('public')->delete($project->main_image);
        }

        // Delete gallery images
        if ($project->gallery) {
            foreach ($project->gallery as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $project->delete();

        return redirect()->route('admin.stone.projects.index')
            ->with('success', 'Dự án đá đã được xóa thành công.');
    }
}
