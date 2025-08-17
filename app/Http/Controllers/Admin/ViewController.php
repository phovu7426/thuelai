<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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

            // Kiểm tra view có tồn tại không
            if (!View::exists($viewPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'View không tồn tại: ' . $viewPath
                ], 404);
            }

            // Render view với data
            $html = view($viewPath, $data)->render();

            return response()->json([
                'success' => true,
                'html' => $html,
                'message' => 'Load view thành công'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}
