<?php

namespace App\Http\Controllers\Dragon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DragonController extends Controller
{
    public function index()
    {
        return view('dragon.dragon');
    }
}
