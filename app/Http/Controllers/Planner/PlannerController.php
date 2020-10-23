<?php

namespace App\Http\Controllers\Planner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth' , ['except' => ['planner']]);
    }
    
    public function planner()
    {
        return view('planner.planner');
    }
}