<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle_file extends Model
{
    protected $fillable = [
        'url', 
        'type', 
        'description',
        'name',
        'vehicle_id'
    ];
}
