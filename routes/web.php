<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::resource('/users', 'UserController')->middleware(['auth', 'auth.admin']);

Route::resource('/machines', 'MachinesController')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');



