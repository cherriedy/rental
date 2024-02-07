<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class SetNewPasswordRequest extends FormRequest
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
            'password' => 'required|confirmed|min:8|max:40',
            'password_confirmation' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Không được để trống mật khẩu',
            'password.confirmed' => 'Mật khẩu nhập lại không trùng khớp',
            'password.min' => 'Mật khẩu phải lớn hơn 8 kí tự',
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
