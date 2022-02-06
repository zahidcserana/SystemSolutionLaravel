<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
                'required'
            ],
            'for_date' => [
                'required',
                'date_format:Y-m-d'
            ]
        ];
    }
}
