<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use Illuminate\Http\Request;

Route::get('/login', function (Request $request) {
    return response()->json(['message' => 'Unauthorized. Please log in.'], 401);
})->name('login');
