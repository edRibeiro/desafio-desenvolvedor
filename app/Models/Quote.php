<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;



    protected $fillable = [
        'conversion_amount',
        'name',
        'currency_origin',
        'currency_name',
        'payment_method',
        'fee',
        'currency_value',
        'payment_rate',
        'conversion_rate',
        'conversion_fee',
        'conversion_value',
        'converted_amount',
        'user_id'
    ];

    function calc()
    {
    }
}
