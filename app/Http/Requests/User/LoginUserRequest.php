<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
            // DEVELOPER
            'password' => 'required|string|min:3',
            // 'password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Không được để trống email',
            'email.email' => 'Vui lòng nhập đúng định dạng',
            'email.max' => 'Email phải bé hơn 255 kí tự',
            'password.required' => 'Không được để trống mật khẩu',
            'password.min' => 'Mật khẩu phải lớn hơn 8 kí tự',
        ];
    }
}
