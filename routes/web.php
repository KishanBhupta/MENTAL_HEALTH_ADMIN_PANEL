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
/// manage report routes
// manage user report routes
Route::get('/approveUserReport/{id}',[ReportsController::class,'approveUserReport']);
Route::get('/deleteUserReport/{id}',[ReportsController::class,'deleteUserReport']);
Route::get('/unblockUserReport/{id}',[ReportsController::class,'unblockUserReport']);
// manage post report routes
Route::get('/approvePostReport/{id}',[ReportsController::class,'approvePostReport']);
Route::get('/deletePostReport/{id}',[ReportsController::class,'deletePostReport']);
// manage comment report routes
Route::get('/approveCommentReport/{id}',[ReportsController::class,'approveCommentReport']);
Route::get('/deleteCommentReport/{id}',[ReportsController::class,'deleteCommentReport']);