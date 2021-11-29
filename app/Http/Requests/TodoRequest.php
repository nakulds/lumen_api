<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class TodoRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ];
    }
}
