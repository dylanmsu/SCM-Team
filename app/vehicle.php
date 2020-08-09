<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    protected $fillable = [
        'category',
        'name', 
        'state', 
        'comment', 
        'type'
    ];
}
