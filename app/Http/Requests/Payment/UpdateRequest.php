<?php

namespace App\Http\Requests\Payment;

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
            'method' => [
                'sometimes'
            ],
            'customer_id' => [
                'required',
                'exists:customers,id,deleted_at,NULL'
            ],
            'payload' => [
                'sometimes'
            ],
            'remarks' => [
                'sometimes'
            ],
            'logs' => [
                'sometimes'
            ],
            'amount' => [
                'required',
                'numeric',
                'gte:0'
            ],
            'adjust' => [
                'nullable',
                'numeric',
                'gte:0'
            ],
            'dues' => [
                'nullable',
                'numeric',
                'gte:0'
            ],
            'payment_date' => [
                'required',
                'date_format:Y-m-d'
            ]
        ];
    }
}
