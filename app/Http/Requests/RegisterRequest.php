<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class RegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'mobile' => 'required',
            'email' => 'required|string|unique:users',
            'gender' => 'required',
            'dob' => 'required',
            'password' => 'required|confirmed',
        ];
    }
}
