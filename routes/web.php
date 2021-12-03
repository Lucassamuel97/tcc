<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::resource('/users', 'UserController')->middleware(['auth', 'auth.admin']);

Route::resource('/machines', 'MachinesController')->middleware('auth');

Route::get('/selectMachine', 'MaintenanceController@selectMachine')->middleware('auth');
Route::get('/maintenance/{machine}/create', 'MaintenanceController@create')->middleware('auth');
Route::get('/maintenance/{id}/edit', 'MaintenanceController@edit')->middleware('auth');
Route::get('/maintenance/{machine}/', 'MaintenanceController@index')->middleware('auth');
Route::resource('/maintenance', 'MaintenanceController')->middleware('auth');
Route::get('maintenance/{maintenance}/historic', 'MaintenanceController@historic')->middleware('auth');


Route::post('{machine}/maintenance/accomplish', 'MaintenanceCheckController@accomplish')->middleware('auth');
Route::post('{machine}/maintenance/postpone', 'MaintenanceCheckController@postpone')->middleware('auth');

Route::resource('/{machine}/maintenanceCheck', 'MaintenanceCheckController')->middleware('auth');

Route::resource('/updateHodometro', 'UpdateHodometroController')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');



