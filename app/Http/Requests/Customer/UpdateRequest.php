<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'id' => [
                'required',
                'exists:customers,id,deleted_at,NULL'
            ],'name' => [
                'sometimes'
            ],
            'email' => [
                'required',
                'string',
                'email'
            ],
            'mobile' => [
                'required'
            ],
            'phone' => [
                'required'
            ],
            'address' => [
                'sometimes'
            ],
            'balance' => [
                'sometimes'
            ],
            'company_name' => [
                'sometimes'
            ],
            'company_type' => [
                'sometimes'
            ],
            'billing_type' => [
                'sometimes'
            ],
            'bill_amount' => [
                'sometimes'
            ],
            'bill_start_date' => [
                'sometimes',
                'date_format:Y-m-d'
            ]
        ];
    }
}
