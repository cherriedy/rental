<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

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
            'rememberme' => 'nullable',
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
