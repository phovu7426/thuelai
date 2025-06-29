<?php

namespace App\Http\Controllers\Admin\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneApplication;
use App\Models\StoneCategory;
use App\Models\StoneColor;
use App\Models\StoneMaterial;
use App\Models\StoneProduct;
use App\Models\StoneSurface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = StoneProduct::with(['category', 'material', 'surface'])
            ->orderBy('order', 'asc')
            ->paginate(20);
            
        return view('admin.stone.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = StoneCategory::all();
        $materials = StoneMaterial::all();
        $surfaces = StoneSurface::all();
        $colors = StoneColor::all();
        $applications = StoneApplication::all();
        
        return view('admin.stone.products.create', compact(
            'categories',
            'materials',
            'surfaces',
            'colors',
            'applications'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'specifications' => 'nullable|array',
            'main_image' => 'required|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
            'price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'stone_category_id' => 'required|exists:stone_categories,id',
            'stone_material_id' => 'required|exists:stone_materials,id',
            'stone_surface_id' => 'required|exists:stone_surfaces,id',
            'stone_color_id' => 'nullable|exists:stone_colors,id',
            'is_featured' => 'boolean',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
            'applications' => 'nullable|array',
            'applications.*' => 'exists:stone_applications,id',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        
        // Upload main image
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $filename = 'stone_products/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['main_image'] = $filename;
        }
        
        // Upload gallery images
        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $filename = 'stone_products/' . time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $path = Storage::disk('public')->putFileAs('', $image, $filename);
                $gallery[] = $filename;
            }
        }
        $data['gallery'] = $gallery;
        
        // Convert specifications to JSON
        if (isset($data['specifications'])) {
            $specifications = [];
            if (isset($data['specifications']['key']) && isset($data['specifications']['value'])) {
                $keys = $data['specifications']['key'];
                $values = $data['specifications']['value'];
                
                for ($i = 0; $i < count($keys); $i++) {
                    if (!empty($keys[$i]) && isset($values[$i]) && !empty($values[$i])) {
                        $specifications[$keys[$i]] = $values[$i];
                    }
                }
            }
            $data['specifications'] = $specifications;
        }
        
        // Loại bỏ applications khỏi data vì nó được lưu trong bảng trung gian
        if (isset($data['applications'])) {
            $applicationIds = $data['applications'];
            unset($data['applications']);
        }
        
        // Create product
        $product = StoneProduct::create($data);
        
        // Attach applications
        if (isset($applicationIds)) {
            $product->applications()->attach($applicationIds);
        }

        return redirect()->route('admin.stone.products.index')
            ->with('success', 'Sản phẩm đá đã được tạo thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoneProduct $product)
    {
        $categories = StoneCategory::all();
        $materials = StoneMaterial::all();
        $surfaces = StoneSurface::all();
        $colors = StoneColor::all();
        $applications = StoneApplication::all();
        
        // Get current application IDs
        $productApplicationIds = $product->applications()->pluck('stone_applications.id')->toArray();
        
        return view('admin.stone.products.edit', compact(
            'product',
            'categories',
            'materials',
            'surfaces',
            'colors',
            'applications',
            'productApplicationIds'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoneProduct $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'specifications' => 'nullable|array',
            'main_image' => 'nullable|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
            'price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'stone_category_id' => 'required|exists:stone_categories,id',
            'stone_material_id' => 'required|exists:stone_materials,id',
            'stone_surface_id' => 'required|exists:stone_surfaces,id',
            'stone_color_id' => 'nullable|exists:stone_colors,id',
            'is_featured' => 'boolean',
            'status' => 'required|boolean',
            'order' => 'nullable|integer',
            'applications' => 'nullable|array',
            'applications.*' => 'exists:stone_applications,id',
            'remove_gallery' => 'nullable|array',
            'remove_gallery.*' => 'string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        
        // Upload main image
        if ($request->hasFile('main_image')) {
            // Delete old main image
            if ($product->main_image && Storage::disk('public')->exists($product->main_image)) {
                Storage::disk('public')->delete($product->main_image);
            }
            
            $image = $request->file('main_image');
            $filename = 'stone_products/' . time() . '_' . $image->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('', $image, $filename);
            $data['main_image'] = $filename;
        }
        
        // Handle gallery images
        $gallery = is_array($product->gallery) ? $product->gallery : [];
        
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
                $filename = 'stone_products/' . time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $path = Storage::disk('public')->putFileAs('', $image, $filename);
                $gallery[] = $filename;
            }
        }
        
        // Ensure $gallery is an array before using array_values
        $data['gallery'] = is_array($gallery) ? array_values($gallery) : [];
        
        // Convert specifications to JSON
        if (isset($data['specifications'])) {
            $specifications = [];
            if (isset($data['specifications']['key']) && isset($data['specifications']['value'])) {
                $keys = $data['specifications']['key'];
                $values = $data['specifications']['value'];
                
                for ($i = 0; $i < count($keys); $i++) {
                    if (!empty($keys[$i]) && isset($values[$i]) && !empty($values[$i])) {
                        $specifications[$keys[$i]] = $values[$i];
                    }
                }
            }
            $data['specifications'] = $specifications;
        }
        
        // Loại bỏ applications khỏi data vì nó được lưu trong bảng trung gian
        if (isset($data['applications'])) {
            $applicationIds = $data['applications'];
            unset($data['applications']);
        }
        
        // Update product
        $product->update($data);
        
        // Sync applications
        if (isset($applicationIds)) {
            $product->applications()->sync($applicationIds);
        } else {
            $product->applications()->detach();
        }

        return redirect()->route('admin.stone.products.index')
            ->with('success', 'Sản phẩm đá đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoneProduct $product)
    {
        // Delete main image
        if ($product->main_image && Storage::disk('public')->exists($product->main_image)) {
            Storage::disk('public')->delete($product->main_image);
        }
        
        // Delete gallery images
        if ($product->gallery) {
            foreach ($product->gallery as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }
        
        // Detach applications
        $product->applications()->detach();
        
        // Delete product
        $product->delete();

        return redirect()->route('admin.stone.products.index')
            ->with('success', 'Sản phẩm đá đã được xóa thành công.');
    }
} 