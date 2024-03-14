<?php

use App\Http\Controllers\ApiController\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'signIn']);
Route::get('/getLoggedInUser',[AuthController::class, 'login'])->middleware('auth:api');
// Route::get('/getfeedback',[AuthController::class, 'getfeedback']);
Route::post('/storeFeedback',[AuthController::class, 'storeFeedback']);

