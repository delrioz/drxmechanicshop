<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    public $table = 'suppliers';
    
    // <!-- serial_number, name, type, specs -->


    //   use Notifiable;

        /**
         * The attributes that are mass assignable.
         *s
        * @var array
        */
        protected $fillable = [
            
            'name', 'location', 'contactNumber', 'contactEmail', 'note'
            
        ];

}
