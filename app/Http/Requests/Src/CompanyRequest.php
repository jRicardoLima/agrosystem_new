<?php

namespace App\Http\Requests\Src;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CompanyRequest extends FormRequest
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
            'fantasy_name' => 'required|min:3',
            'company_name' => 'required|min:3',
            'physic_person' => 'required|in:0,1',
            'document_company_identification' => 'required_if:physic_person,0',
            'document_primary' => 'required_if:physic_person,1',
            'zipcode' => 'min:9',
            'state' => 'max:2',
            'contact_one' => 'required',
        ];
    }
}
