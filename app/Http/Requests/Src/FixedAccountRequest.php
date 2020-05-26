<?php

namespace App\Http\Requests\Src;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FixedAccountRequest extends FormRequest
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
            'name_fixed_product' => 'required|min:3',
            'type_payment' => 'required|in:money,credit_card,debit_card,billet,bank_cheque',
            'value' => 'required',
            'due_date' => 'required|date_format:d/m/Y',
            'status' => 'required|in:0,1'
        ];
    }
}
