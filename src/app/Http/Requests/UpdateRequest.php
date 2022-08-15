<?php

namespace App\Http\Requests;

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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_name' => ['required', 'string', 'max:20'],
            'user_name' => ['required', 'string', 'regex:/^([a-zA-Z0-9]{1,10})+\z/u', 'unique:users'],
            'profile_text' => ['required', 'string', 'max:120'],
        ];
    }
}
