<?php

namespace App\Http\Controllers\Elliott;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ElliottController extends Controller
{
    public function index()
    {
        return view('elliott.elliott');
    }
}
