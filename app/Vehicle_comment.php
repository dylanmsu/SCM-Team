<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle_comment extends Model
{
    protected $fillable = [
        'vehicle_id',
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
