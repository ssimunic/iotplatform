<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');

Route::get('/data', 'DataController@addData')->name('addData')->middleware('auth');

Route::get('/charts', 'ChartController@showAll')->name('charts')->middleware('auth');
Route::post('/charts', 'ChartController@addChart')->name('addChart')->middleware('auth');
Route::get('/charts/{id}', 'ChartController@viewChart')->name('viewChart');
Route::get('/charts/delete/{id}', 'ChartController@deleteChart')->name('deleteChart')->middleware('auth');
Route::get('/charts/edit/{id}', 'ChartController@showEditChart')->name('showEditChart')->middleware('auth');
Route::post('/charts/edit/{id}', 'ChartController@editChart')->name('editChart')->middleware('auth');

Route::post('/charts/fields/{id}', 'ChartFieldController@addChartField')->name('addChartField')->middleware('auth');
Route::get('/charts/fields/delete/{id}', 'ChartFieldController@deleteChartField')->name('deleteChartField')->middleware('auth');

Route::get('/devices', 'DeviceController@showAll')->name('devices')->middleware('auth');
Route::post('/devices', 'DeviceController@addDevice')->name('addDevice')->middleware('auth');
Route::get('/devices/{id}', 'DeviceController@showEditDevice')->name('showEditDevice')->middleware('auth');
Route::post('/devices/{id}', 'DeviceController@editDevice')->name('editDevice')->middleware('auth');
Route::get('/devices/delete/{id}', 'DeviceController@deleteDevice')->name('deleteDevice')->middleware('auth');

Route::get('/devices/fields/{id}', 'DeviceFieldController@showDeviceFields')->name('showDeviceFields')->middleware('auth');
Route::post('/devices/fields/{id}', 'DeviceFieldController@addDeviceFields')->name('addDeviceFields')->middleware('auth');
Route::get('/devices/fields/delete/{id}', 'DeviceFieldController@deleteDeviceFields')->name('deleteDeviceFields')->middleware('auth');
Route::get('/devices/fields/reset/{id}', 'DeviceFieldController@resetDeviceFields')->name('resetDeviceFields')->middleware('auth');

Route::get('/devices/triggers/{id}', 'TriggerController@showDeviceTriggers')->name('showDeviceTriggers')->middleware('auth');
Route::post('/devices/triggers/{id}', 'TriggerController@addDeviceTriggers')->name('addDeviceTriggers')->middleware('auth');
Route::get('/devices/triggers/delete/{id}', 'TriggerController@deleteDeviceTrigger')->name('deleteDeviceTriggers')->middleware('auth');
Route::get('/devices/triggers/edit/{id}', 'TriggerController@showEditDeviceTrigger')->name('showEditDeviceTrigger')->middleware('auth');
Route::post('/devices/triggers/edit/{id}', 'TriggerController@editDeviceTrigger')->name('editDeviceTrigger')->middleware('auth');
