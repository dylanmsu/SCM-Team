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

    public function Vehicle_file()
    {
        return $this->hasMany('App\Vehicle_file', 'vehicle_id', 'id');
    }

    public function Vehicle_property()
    {
        return $this->hasMany('App\vehicle_property', 'vehicle_id', 'id');
    }
}
