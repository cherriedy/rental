<?php

namespace App\Http\Requests\Room;

use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateRoomRequest extends FormRequest
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
            'user_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'street_id' => 'required',
            'apartment_number' => 'required',
            'exact_address' => 'required',
            'category_id' => 'required',
            'title' => 'required|unique:rooms',
            'image' => 'required',
            'description' => 'required',
            'price' => 'required',
            'area' => 'required|numeric|min:5',
            'map' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'city_id.required' => 'Không được để trống tỉnh/thành.',
            'district_id.required' => 'Không được để trống quận/huyện.',
            'ward_id.required' => 'Không được để trống phường/xã.',
            'street_id.required' => 'Không được để trống đường.',
            'apartment_number.required' => 'Không được để trống số nhà',
            'category_id.required' => 'Không được để trống chuyên mục.',
            'title.required' => 'Không được để trống tiêu đề.',
            'title.unique' => 'Tiêu đề đã được sử dụng.',
            'description.required' => 'Không được để trống mô tả.',
            'price.required' => 'Không được để trống giá.',
            'area.required' => 'Không được để trống diện tích.',
            'area.min' => 'Diện tích phải lớn hơn 5m².',
            'image.required' => 'Không được để trống hình.',
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
