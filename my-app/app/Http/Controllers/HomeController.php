<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
        $username = "Developer";
        return view('profile', ['name' => $username]);
    }
}