<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    public $table = "sales";

    protected $fillable = [
        
        'sales_price', 'sales_subtotal', 'sales_discount', 'sales_vat', 'methodPayment', 'sales_vat', 'paymentsOptions', 'Npayments',
        'todayDate', 'chooseCustomer', 'firstAmountPaid', 'status', 'totalToBePaid', 'NpaymentsLeft', 'upfrontValue'
        
    ];
}
