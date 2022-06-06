<?php

namespace App\Http\Requests\Internal;

use Illuminate\Foundation\Http\FormRequest;

class CustomerFormRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|min:2|max:275',
            'telephone' => 'max:175|unique:customers',
            'email' => 'max:300|',
            'address' => 'max:355',
            'image' => 'image',
            'idimage' => 'image',
            'proofOfAddress' => 'image'
        ];
    }


    public function messages()
    {
        return[
            'name.required' => 'The input name is required ',
            'name.min' => 'The name is too short. The name must be a minimum  of 2 characters',
            'name.max' => 'The name is too big. The name must be a maximum of 255 characters',
            'telephone.required' => 'The contact number is required',
            'telephone.min' => 'The contact number must to be longer than 4 characters',
            'telephone.max' => 'The contact number must to be shorter than 175 characters',
            'telephone.unique' => 'The contact number is already registered for a client.',

            'email.required' => 'The email is required',
            'email.min' => 'The email must to be longer than 4 characters',
            'email.max' => 'The email must to be shorter than 300 characters',
            'email.email' => 'This input only accepts email',
            'email.unique' => 'There is someone else using the same email, please choose another one',
            'address.required' => 'The address is required',
            'address.min' => 'The address must to be longer than 4 characters',
            'address.max' => 'The address must to be shorter than 355 characters',
            'image.image' => 'Please, this field only accept image',
            'idimage.idimage' => 'Please, this field only accept image',
            'proofOfAddress.proofOfAddress' => 'Please, this field only accept image'
        ];
    }
}
