<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\StartController@getList')->name('start');

Route::get('/generation/{id}', 'App\Http\Controllers\GenerationController@show');

Route::get('/main', 'App\Http\Controllers\AppController@generate')->name('main');
