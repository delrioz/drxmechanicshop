<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $table = 'services';

    //   use Notifiable;

    /**
     * The attributes that are mass assignable.
     *s
     * @var array
     */
    protected $fillable = [
        
        'name', 'type', 'about', 'client', 'machineName'
        
    ];

}
