<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    public $table = 'machines';

    // <!-- serial_number, name, type, specs -->


    //   use Notifiable;

    /**
     * The attributes that are mass assignable.
     *s
     * @var array
     */
    protected $fillable = [

        'serial_number', 'brand',  'model', 'owner', 'customer_report', 'mileage','observations'

    ];

}
