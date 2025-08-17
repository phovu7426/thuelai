<?php

namespace App\Http\Controllers\Admin\Driver;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Driver\DriverPricingRule\StoreRequest;
use App\Http\Requests\Admin\Driver\DriverPricingRule\UpdateRequest;
use App\Services\Admin\Driver\DriverPricingRuleService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DriverPricingRuleController extends BaseController
{
    public function __construct(DriverPricingRuleService $driverPricingRuleService)
    {
        $this->service = $driverPricingRuleService;
    }

    /**
     * Lấy service instance
     * @return DriverPricingRuleService
     */
    public function getService(): DriverPricingRuleService
    {
        return $this->service;
    }

    /**
     * Hiển thị danh sách quy tắc giá
     * @param Request $request
     * @return View|Application|Factory
     */
    public function index(Request $request): View|Application|Factory
    {
        $filters = $this->getFilters($request->all());
        $options = $this->getOptions($request->all());
        $pricingRules = $this->getService()->getList($filters, $options);
        $distanceTiers = \App\Models\DriverDistanceTier::active()->ordered()->get();
        
        return view('admin.driver.pricing-rules.index', compact('pricingRules', 'distanceTiers', 'filters', 'options'));
    }

    /**
     * Hiển thị form tạo quy tắc giá
     * @return View|Application|Factory
     */
    public function create(): View|Application|Factory
    {
        $distanceTiers = \App\Models\DriverDistanceTier::active()->ordered()->get();
        return view('admin.driver.pricing-rules.create', compact('distanceTiers'));
    }

    /**
     * Xử lý tạo quy tắc giá
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $result = $this->getService()->create($request->validated());
        
        return response()->json([
            'success' => $result['success'] ?? false,
            'message' => $result['message'] ?? 'Tạo quy tắc giá thất bại.',
            'data' => $result['data'] ?? null
        ]);
    }

    /**
     * Hiển thị chi tiết quy tắc giá
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $pricingRule = $this->getService()->findById($id);
        
        if (!$pricingRule) {
            return response()->json([
                'success' => false,
                'message' => 'Quy tắc giá không tồn tại.',
                'data' => null
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Lấy thông tin quy tắc giá thành công.',
            'data' => $pricingRule
        ]);
    }

    /**
     * Hiển thị form chỉnh sửa quy tắc giá
     * @param int $id
     * @return View|Application|Factory
     */
    public function edit(int $id): View|Application|Factory
    {
        $pricingRule = $this->getService()->findById($id);
        
        if (!$pricingRule) {
            abort(404, 'Quy tắc giá không tồn tại.');
        }
        
        $distanceTiers = \App\Models\DriverDistanceTier::active()->ordered()->get();
        return view('admin.driver.pricing-rules.edit', compact('pricingRule', 'distanceTiers'));
    }

    /**
     * Xử lý chỉnh sửa quy tắc giá
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $result = $this->getService()->update($id, $request->validated());
        
        return response()->json([
            'success' => $result['success'] ?? false,
            'message' => $result['message'] ?? 'Cập nhật quy tắc giá thất bại.',
            'data' => $result['data'] ?? null
        ]);
    }

    /**
     * Xử lý xóa quy tắc giá
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $result = $this->getService()->delete($id);
        
        return response()->json([
            'success' => $result['success'] ?? false,
            'message' => $result['message'] ?? 'Xóa quy tắc giá thất bại.',
            'data' => $result['data'] ?? null
        ]);
    }

    /**
     * Thay đổi trạng thái quy tắc giá
     * @param int $id
     * @return JsonResponse
     */
    public function toggleStatus(int $id): JsonResponse
    {
        $result = $this->getService()->toggleStatus($id);
        
        return response()->json([
            'success' => $result['success'] ?? false,
            'message' => $result['message'] ?? 'Thay đổi trạng thái thất bại.',
            'data' => $result['data'] ?? null
        ]);
    }

    /**
     * Thay đổi trạng thái nổi bật của quy tắc giá
     * @param int $id
     * @return JsonResponse
     */
    public function toggleFeatured(int $id): JsonResponse
    {
        $result = $this->getService()->toggleFeatured($id);
        
        return response()->json([
            'success' => $result['success'] ?? false,
            'message' => $result['message'] ?? 'Thay đổi trạng thái nổi bật thất bại.',
            'data' => $result['data'] ?? null
        ]);
    }
}
