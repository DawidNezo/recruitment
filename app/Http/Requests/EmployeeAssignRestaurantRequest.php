<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Validator;

class EmployeeAssignRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $limit_restaurant = config('enums.limit_restaurant');
        return [
            'restaurant_ids' => "array|max:{$limit_restaurant}"
        ];
    }

    public function messages(): array
    {
        return [
            'restaurant_ids.max' => __('messages.restaurant_limit'),
        ];
    }
}
