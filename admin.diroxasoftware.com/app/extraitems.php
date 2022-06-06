<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class extraitems extends Model
{
    public $table = 'extraitems';
    
    // <!-- serial_number, name, type, specs -->


    //   use Notifiable;

    /**
     * The attributes that are mass assignable.
     *s
     * @var array
     */
    protected $fillable = [
        
        'name', 'Sell_Price', 'Sell_PriceVat', 'about', 'condition', 'quoteId', 'workOrderId'
        
    ];

}
