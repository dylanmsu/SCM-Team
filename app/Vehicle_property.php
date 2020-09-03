<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle_property extends Model
{
    protected $fillable = [
        'key', 
        'value', 
        'vehicle_id'
    ];
}
