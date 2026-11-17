<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/submit-name', function () {
    return view('submit-name'); // Or return a simple string
});

Route::post('/submit-name', function (Request $request) {
    $submittedName = $request->input('username');
    return view('welcome', ['name' => $submittedName]);
});