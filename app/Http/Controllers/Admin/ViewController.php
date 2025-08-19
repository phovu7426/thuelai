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
            $id = $request->input('id');
            
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

            // Nếu không truyền data từ client nhưng có id và là users form, tự fetch server-side
            if (empty($data) && !empty($id) && $viewPath === 'admin.users.form') {
                $user = \App\Models\User::with('profile')->findOrFail((int)$id);
                $data = [
                    'data' => $user->toArray(),
                    'mode' => 'edit',
                    'isEdit' => true,
                    'id' => (int)$id,
                ];
            }
            
            // Chuẩn hóa biến cho view users.form nếu được yêu cầu
            if ($viewPath === 'admin.users.form') {
                $record = $data['data'] ?? $data;
                $isEditFlag = $data['isEdit'] ?? ((($data['mode'] ?? '') === 'edit') || !empty($data['id']));

                $prepared = [
                    'name' => data_get($record, 'name'),
                    'email' => data_get($record, 'email'),
                    'status' => data_get($record, 'status', 'active'),
                    'phone' => data_get($record, 'profile.phone'),
                    'address' => data_get($record, 'profile.address'),
                    'birth_date' => data_get($record, 'profile.birth_date'),
                    'gender' => data_get($record, 'profile.gender'),
                    'isEdit' => (bool) $isEditFlag,
                ];

                // Merge để view có biến phẳng sử dụng trực tiếp
                $data = array_merge($data, $prepared);
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
