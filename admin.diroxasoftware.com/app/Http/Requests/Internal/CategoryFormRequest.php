<?php

namespace App\Http\Requests\Internal;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:300',
            'about' => 'max:500',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'The input name is required ',
            'name.min' => 'The name is too short. The name must be a minimum  of 2 characters',
            'name.max' => 'The name is too big. The name must be a maximum of 300 characters',

            'about.required' => 'The about is required',
            'about.min' => 'The about must to be longer than 4 characters',
            'about.max' => 'The about must to be shorter than 500 characters',

        ];
    }

}
