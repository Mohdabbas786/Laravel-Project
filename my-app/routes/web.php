<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome', ['name' => 'Developer']);
});

Route::post('/submit-name', function (Request $request) {
    $submittedName = $request->input('username');
    return view('welcome', ['name' => $submittedName]);
});