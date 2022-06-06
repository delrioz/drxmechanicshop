<?php

namespace App\Http\Requests\Internal;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|min:2|max:300',
            'SKU' => 'max:300',
            'brand' => 'max:300',
            'image' => 'image',
            'Sell_Price' => 'required|numeric|min:0',
            'Cost_Price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric',
            'about' => 'max:500'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'The input name is required ',
            'name.min' => 'The name is too short. The name must be a minimum  of 2 characters',
            'name.max' => 'The name is too big. The name must be a maximum of 300 characters',

            'SKU.required' => 'The SKU is required',
            'SKU.min' => 'The SKU must to be longer than 2 characters',
            'SKU.max' => 'The SKU must to be shorter than 300 characters',
            'SKU.unique' => 'There is another product using the same SKU, please choose another one',

            'brand.required' => 'The brand is required',
            'brand.min' => 'The brand must to be longer than 1 characters',
            'brand.max' => 'The brand must to be shorter than 300 characters',

            'image.image' => 'Please, this field only accept image',
            'image.required' => 'The field image is REQUIRED',
            
            'Sell_Price.required' => 'The Sell Price is required',
            'Sell_Price.number' => 'The Sell Price must to be a number',
            'Sell_Price.min' => 'The Sell Price must to be longer than 1 characters',
            
            'Sell_PriceVat.required' => 'The Sell Price Vat is required. Maybe the page doesnt load correctly. Please try put the Sell Price again',

            'Cost_Price.required' => 'The Cost Price is required',
            'Cost_Price.number' => 'The Cost Price must to be a number',
            'Cost_Price.min' => 'The Cost Price must to be longer than 1 characters',

            'quantity.required' => 'The quantity is required',
            'quantity.number' => 'The quantity must to be a number',



            'about.required' => 'The about is required',
            'about.min' => 'The about must to be longer than 4 characters',
            'about.max' => 'The about must to be shorter than 500 characters',
        ];
    }
}
