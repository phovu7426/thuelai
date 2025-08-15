<?php

namespace App\Http\Controllers\Admin\Driver;

use App\Http\Controllers\Controller;
use App\Models\DriverService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DriverServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DriverService::query();

        // Lọc theo tên dịch vụ
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $services = $query->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.driver.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.driver.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'is_featured' => 'boolean',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Tên dịch vụ là bắt buộc',
            'name.max' => 'Tên dịch vụ không được vượt quá 255 ký tự',
            'short_description.max' => 'Mô tả ngắn không được vượt quá 500 ký tự',
            'image.image' => 'File phải là hình ảnh',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif',
            'image.max' => 'Hình ảnh không được vượt quá 2MB',
            'icon.image' => 'File icon phải là hình ảnh',
            'icon.mimes' => 'Icon phải có định dạng: jpeg, png, jpg, gif',
            'icon.max' => 'Icon không được vượt quá 2MB',
        ]);

        try {
            $data = $request->all();
            $data['slug'] = Str::slug($request->name);
            $data['is_featured'] = $request->has('is_featured');
            $data['status'] = $request->has('status');

            // Xử lý upload hình ảnh
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('driver-services', 'public');
                $data['image'] = $imagePath;
            }

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('driver-services/icons', 'public');
                $data['icon'] = $iconPath;
            }

            DriverService::create($data);

            return redirect()->route('admin.driver.services.index')
                ->with('success', 'Dịch vụ đã được tạo thành công!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Có lỗi xảy ra khi tạo dịch vụ: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DriverService $driverService)
    {
        return view('admin.driver.services.show', compact('driverService'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DriverService $driverService)
    {
        // Debug: Kiểm tra xem có lấy được service không
        if (!$driverService) {
            abort(404, 'Service not found');
        }
        
        return view('admin.driver.services.edit', compact('driverService'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DriverService $driverService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'is_featured' => 'boolean',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Tên dịch vụ là bắt buộc',
            'name.max' => 'Tên dịch vụ không được vượt quá 255 ký tự',
            'short_description.max' => 'Mô tả ngắn không được vượt quá 500 ký tự',
            'image.image' => 'File phải là hình ảnh',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif',
            'image.max' => 'Hình ảnh không được vượt quá 2MB',
            'icon.image' => 'File icon phải là hình ảnh',
            'icon.mimes' => 'Icon phải có định dạng: jpeg, png, jpg, gif',
            'icon.max' => 'Icon không được vượt quá 2MB',
        ]);

        try {
            $data = $request->all();
            $data['slug'] = Str::slug($request->name);
            $data['is_featured'] = $request->has('is_featured');
            $data['status'] = $request->has('status');

            // Xử lý upload hình ảnh mới
            if ($request->hasFile('image')) {
                // Xóa hình ảnh cũ nếu có
                if ($driverService->image) {
                    Storage::disk('public')->delete($driverService->image);
                }
                $imagePath = $request->file('image')->store('driver-services', 'public');
                $data['image'] = $imagePath;
            }

            if ($request->hasFile('icon')) {
                // Xóa icon cũ nếu có
                if ($driverService->icon) {
                    Storage::disk('public')->delete($driverService->icon);
                }
                $iconPath = $request->file('icon')->store('driver-services/icons', 'public');
                $data['icon'] = $iconPath;
            }

            $driverService->update($data);

            return redirect()->route('admin.driver.services.index')
                ->with('success', 'Dịch vụ đã được cập nhật thành công!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Có lỗi xảy ra khi cập nhật dịch vụ: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriverService $driverService)
    {
        try {
            // Xóa hình ảnh nếu có
            if ($driverService->image) {
                Storage::disk('public')->delete($driverService->image);
            }
            if ($driverService->icon) {
                Storage::disk('public')->delete($driverService->icon);
            }

            $driverService->delete();

            return redirect()->route('admin.driver.services.index')
                ->with('success', 'Dịch vụ đã được xóa thành công!');

        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi xóa dịch vụ: ' . $e->getMessage());
        }
    }

    /**
     * Toggle trạng thái dịch vụ
     */
    public function toggleStatus(DriverService $driverService)
    {
        try {
            $driverService->update(['status' => !$driverService->status]);
            
            $status = $driverService->status ? 'kích hoạt' : 'vô hiệu hóa';
            return response()->json([
                'success' => true,
                'message' => "Dịch vụ đã được {$status} thành công!",
                'status' => $driverService->status
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
    public function toggleFeatured(DriverService $driverService)
    {
        try {
            $driverService->update(['is_featured' => !$driverService->is_featured]);
            
            $status = $driverService->is_featured ? 'đánh dấu nổi bật' : 'bỏ đánh dấu nổi bật';
            return response()->json([
                'success' => true,
                'message' => "Dịch vụ đã được {$status} thành công!",
                'is_featured' => $driverService->is_featured
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
            'services' => 'required|array',
            'services.*.id' => 'required|exists:driver_services,id',
            'services.*.sort_order' => 'required|integer|min:0'
        ]);

        try {
            foreach ($request->services as $service) {
                DriverService::where('id', $service['id'])
                    ->update(['sort_order' => $service['sort_order']]);
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
}
