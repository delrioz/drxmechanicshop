<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    public $table = 'work_order';

    //   use Notifiable;

    /**
     * The attributes that are mass assignable.
     *s
     * @var array
     */
    protected $fillable = [

        'title', 'customer_report',  'mileage', 'last_observations', 'customer', 'machine', 'status', 'typeofpayment', 'discount', 'worklabor'

    ];
}
