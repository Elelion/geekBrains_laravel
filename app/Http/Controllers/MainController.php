<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function info()
    {
        return view('info');
    }

    public function news()
    {
        return view('news');
    }
}
