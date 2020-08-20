<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function settings(Request $request)
    {
        $user = auth()->user();
        $user->theme = $request->get('theme');
        $status = $user->save();

        if ($status) {
            return redirect()->route('home')->with('success', "Successfully Submitted!");
        } else {
            return redirect()->route('home')->with('error', "Something went wrong.");
        }
    }
}
