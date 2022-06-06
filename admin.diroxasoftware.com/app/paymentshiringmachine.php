<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paymentshiringmachine extends Model
{
    public $table = "paymentshiringmachine";



    protected $fillable = [
        
        'machineId', 'customerId', 'priceperday', 'discount', 'hiringPrice', 'payOnReturn', 'extracost', 'about', 'totalDaysNumber', 'startHiringDate', 'finishHiringDate', 'firstDepositPrice', '	paymentMethod'
        
    ];
}
