<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreHotServiceOfRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hotServiceOption' => 'required',
            'starting_date' => 'required',
            'days' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'hotServiceOption.required' => 'Gói dịch vụ không được để trống.',
            'starting_date' => 'Ngày bắt đầu không được để trống',
            'days' => 'Số ngày sử dụng không được để trống.',
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
