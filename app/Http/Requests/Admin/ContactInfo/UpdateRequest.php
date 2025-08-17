<?php

namespace App\Http\Requests\Admin\ContactInfo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'working_time' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'map_embed' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'address.max' => 'Địa chỉ không được vượt quá 500 ký tự',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không được vượt quá 255 ký tự',
            'working_time.max' => 'Thời gian làm việc không được vượt quá 255 ký tự',
            'facebook.max' => 'Link Facebook không được vượt quá 255 ký tự',
            'instagram.max' => 'Link Instagram không được vượt quá 255 ký tự',
            'youtube.max' => 'Link YouTube không được vượt quá 255 ký tự',
            'linkedin.max' => 'Link LinkedIn không được vượt quá 255 ký tự',
        ];
    }
}


