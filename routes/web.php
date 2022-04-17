<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () { return view('start'); })->name('start');

Route::get('/main', 'App\Http\Controllers\AppController@generate')->name('main');
