<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Products\StoreRequest;
use App\Http\Requests\Admin\Products\UpdateRequest;
use App\Services\Admin\Products\ProductService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function __construct(ProductService $productService)
    {
        $this->service = $productService;
    }

    /**
     * Lấy service instance
     * @return ProductService
     */
    public function getService(): ProductService
    {
        return $this->service;
    }

    /**
     * Hiển thị danh sách sản phẩm
     * @param Request $request
     * @return View|Application|Factory
     */
    public function index(Request $request): View|Application|Factory
    {
        $filters = $this->getFilters($request->all());
        $options = $this->getOptions($request->all());
        $products = $this->getService()->getList($filters, $options);
        
        return view('admin.products.index', compact('products', 'filters', 'options'));
    }

    /**
     * Hiển thị form tạo sản phẩm
     * @return View|Application|Factory
     */
    public function create(): View|Application|Factory
    {
        return view('admin.products.create');
    }

    /**
     * Xử lý tạo sản phẩm
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $result = $this->getService()->create($request->validated());
        
        return response()->json([
            'success' => $result['success'] ?? false,
            'message' => $result['message'] ?? 'Tạo sản phẩm thất bại.',
            'data' => $result['data'] ?? null
        ]);
    }

    /**
     * Hiển thị form chỉnh sửa sản phẩm
     * @param int $id
     * @return View|Application|Factory|RedirectResponse
     */
    public function edit(int $id): View|Application|Factory|RedirectResponse
    {
        $product = $this->getService()->findById($id);
        
        if (!$product) {
            return redirect()->route('admin.products.index')
                ->with('fail', 'Sản phẩm không tồn tại.');
        }
        
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Xử lý chỉnh sửa sản phẩm
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $result = $this->getService()->update($id, $request->validated());
        
        return response()->json([
            'success' => $result['success'] ?? false,
            'message' => $result['message'] ?? 'Cập nhật sản phẩm thất bại.',
            'data' => $result['data'] ?? null
        ]);
    }

    /**
     * Xử lý xóa sản phẩm
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $result = $this->getService()->delete($id);
        
        return response()->json([
            'success' => $result['success'] ?? false,
            'message' => $result['message'] ?? 'Xóa sản phẩm thất bại.',
            'data' => $result['data'] ?? null
        ]);
    }

    /**
     * Thay đổi trạng thái sản phẩm
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function changeStatus(int $id, Request $request): JsonResponse
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);
        
        $result = $this->getService()->changeStatus($id, (int) $request->status);
        
        return response()->json([
            'success' => $result['success'] ?? false,
            'message' => $result['message'] ?? 'Thay đổi trạng thái sản phẩm thất bại.',
            'data' => $result['data'] ?? null
        ]);
    }

    /**
     * Lấy thông tin sản phẩm cho AJAX request
     * @param int $id
     * @return JsonResponse
     */
    public function getProductInfo(int $id): JsonResponse
    {
        try {
            $product = $this->getService()->findById($id);
            
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Xử lý response chung cho các action
     * @param array $result
     * @param string $successMessage
     * @param string $failMessage
     * @param string $redirectRoute
     * @return RedirectResponse
     */
    protected function handleResponse(
        array $result, 
        string $successMessage, 
        string $failMessage, 
        string $redirectRoute
    ): RedirectResponse {
        if (!empty($result['success'])) {
            return redirect()->route($redirectRoute)
                ->with('success', $result['message'] ?? $successMessage);
        }
        
        return redirect()->route($redirectRoute)
            ->with('fail', $result['message'] ?? $failMessage);
    }
}
