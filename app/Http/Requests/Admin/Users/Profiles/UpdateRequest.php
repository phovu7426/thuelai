<?php

namespace App\Http\Requests\Admin\Users\Profiles;

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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other', // Định dạng giới tính
            'status' => 'boolean'
        ];
    }

    /**
     * Hàm trả ra thông báo validate
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên không được để trống.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 500 ký tự.',
            'birth_date.date' => 'Ngày sinh không hợp lệ.',
            'gender.in' => 'Giới tính phải là male, female hoặc other.',
            'status.boolean' => 'Trạng thái không hợp lệ.'
        ];
    }
}
