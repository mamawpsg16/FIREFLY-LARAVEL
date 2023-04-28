<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterRequest extends FormRequest
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
            'first_name' => ['required'],
            'middle_name' => ['sometimes'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required','confirmed'],
            'password_confirmation' => 'required'
        ];
    }
}
