<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productsales_payments extends Model
{
    public $table = 'productsales_payments';

    protected $fillable = [
        
        'typeofpayment','discount', 'total', 'totalWithVAT', 'totalWithoutVAT', 'salesId'
        
    ];

}
