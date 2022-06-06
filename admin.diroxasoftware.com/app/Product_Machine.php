<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Machine extends Model
{
    public $table = 'products_machines';
    
    // <!-- serial_number, name, type, specs -->


    //   use Notifiable;

    /**
     * The attributes that are mass assignable.
     *s
     * @var array
     */
    protected $fillable = [
        
        'id', 'machine_id', 'product_id'
        
    ];

}
