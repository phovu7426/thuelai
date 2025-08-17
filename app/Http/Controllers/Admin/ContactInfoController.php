<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\ContactInfo\UpdateRequest;
use App\Services\Admin\ContactInfoService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;

class ContactInfoController extends BaseController
{
    protected ContactInfoService $contactInfoService;

    public function __construct(ContactInfoService $contactInfoService)
    {
        $this->contactInfoService = $contactInfoService;
    }

    /**
     * Hiển thị form chỉnh sửa thông tin liên hệ
     * @return View|Application|Factory
     */
    public function edit(): View|Application|Factory
    {
        $contact = $this->contactInfoService->getContactInfo();
        return view('admin.contact_info.edit', compact('contact'));
    }

    /**
     * Cập nhật thông tin liên hệ
     * @param UpdateRequest $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        $result = $this->contactInfoService->updateContactInfo($request->validated());
        
        return response()->json([
            'success' => $result['success'] ?? false,
            'message' => $result['message'] ?? 'Cập nhật thông tin liên hệ thất bại.',
            'data' => $result['data'] ?? null
        ]);
    }
}
