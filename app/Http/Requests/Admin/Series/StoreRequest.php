<?php

namespace App\Http\Requests\Admin\Series;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:series,code',
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

    protected function failedValidation(Validator $validator)
    {
        $this->dd($validator);
    }

}
