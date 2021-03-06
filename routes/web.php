<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('clients', ClientController::class);
Route::resource('orders', OrderController::class);
Route::get('/index', 'App\Http\Controllers\OrderController@filterMain')->name('orders.show');
// Route::get('/filter', 'App\Http\Controllers\OrderController@filter')->name('orders.search');
Route::get('/', 'App\Http\Controllers\OrderController@main');
Route::get('exportToExcel', 'App\Http\Controllers\OrderController@export')->name('orders.export');
