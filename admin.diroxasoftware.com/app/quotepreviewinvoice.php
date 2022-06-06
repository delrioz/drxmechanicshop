<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quotepreviewinvoice extends Model
{
    public $table = 'quotepreviewinvoice';



    protected $fillable = [
        
        'amount','machineId', 'typeofpayment', 'discount', 'quoteReference', 'worklabor', 'total', 'totalWithVAT', 'vat', 'amountProducts', 'amoutwkwithoutprods', 'created_at'
        
    ];


}


