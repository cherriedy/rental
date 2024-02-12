<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
            'city_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'street_id' => 'required',
            'category_id' => 'required',
            'apartment_number' => 'required',
            'exact_address' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'area' => 'required',
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
            'category_id.required' => 'Không được để trống chuyên mục.',
            'title.required' => 'Không được để trống tiêu đề.',
            'description.required' => 'Không được để trống mô tả.',
            'price.required' => 'Không được để trống giá.',
            'area.required' => 'Không được để trống diện tích.',
        ];
    }
}
