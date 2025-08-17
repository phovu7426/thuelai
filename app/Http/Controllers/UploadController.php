<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Hàm upload file
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        // Lấy tất cả các input chứa file
        $request->merge(['_token' => $request->ckCsrfToken ?? $request->_token]);
        $fileKeys = array_keys($request->allFiles());

        if (empty($fileKeys)) {
            return response()->json([
                "success" => false,
                "message" => "Không có file nào được tải lên!"
            ], 400);
        }

        // Chỉ xử lý file đầu tiên (hoặc có thể lặp nếu muốn xử lý nhiều file)
        $inputName = $fileKeys[0]; // Ví dụ: 'image', 'icon', 'document'
        $file = $request->file($inputName);

        // Kiểm tra loại file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return response()->json([
                "success" => false,
                "message" => "Chỉ chấp nhận file hình ảnh (JPEG, PNG, GIF, WebP)!"
            ], 400);
        }

        $filename = time() . '_' . $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        // Xác định thư mục lưu file (tùy vào loại file)
        $folder = 'uploads/' . date('Ymd');
        $path = $file->storeAs($folder, $filename, 'public');

        $url = Storage::url($path);

        // Trả về response tương thích với CKEditor
        return response()->json([
            "success" => true,
            "inputName" => $inputName,
            "fileName" => $filename,
            "url" => $url,
            "extension" => $extension,
            // CKEditor cần các field này
            "uploaded" => 1,
            "fileName" => $filename,
            "url" => $url
        ]);
    }

    /**
     * Hàm upload hình ảnh cho CKEditor
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadImage(Request $request): JsonResponse
    {
        // Validate CSRF token
        if (!$request->has('_token') || !$request->has('ckCsrfToken')) {
            return response()->json([
                "uploaded" => 0,
                "error" => [
                    "message" => "CSRF token không hợp lệ!"
                ]
            ]);
        }

        if (!$request->hasFile('upload')) {
            return response()->json([
                "uploaded" => 0,
                "error" => [
                    "message" => "Không có file nào được tải lên!"
                ]
            ]);
        }

        $file = $request->file('upload');

        // Kiểm tra loại file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return response()->json([
                "uploaded" => 0,
                "error" => [
                    "message" => "Chỉ chấp nhận file hình ảnh (JPEG, PNG, GIF, WebP)!"
                ]
            ]);
        }

        $filename = time() . '_' . $file->getClientOriginalName();
        $folder = 'uploads/' . date('Ymd');
        $path = $file->storeAs($folder, $filename, 'public');
        $url = Storage::url($path);

        // Trả về response tương thích với CKEditor
        return response()->json([
            "uploaded" => 1,
            "fileName" => $filename,
            "url" => $url
        ]);
    }
}
