<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productsSales extends Model
{
    public $table = 'products_sales';

    protected $fillable = [
        
        'name', 'SKU', 'category', 'brand', 'image', 'Sell_Price', 'Cost_Price', 'quantity', 'about', 'machines', 'sales_price',  'sales_discount', 'sales_vat', 'methodPayment', 'salesId', 'totalSalesWithoutVat', 'totalSalesWithVat', 'totalSalesDiscount'
        
    ];
}
