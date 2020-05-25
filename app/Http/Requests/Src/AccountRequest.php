<?php

namespace App\Http\Requests\Src;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AccountRequest extends FormRequest
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
            'type_payment' => 'required|in:money,credit_card,debit_card,billet,bank_cheque',
            'access_key_id' => 'required|min:44'
        ];
    }
}
