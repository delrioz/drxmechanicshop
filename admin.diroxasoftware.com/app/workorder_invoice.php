<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class workorder_invoice extends Model
{
    public $table = 'workorder_invoice';


    protected $fillable = [
        
        'machineId','quoteReference', 'workOrderReference'
        
    ];
}
