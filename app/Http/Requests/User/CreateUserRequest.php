<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:40',
            'email' => 'required|string|max:255|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Không được để trống tên',
            'name.min' => 'Tên phải lớn hơn 3 kí tự',
            'name.max' => 'Tên phải bé hơn 40 kí tự',
            'email.required' => 'Không được để trống email',
            'email.max' => 'Email phải bé hơn 255 kí tự',
            'email.email' => 'Vui lòng nhập đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Không được để trống mật khẩu',
            'password.min' => 'Mật khẩu phải lớn hơn 8 kí tự',
            'password.confirmed' => 'Mật khẩu nhập lại không trùng khớp',
            'password_confirmation.required' => 'Không được để trống mật khẩu nhập lại',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->wantsJson()) {
            $hasErrors = $validator->errors();

            foreach ($hasErrors->all() as $error) {
                $errors[] = $error;
            }

            $response = response()->json([
                'errors' => $errors,
                'status_code' => 422,
            ]);
        }

        throw (new ValidationException($validator, $response))->errorBag($this->errorBag)->redirectTo($this->getRedirectUrl());
    }
}
