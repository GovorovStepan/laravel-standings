<?php

use Illuminate\Support\Facades\Route;

Route::get('/main', 'App\Http\Controllers\AppController@generate')->name('main');
