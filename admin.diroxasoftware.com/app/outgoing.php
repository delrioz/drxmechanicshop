<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class outgoing extends Model
{
      public $table = 'outgoing';

    // <!-- serial_number, name, type, specs -->


    //   use Notifiable;

    /**
    * The attributes that are mass assignable.
    *s
    * @var array
    */
    protected $fillable = [

       'name', 'code', 'outgoingCategory', 'brand', 'Cost_Price', 'quantity',  'condition', 'about'

    ];
}
