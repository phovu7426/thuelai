<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Upload ảnh chung cho form (Admin tạo/sửa tài khoản, v.v.).
     * - Lưu file vào disk public theo ngày
     * - Trả về JSON chứa URL để gán vào input
     */
    public function upload(Request $request): JsonResponse
    {
        try {
            $files = $request->allFiles();
            if (empty($files)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không có file nào được tải lên!'
                ], 400);
            }

            // Ưu tiên các key thường gặp, nếu không có thì lấy file đầu tiên
            $preferredKeys = ['image', 'avatar', 'file', 'photo', 'upload'];
            $inputName = null;
            foreach ($preferredKeys as $k) {
                if ($request->hasFile($k)) { $inputName = $k; break; }
            }
            if (!$inputName) {
                $inputName = array_key_first($files);
            }

            $file = $request->file($inputName);

            // Kiểm tra loại file
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Chỉ chấp nhận file hình ảnh (JPEG, PNG, GIF, WebP)!'
                ], 400);
            }

            // Giới hạn kích thước 5MB (tùy chỉnh nếu cần)
            $maxSize = 5 * 1024 * 1024;
            if ($file->getSize() > $maxSize) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kích thước ảnh vượt quá 5MB!'
                ], 413);
            }

            $originalBase = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = strtolower($file->getClientOriginalExtension());
            // Loại bỏ ký tự đặc biệt để tránh 403/URL lỗi
            $base = preg_replace('/[^A-Za-z0-9\-_]+/', '_', $originalBase);
            $base = trim($base, '_');
            if ($base === '') { $base = 'file'; }
            $filename = time() . '_' . $base . '.' . $ext;
            $folder = 'uploads/' . date('Ymd');
            $path = $file->storeAs($folder, $filename, 'public');

            $url = Storage::url($path);

            // Trả về JSON đơn giản để gán vào input
            return response()->json([
                'success'   => true,
                'url'       => $url,
                'path'      => $path,
                'fileName'  => $filename,
                'inputName' => $inputName,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload lỗi: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Upload ảnh dành cho CKEditor (nếu đang sử dụng CKEditor trong dự án)
     * Trả về format: { uploaded: 1, fileName: '...', url: '...' }
     */
    public function uploadImage(Request $request): JsonResponse
    {
        // Chấp nhận 1 trong 2 token (_token hoặc ckCsrfToken)
        if (!$request->has('_token') && !$request->has('ckCsrfToken')) {
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => 'CSRF token không hợp lệ!'
                ]
            ]);
        }

        if (!$request->hasFile('upload')) {
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => 'Không có file nào được tải lên!'
                ]
            ]);
        }

        $file = $request->file('upload');

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => 'Chỉ chấp nhận file hình ảnh (JPEG, PNG, GIF, WebP)!'
                ]
            ]);
        }

        $originalName = $file->getClientOriginalName();
        $safeName = preg_replace('/\s+/', '_', $originalName);
        $filename = time() . '_' . $safeName;
        $folder = 'uploads/' . date('Ymd');
        $path = $file->storeAs($folder, $filename, 'public');
        $url = Storage::url($path);

        return response()->json([
            'uploaded' => 1,
            'fileName' => $filename,
            'url' => $url,
        ]);
    }
}
