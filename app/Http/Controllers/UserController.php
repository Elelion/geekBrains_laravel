<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // return view();
    }

    public function feedback()
    {
        return view('user.feedback');
    }

    public function check(Request $request)
    {
        dd($request);
    }
}
