<?php

namespace App\Http\Requests\Src;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EmployeeRequest extends FormRequest
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
            'name' => 'required|min:3',
            'document_primary' => 'required|min:14|max:14',
            'document_secondary' => 'required|max:20',
            'document_secondary_complement' => 'max:20',
            'married' => 'required|in:0,1',
            'children' => 'required|in:0,1',
            'number_of_children'=> 'required_if:children,1',
            'date_birth' => 'required|date_format:d/m/Y',
            'state' => 'required|max:2',
            'city' => 'required|min:3',
            'street' => 'required|min:3',
            'neighborhood' => 'required',
            'celphone' => 'required',
            'contract_date' => 'required',
            'salary' => 'required',
            'occupation_id' =>'not_In:0',
            'unity_id' => 'not_In:0',
        ];
    }
}
