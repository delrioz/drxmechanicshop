<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class latepaymentssalesinvoices extends Model
{
    public $table = "latepaymentssalesinvoices";

    protected $fillable = [
        
          'salesReference','AmountPaid', 'PaymentMethod', 'PaymentOption', 'customerReference', 'invoiceNumber'
        
    ];
}
