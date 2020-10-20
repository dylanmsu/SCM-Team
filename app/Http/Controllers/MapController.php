<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth' , ['except' => ['trainmap']]);
    }
    
    public function trainmap() 
    {
        return view('trainmap');
    }
}
