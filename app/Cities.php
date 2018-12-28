<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $fillable = [
        'name','created_at','updated_at'
    ];
}
