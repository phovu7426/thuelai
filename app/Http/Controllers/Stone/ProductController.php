<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneApplication;
use App\Models\StoneCategory;
use App\Models\StoneMaterial;
use App\Models\StoneProduct;
use App\Models\StoneSurface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm
     */
    public function index(Request $request)
    {
        $query = StoneProduct::where('status', 1);
        
        // Lọc theo danh mục
        if ($request->has('category') && $request->category) {
            $category = StoneCategory::where('slug', $request->category)->first();
            if ($category) {
                if ($category->parent_id) {
                    // Nếu là danh mục con
                    $query->where('stone_category_id', $category->id);
                } else {
                    // Nếu là danh mục cha, lấy tất cả sản phẩm thuộc danh mục con
                    $childrenIds = $category->children()->pluck('id')->toArray();
                    $query->whereIn('stone_category_id', $childrenIds);
                }
            }
        }
        
        // Lọc theo chất liệu đá
        if ($request->has('material') && $request->material) {
            $material = StoneMaterial::where('slug', $request->material)->first();
            if ($material) {
                $query->where('stone_material_id', $material->id);
            }
        }
        
        // Lọc theo bề mặt đá
        if ($request->has('surface') && $request->surface) {
            $surface = StoneSurface::where('slug', $request->surface)->first();
            if ($surface) {
                $query->where('stone_surface_id', $surface->id);
            }
        }
        
        // Lọc theo ứng dụng
        if ($request->has('application') && $request->application) {
            $application = StoneApplication::where('slug', $request->application)->first();
            if ($application) {
                $query->whereHas('applications', function ($q) use ($application) {
                    $q->where('stone_applications.id', $application->id);
                });
            }
        }
        
        // Sắp xếp
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name-asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name-desc':
                $query->orderBy('name', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        $products = $query->paginate(12);
        
        // Lấy danh mục, chất liệu, bề mặt, ứng dụng để hiển thị filter
        $categories = StoneCategory::where('status', 1)->get();
        $materials = StoneMaterial::where('status', 1)->orderBy('order', 'asc')->get();
        $surfaces = StoneSurface::where('status', 1)->orderBy('order', 'asc')->get();
        $applications = StoneApplication::where('status', 1)->orderBy('type')->orderBy('order', 'asc')->get();
        
        return view('stone.products.index', compact(
            'products',
            'categories',
            'materials',
            'surfaces',
            'applications'
        ));
    }
    
    /**
     * Hiển thị chi tiết sản phẩm
     */
    public function show($slug)
    {
        $product = StoneProduct::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
            
        // Lấy sản phẩm liên quan (cùng danh mục)
        $relatedProducts = StoneProduct::where('status', 1)
            ->where('id', '!=', $product->id)
            ->where('stone_category_id', $product->stone_category_id)
            ->limit(4)
            ->get();
            
        return view('stone.products.show', compact('product', 'relatedProducts'));
    }
} 