<?php

use App\Http\Controllers\ApiController\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AppFeedBacksController;
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

// Authenctions routes

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'signIn']);
Route::get('/getLoggedInUser',[AuthController::class, 'login'])->middleware('auth:api');

// feedback routes

// Route::get('/getfeedback',[AppFeedBacksController::class, 'getfeedback']);
Route::post('/storeFeedback',[AppFeedBacksController::class, 'storeFeedback'])->middleware('auth:api');

// posts routes

Route::get('/getpost',[PostsController::class, 'getPost'])->middleware('auth:api');
Route::post('/createPost',[PostsController::class, 'createPost'])->middleware('auth:api');
Route::get('/deletePost/{id}',[PostsController::class, 'deletePost']);

// comments routes

Route::get('/getcomment',[CommentsController::class,'getAllComments']);


// comments routes


