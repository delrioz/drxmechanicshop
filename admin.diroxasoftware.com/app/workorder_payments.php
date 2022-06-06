<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class workorder_payments extends Model
{
    public $table = 'workorder_payments';

    protected $fillable = [
        
        'amount', 'machineId', 'typeofpayment', 'discount', 'workOrderReference', 'worklabor'
        
    ];

}
