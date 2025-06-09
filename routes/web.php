<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

//Auth::routes(['verify' => true]);

Route::get('/test-db', function () {
    $tables = DB::select('SHOW TABLES');
    return response()->json($tables);
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
