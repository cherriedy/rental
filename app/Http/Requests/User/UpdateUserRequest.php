<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UpdateUserRequest extends FormRequest
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
            'phone' => ['nullable', 'regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'facebook' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên không được để trống.',
            'name.min' => 'Tên phải lớn hơn 3 kí tự.',
            'name.max' => 'Tên phải bé hơn 40 kí tự.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
            // 'phone.unique' => 'Số điện thoại đã được sử dụng.',
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
