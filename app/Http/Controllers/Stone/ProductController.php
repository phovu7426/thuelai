<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneApplication;
use App\Models\StoneCategory;
use App\Models\StoneColor;
use App\Models\StoneMaterial;
use App\Models\StoneProduct;
use App\Models\StoneProject;
use App\Models\StoneSurface;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm
     */
    public function index(Request $request)
    {
        $query = StoneProduct::with(['category', 'material'])->where('status', 1);

        // Lọc theo danh mục
        if ($request->has('category_id') && $request->category_id) {
            $query->where('stone_category_id', $request->category_id);
        }

        // Lọc theo chất liệu đá
        if ($request->has('material_id') && $request->material_id) {
            $query->where('stone_material_id', $request->material_id);
        }

        // Lọc theo màu sắc
        if ($request->has('color_id') && $request->color_id) {
            $query->where('stone_color_id', $request->color_id);
        }

        // Lọc theo bề mặt đá
        if ($request->has('surface_id') && $request->surface_id) {
            $query->where('stone_surface_id', $request->surface_id);
        }

        // Lọc theo ứng dụng
        if ($request->has('application_id') && $request->application_id) {
            $query->whereHas('applications', function ($q) use ($request) {
                $q->where('stone_applications.id', $request->application_id);
            });
        }

        // Sắp xếp
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        // Lấy danh mục, chất liệu, màu sắc, bề mặt, ứng dụng để hiển thị filter
        $categories = StoneCategory::where('status', 1)
            ->withCount('products')
            ->orderBy('order', 'asc')
            ->get();
        $materials = StoneMaterial::where('status', 1)->orderBy('order', 'asc')->get();
        $colors = StoneColor::where('status', 1)->orderBy('order', 'asc')->get();
        $surfaces = StoneSurface::where('status', 1)->orderBy('order', 'asc')->get();
        $applications = StoneApplication::where('status', 1)->orderBy('order', 'asc')->get();

        $contactInfo = ContactInfo::first();
        return view('stone.products.index', compact(
            'products',
            'categories',
            'materials',
            'colors',
            'surfaces',
            'applications',
            'contactInfo'
        ));
    }

    /**
     * Hiển thị sản phẩm theo danh mục
     */
    public function category($slug)
    {
        $category = StoneCategory::where('slug', $slug)->where('status', 1)->firstOrFail();

        $query = StoneProduct::with(['category', 'material'])
            ->where('status', 1)
            ->where('stone_category_id', $category->id);

        $products = $query->paginate(12);

        // Lấy danh mục, chất liệu, màu sắc, bề mặt, ứng dụng để hiển thị filter
        $categories = StoneCategory::where('status', 1)
            ->withCount('products')
            ->orderBy('order', 'asc')
            ->get();
        $materials = StoneMaterial::where('status', 1)->orderBy('order', 'asc')->get();
        $colors = StoneColor::where('status', 1)->orderBy('order', 'asc')->get();
        $surfaces = StoneSurface::where('status', 1)->orderBy('order', 'asc')->get();
        $applications = StoneApplication::where('status', 1)->orderBy('order', 'asc')->get();

        return view('stone.products.index', compact(
            'products',
            'categories',
            'materials',
            'colors',
            'surfaces',
            'applications',
            'category'
        ));
    }

    /**
     * Hiển thị chi tiết sản phẩm
     */
    public function show($slug)
    {
        $product = StoneProduct::with(['category', 'material', 'images'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // Lấy sản phẩm liên quan (cùng danh mục)
        $relatedProducts = StoneProduct::with(['category', 'material'])
            ->where('status', 1)
            ->where('id', '!=', $product->id)
            ->where('stone_category_id', $product->stone_category_id)
            ->limit(4)
            ->get();

        // Lấy dự án đã sử dụng sản phẩm này
        $relatedProjects = StoneProject::where('status', 1)
            ->whereHas('products', function ($query) use ($product) {
                $query->where('stone_products.id', $product->id);
            })
            ->limit(3)
            ->get();

        return view('stone.products.show', compact('product', 'relatedProducts', 'relatedProjects'));
    }
}
