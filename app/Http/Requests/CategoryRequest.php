<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class CategoryRequest extends FormRequest
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
        ];
    }
}
