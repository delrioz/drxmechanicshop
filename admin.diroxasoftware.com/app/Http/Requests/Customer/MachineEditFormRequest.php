<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class MachineEditFormRequest extends FormRequest
{
 
    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [
                'brand' => 'required|min:1|max:300',
                'model' => 'required|min:1:max:300',
                'owner' => 'required|min:1|max:300',
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
            'model.min' => 'The Model is too short. The Model must be a minimum  of 4 characters',
            'model.max' => 'The Model is too big. The Model must be a maximum of 300 characters',
            
            'owner.required' => 'The input Owner is required ',
            'owner.min' => 'The Owner is too short. The Owner must be a minimum  of 4 characters',
            'owner.max' => 'The Owner is too big. The Owner must be a maximum of 300 characters',

            'customer_report.required' => 'The input Customer Report is required ',
            'customer_report.min' => 'The Customer Report is too short. The Customer Report must be a minimum  of 4 characters',
            'customer_report.max' => 'The customer Report is too big. The customer Report must be a maximum of 500 characters',
            
            'first_observations.required' => 'The input First Observations Report is required ',
            'first_observations.min' => 'The First Observations Report is too short. The First Observations Report must be a minimum  of 4 characters',
            'first_observations.max' => 'The First Observations Report is too big. The First Observations Report must be a maximum of 500 characters',

           
        ];
    }
}
