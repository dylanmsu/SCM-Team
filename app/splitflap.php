<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Splitflap extends Model
{
    protected $fillable = [
        'board', 
        'align', 
        'first_text', 
        'second_text', 
        'icon_index', 
        'time',
        'user'
    ];
}
