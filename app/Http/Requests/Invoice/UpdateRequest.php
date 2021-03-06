<?php

namespace App\Http\Requests\Invoice;

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
            'type' => [
                'sometimes'
            ],
            'customer_id' => [
                'required',
                'exists:customers,id,deleted_at,NULL'
            ],
            'paid' => [
                'sometimes'
            ],
            'amount' => [
                'required',
                'numeric',
                'gte:0'
            ],
            'for_date' => [
                'required',
                'date_format:Y-m-d'
            ]
        ];
    }
}
