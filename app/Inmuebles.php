<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inmuebles extends Model
{
    protected $fillable = [
        'city_id',
        'address',
        'transaction_type',
        'number_habitants',
        'number_baths',
        'number_parking',
        'antiquity',
        'active',
        'created_at','updated_at'
    ];
}