<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public $table = 'quotes';

    //   use Notifiable;

    /**
     * The attributes that are mass assignable.
     *s
     * @var array
     */
    protected $fillable = [
        
        'title', 'customer_report', 'first_observations', 'last_observations', 'customer', 'machine', 'status'
        
    ];
}
