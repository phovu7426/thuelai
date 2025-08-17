<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ViewController extends BaseController
{
    /**
     * Load view cho modal
     * @param Request $request
     * @return JsonResponse
     */
    public function loadView(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'view' => 'required|string',
                'data' => 'nullable|string'
            ]);

            $viewPath = $request->input('view');
            $data = json_decode($request->input('data', '{}'), true) ?? [];
            
            // Log để debug
            Log::info('Loading view', [
                'view' => $viewPath,
                'data' => $data,
                'user_id' => Auth::check() ? Auth::id() : null
            ]);

            // Kiểm tra view có tồn tại không
            if (!View::exists($viewPath)) {
                Log::warning('View not found', ['view' => $viewPath]);
                return response()->json([
                    'success' => false,
                    'message' => 'View không tồn tại: ' . $viewPath
                ], 404);
            }

            // Kiểm tra dữ liệu trước khi render
            if (isset($data['permissions']) && is_array($data['permissions'])) {
                // Đảm bảo permissions là collection hoặc array
                if (is_object($data['permissions']) && method_exists($data['permissions'], 'toArray')) {
                    $data['permissions'] = $data['permissions']->toArray();
                }
            }
            
            // Đảm bảo $data luôn là array
            if (!is_array($data)) {
                $data = [];
            }
            
            // Khởi tạo các biến cần thiết nếu không có
            if (!isset($data['data'])) {
                $data['data'] = [];
            }

            // Render view với data
            $html = view($viewPath, $data)->render();

            Log::info('View loaded successfully', ['view' => $viewPath]);

            return response()->json([
                'success' => true,
                'html' => $html,
                'message' => 'Load view thành công'
            ]);

        } catch (\Exception $e) {
            Log::error('Error loading view', [
                'view' => $request->input('view'),
                'data' => $request->input('data'),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}
