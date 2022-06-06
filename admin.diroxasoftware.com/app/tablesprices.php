<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tablesprices extends Model
{
    public $table = "tablesprices";


    protected $fillable = [

          'name', 'about', 'Sell_Price', 'Sell_PriceVat'

    ];
}
