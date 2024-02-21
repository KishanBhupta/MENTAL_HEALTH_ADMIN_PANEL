<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* admin routes starts */
//route to return index page ( Dashboard )
Route::get('/',[DashboardController::class,'index']);
//reports page
Route::get('/reports',[ReportsController::class,'index']);