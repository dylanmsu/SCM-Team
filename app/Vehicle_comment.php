<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle_comment extends Model
{
    protected $fillable = [
        'remarks', 
        'state', 
        'creator', 
        'editor'
    ];

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'creator');
    }
}
