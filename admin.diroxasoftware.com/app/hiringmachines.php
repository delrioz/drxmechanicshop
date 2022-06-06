<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hiringmachines extends Model
{
    //

    public $table = "hiringmachines";
    
    protected $fillable = [
        
        'priceperhour', 'startHiringDate', 'finishHiringDate', 'totalDaysNumber', 'hiringPrice', 'vatAmount', 'firstDepositPrice', 'machineId', 'customerId', 'about', 'created_at', 'updated_at', 'discount'
    ];
}
