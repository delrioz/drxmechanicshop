<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'products';
    
    // <!-- serial_number, name, type, specs -->


    //   use Notifiable;

    /**
     * The attributes that are mass assignable.
     *s
     * @var array
     */
    protected $fillable = [
        
        'name', 'SKU', 'category', 'brand', 'image', 'Sell_Price', 'Sell_PriceVat', 'Cost_Price', 'quantity', 'about', 'machine_id', 'condition'
        
    ];


}
