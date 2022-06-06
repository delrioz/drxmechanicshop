<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products_machines_workorders extends Model
{
    public $table = 'products_machines_workorders';

    protected $fillable = [
        
        'machine_id', 'product_id', 'quoteReference'
    ];


}
