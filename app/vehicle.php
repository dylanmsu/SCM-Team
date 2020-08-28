<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'category',
        'name', 
        'state', 
        'type'
    ];

    public function Vehicle_comment()
    {
        return $this->hasMany('App\Vehicle_comment', 'vehicle_id', 'id');
    }

    /*
    public function Vehicle_specification()
    {
        return $this->hasMany('App\Vehicle_specification', 'vehicle_id', 'id');
    }*/
}
