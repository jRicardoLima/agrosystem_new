<?php

namespace App\Http\Requests\Src;

use App\Occupation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name_user' => 'required|min:3',
            'document_primary' => 'required|min:11|max:14',
            'password' =>'required',
            'occupation_id' => 'required|notIn:0',
            'unity_id' => 'required|notIn:0',
            'avatar' => 'mimes:jpg,png,jpeg,gif'
        ];
    }
}
