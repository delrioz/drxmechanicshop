<?php

namespace App\Http\Requests\Internal;

use Illuminate\Foundation\Http\FormRequest;

class InternalMachinesFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

 
    public function rules()
    {
        return [
            'serial_number' => 'required|min:1|max:300|unique:internalmachines',
            'brand' => 'max:300',
            'model' => 'required|min:1|max:300',
        ];
    }

    public function messages()
    {
        return[
            'serial_number.required' => 'The input Serial Number is required ',
            'serial_number.min' => 'The Serial Number is too short. The Serial Number must be a minimum  of 2 characters',
            'serial_number.max' => 'The Serial Number is too big. The Serial Number must be a maximum of 300 characters',
            'serial_number.unique' => 'This Serial Number already is registered. Try another one',

            'brand.required' => 'The input Brand is required ',
            'brand.min' => 'The Brand is too short. The Brand must be a minimum  of 2 characters',
            'brand.max' => 'The Brand is too big. The Brand must be a maximum of 300 characters',

            'model.required' => 'The input Model is required ',
            'model.min' => 'The Model is too short. The Model must be a minimum  of 2 characters',
            'model.max' => 'The Model is too big. The Model must be a maximum of 300 characters',
            
        ];
    }

}
