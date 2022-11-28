<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'coupon_name' => 'required|unique:coupons,coupon_name',
            'discount_percentage' => 'required|numeric|min:1|max:99',
            'validity' => 'required|date|after:today',
            'limit' => 'required|numeric|min:1|max:200',
        ];
    }

    public function messages()
    {
        return[
            'limit.numeric' => 'Please give number character',
            'limit' => 'The limit field must be required',
        ];
    }
}
