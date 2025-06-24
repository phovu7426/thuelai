<?php

namespace App\Http\Requests\Admin\Series;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Hàm check validate
     * @return string[]
     */
    public function rules(): array
    {
        $areaId = $this->route('id'); // Lấy ID từ route khi cập nhật

        return [
            'name' => 'required|string|max:255',
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('series', 'code')->ignore($areaId),
            ],
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ];
    }

    /**
     * Hàm trả ra thông báo validate
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên khu vực không được để trống.',
            'code.required' => 'Mã khu vực không được để trống.',
            'code.unique' => 'Mã khu vực đã tồn tại.',
        ];
    }
}
