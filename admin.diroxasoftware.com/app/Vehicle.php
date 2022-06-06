<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public $table = 'vehicles';
    
    // <!-- serial_number, name, type, specs -->


    //   use Notifiable;

    /**
     * The attributes that are mass assignable.
     *s
     * @var array
     */
    protected $fillable = [
        
        'plate', 'brand',  'model', 'colour', 'year', 'owner'
        
    ];

}
