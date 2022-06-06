<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products_on_workorders extends Model
{
    public $table = 'products_on_workorders';


    protected $fillable = [
        
        'name','SKU', 'category', 'brand', 'image', 'Sell_Price ', 'Sell_PriceVat', 'Cost_Price', 'quantity', 'workOrderReference'
        
    ];
    
}
