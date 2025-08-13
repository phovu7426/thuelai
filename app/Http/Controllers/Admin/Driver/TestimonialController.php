<?php

namespace App\Http\Controllers\Admin\Driver;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.driver.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.driver.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_title' => 'nullable|string|max:255',
            'content' => 'required|string|min:10|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ], [
            'customer_name.required' => 'Tên khách hàng là bắt buộc',
            'customer_name.max' => 'Tên khách hàng không được vượt quá 255 ký tự',
            'customer_title.max' => 'Chức danh không được vượt quá 255 ký tự',
            'content.required' => 'Nội dung đánh giá là bắt buộc',
            'content.min' => 'Nội dung đánh giá phải có ít nhất 10 ký tự',
            'content.max' => 'Nội dung đánh giá không được vượt quá 1000 ký tự',
            'rating.required' => 'Đánh giá sao là bắt buộc',
            'rating.integer' => 'Đánh giá sao phải là số nguyên',
            'rating.min' => 'Đánh giá sao phải từ 1-5',
            'rating.max' => 'Đánh giá sao phải từ 1-5',
            'image.image' => 'File phải là hình ảnh',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif',
            'image.max' => 'Hình ảnh không được vượt quá 2MB',
        ]);

        try {
            $data = $request->all();
            $data['is_featured'] = $request->has('is_featured');
            $data['status'] = $request->has('status');

            // Xử lý upload hình ảnh
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('testimonials', 'public');
                $data['image'] = $imagePath;
            }

            Testimonial::create($data);

            return redirect()->route('admin.driver.testimonials.index')
                ->with('success', 'Đánh giá khách hàng đã được tạo thành công!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Có lỗi xảy ra khi tạo đánh giá: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.driver.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.driver.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_title' => 'nullable|string|max:255',
            'content' => 'required|string|min:10|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ], [
            'customer_name.required' => 'Tên khách hàng là bắt buộc',
            'customer_name.max' => 'Tên khách hàng không được vượt quá 255 ký tự',
            'customer_title.max' => 'Chức danh không được vượt quá 255 ký tự',
            'content.required' => 'Nội dung đánh giá là bắt buộc',
            'content.min' => 'Nội dung đánh giá phải có ít nhất 10 ký tự',
            'content.max' => 'Nội dung đánh giá không được vượt quá 1000 ký tự',
            'rating.required' => 'Đánh giá sao là bắt buộc',
            'rating.integer' => 'Đánh giá sao phải là số nguyên',
            'rating.min' => 'Đánh giá sao phải từ 1-5',
            'rating.max' => 'Đánh giá sao phải từ 1-5',
            'image.image' => 'File phải là hình ảnh',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif',
            'image.max' => 'Hình ảnh không được vượt quá 2MB',
        ]);

        try {
            $data = $request->all();
            $data['is_featured'] = $request->has('is_featured');
            $data['status'] = $request->has('status');

            // Xử lý upload hình ảnh mới
            if ($request->hasFile('image')) {
                // Xóa hình ảnh cũ nếu có
                if ($testimonial->image) {
                    Storage::disk('public')->delete($testimonial->image);
                }
                $imagePath = $request->file('image')->store('testimonials', 'public');
                $data['image'] = $imagePath;
            }

            $testimonial->update($data);

            return redirect()->route('admin.driver.testimonials.index')
                ->with('success', 'Đánh giá khách hàng đã được cập nhật thành công!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Có lỗi xảy ra khi cập nhật đánh giá: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        try {
            // Xóa hình ảnh nếu có
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }

            $testimonial->delete();

            return redirect()->route('admin.driver.testimonials.index')
                ->with('success', 'Đánh giá khách hàng đã được xóa thành công!');

        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi xóa đánh giá: ' . $e->getMessage());
        }
    }

    /**
     * Toggle trạng thái đánh giá
     */
    public function toggleStatus(Testimonial $testimonial)
    {
        try {
            $testimonial->update(['status' => !$testimonial->status]);
            
            $status = $testimonial->status ? 'kích hoạt' : 'vô hiệu hóa';
            return response()->json([
                'success' => true,
                'message' => "Đánh giá đã được {$status} thành công!",
                'status' => $testimonial->status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle trạng thái featured
     */
    public function toggleFeatured(Testimonial $testimonial)
    {
        try {
            $testimonial->update(['is_featured' => !$testimonial->is_featured]);
            
            $status = $testimonial->is_featured ? 'đánh dấu nổi bật' : 'bỏ đánh dấu nổi bật';
            return response()->json([
                'success' => true,
                'message' => "Đánh giá đã được {$status} thành công!",
                'is_featured' => $testimonial->is_featured
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cập nhật thứ tự sắp xếp
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'testimonials' => 'required|array',
            'testimonials.*.id' => 'required|exists:testimonials,id',
            'testimonials.*.sort_order' => 'required|integer|min:0'
        ]);

        try {
            foreach ($request->testimonials as $testimonial) {
                Testimonial::where('id', $testimonial['id'])
                    ->update(['sort_order' => $testimonial['sort_order']]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Thứ tự sắp xếp đã được cập nhật thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lọc đánh giá theo trạng thái
     */
    public function filterByStatus(Request $request)
    {
        $status = $request->get('status');
        $query = Testimonial::query();

        if ($status && $status !== 'all') {
            $query->where('status', $status === 'active');
        }

        $testimonials = $query->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        if ($request->ajax()) {
            return view('admin.driver.testimonials.partials.testimonials-table', compact('testimonials'))->render();
        }

        return view('admin.driver.testimonials.index', compact('testimonials'));
    }

    /**
     * Tìm kiếm đánh giá
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        $query = Testimonial::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $testimonials = $query->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        if ($request->ajax()) {
            return view('admin.driver.testimonials.partials.testimonials-table', compact('testimonials'))->render();
        }

        return view('admin.driver.testimonials.index', compact('testimonials'));
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate,deactivate,feature,unfeature',
            'ids' => 'required|array',
            'ids.*' => 'exists:testimonials,id'
        ]);

        try {
            $ids = $request->ids;
            $action = $request->action;

            switch ($action) {
                case 'delete':
                    $testimonials = Testimonial::whereIn('id', $ids)->get();
                    foreach ($testimonials as $testimonial) {
                        if ($testimonial->image) {
                            Storage::disk('public')->delete($testimonial->image);
                        }
                    }
                    Testimonial::whereIn('id', $ids)->delete();
                    $message = 'Đã xóa ' . count($ids) . ' đánh giá thành công!';
                    break;

                case 'activate':
                    Testimonial::whereIn('id', $ids)->update(['status' => true]);
                    $message = 'Đã kích hoạt ' . count($ids) . ' đánh giá thành công!';
                    break;

                case 'deactivate':
                    Testimonial::whereIn('id', $ids)->update(['status' => false]);
                    $message = 'Đã vô hiệu hóa ' . count($ids) . ' đánh giá thành công!';
                    break;

                case 'feature':
                    Testimonial::whereIn('id', $ids)->update(['is_featured' => true]);
                    $message = 'Đã đánh dấu nổi bật ' . count($ids) . ' đánh giá thành công!';
                    break;

                case 'unfeature':
                    Testimonial::whereIn('id', $ids)->update(['is_featured' => false]);
                    $message = 'Đã bỏ đánh dấu nổi bật ' . count($ids) . ' đánh giá thành công!';
                    break;
            }

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}
