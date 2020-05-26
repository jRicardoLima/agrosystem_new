<?php

namespace App\Http\Requests\Src;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ExpenseFuelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'name_product_fuel' => 'required|min:3',
            'invoice_fuel_key' => 'required|min:44',
            'number_request_fuel' => 'required|numeric',
            'quantity_fuel' => 'required',
            'type_quantity_fuel' => 'required|in:lt,gl,un',
            'value_fuel' => 'required',
            'due_date_fuel' => 'required|date_format:d/m/Y',
            'status_fuel' => 'required|in:0,1',
            'danfe' => 'required'
        ];
    }
}
