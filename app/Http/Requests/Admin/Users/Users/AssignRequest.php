<?php

namespace App\Http\Requests\Admin\Users\Users;

use Illuminate\Foundation\Http\FormRequest;

class AssignRequest extends FormRequest
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
        return [
            'roles' => 'required|array',
        ];
    }

    /**
     * Hàm trả ra thông báo validate
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'roles.required' => 'Vai trò không được để trống.',
            'roles.array' => 'Định dạng không hợp lệ',
        ];
    }
}
