<?php

namespace App\Http\Requests\Src;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PurchaseOrderRequest extends FormRequest
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
           'requesting_user' => 'required|exists:employees,id',
           'employee_id' => 'required|exists:employees,id',
           'justification' => 'required|min:40',
        ];
    }
}
