<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerEditFormRequest extends FormRequest
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
            'name' => 'required|min:1|max:275',
            'telephone' => 'required|max:175',
            'email' => 'required|max:300|email',
            'address' => 'required|max:355',
            'image' => 'image'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'The input name is required ',
            'name.min' => 'The name is too short. The name must be a minimum  of 2 characters',
            'name.max' => 'The name is too big. The name must be a maximum of 255 characters',
            'telephone.required' => 'The telephone is required',
            'telephone.min' => 'The telephone must to be longer than 4 characters',
            'telephone.max' => 'The telephone must to be shorter than 175 characters',
            'telephone.required' => 'The contact number is already registered for a client.',
            'email.required' => 'The email is required',
            'email.min' => 'The email must to be longer than 4 characters',
            'email.max' => 'The email must to be shorter than 300 characters',
            'email.email' => 'This input only accepts email',
            'address.required' => 'The address is required',
            'address.min' => 'The address must to be longer than 4 characters',
            'address.max' => 'The address must to be shorter than 355 characters',
            'image.image' => 'Please, this field only choose an valide image'
        ];
    }
}
