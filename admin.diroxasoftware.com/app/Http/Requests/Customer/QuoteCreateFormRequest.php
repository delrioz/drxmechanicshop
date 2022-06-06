<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class QuoteCreateFormRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'title' => 'max:275',
            'last_observations' => 'max:300',
            // 'machine' => 'unique:quotes',
        ];
    }
  
  
    public function messages()
    {
        return[

            'title.required' => 'The title is required',
            'title.min' => 'The title must to be longer than 2 characters',
            'title.max' => 'The title must to be shorter than 275 characters',
            'machine.unique' => 'This machine already have a quote',

            'last_observations.required' => 'The Last Observations is required',
            'last_observations.min' => 'The Last Observations must to be longer than 4 characters',
            'last_observations.max' => 'The Last Observations must to be shorter than 300 characsters',

        ];
    }
}
