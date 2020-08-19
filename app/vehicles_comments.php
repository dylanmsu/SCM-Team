<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicles_comments extends Model
{
    protected $fillable = [
        'id_vehicle',
        'remarks', 
        'state', 
        'creator', 
        'editor'
    ];
}
