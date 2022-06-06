<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class internalmachines extends Model
{
    public $table = 'internalmachines';

    // <!-- serial_number, name, type, specs -->



    protected $fillable = [

        'serial_number', 'brand',  'model', 'image', 'valueMachine', 'condition', 'CostMachine'

    ];

}
