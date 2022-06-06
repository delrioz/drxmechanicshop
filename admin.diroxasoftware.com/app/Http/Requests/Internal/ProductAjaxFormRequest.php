<?php

namespace App\Http\Requests\Internal;

use Illuminate\Foundation\Http\FormRequest;

class ProductAjaxFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'Formname' => 'required|min:2|max:300',
            'FormSKU' => 'max:300',
            'Formbrand' => 'max:300',
            'FormSell_Price' => 'required|numeric|min:0',
            'FormSell_PriceVat' => 'required|numeric|min:0',
            'FormCost_Price' => 'required|numeric|min:0',
            'Formquantity' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return[
            'Formname.required' => 'The input name is required ',
            'Formname.min' => 'The name is too short. The name must be a minimum  of 2 characters',
            'Formname.max' => 'The name is too big. The name must be a maximum of 300 characters',

            'FormSKU.required' => 'The SKU is required',
            'FormSKU.min' => 'The SKU must to be longer than 2 characters',
            'FormSKU.max' => 'The SKU must to be shorter than 300 characters',
            'FormSKU.unique' => 'There is another product using the same SKU, please choose another one',

            'Formbrand.required' => 'The brand is required',
            'Formbrand.min' => 'The brand must to be longer than 1 characters',
            'Formbrand.max' => 'The brand must to be shorter than 300 characters',

            'image.image' => 'Please, this field only accept image',
            'image.required' => 'The field image is REQUIRED',
            
            'FormSell_Price.required' => 'The Sell Price is required',
            'FormSell_Price.number' => 'The Sell Price must to be a number',
            'FormSell_Price.min' => 'The Sell Price must to be longer than 1 characters',


            'FormSell_PriceVat.required' => 'The Sell Price Vat is required',
            'FormSell_PriceVat.number' => 'The Sell Price Vat must to be a number',
            'FormSell_PriceVat.min' => 'The Sell Price Vat must to be longer than 1 characters',
            

            'FormCost_Price.required' => 'The Cost Price is required',
            'FormCost_Price.number' => 'The Cost Price must to be a number',
            'FormCost_Price.min' => 'The Cost Price must to be longer than 1 characters',

            'Formquantity.required' => 'The quantity is required',
            'Formquantity.number' => 'The quantity must to be a number',

        ];
    }
}
