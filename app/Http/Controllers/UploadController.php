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

        $filename = time() . '_' . $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        // Xác định thư mục lưu file (tùy vào loại file)
        $folder = 'uploads/' . date('Ymd');
        $path = $file->storeAs($folder, $filename, 'public');

        $url = Storage::url($path);

        return response()->json([
            "success" => true,
            "inputName" => $inputName, // Trả về name của input file để nhận diện
            "fileName" => $filename,
            "url" => $url,
            "extension" => $extension
        ]);
    }
}
