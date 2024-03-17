<?php

use App\Http\Controllers\ApiController\AuthController;
use App\Http\Controllers\ApiController\UserProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AppFeedBacksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentsController;

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

Route::group(["middleware" => "auth:api"], function () {

    Route::get('/getLoggedInUser', [AuthController::class, 'login']);

    // feedback routes
    Route::post('/feedBack/storeFeedback', [AppFeedBacksController::class, 'storeFeedback']);

    // posts routes
    Route::post('/posts/createPost', [PostsController::class, 'createPost']);
    // get posts
    Route::get('/posts/getpost', [PostsController::class, 'getPost']);
    // delete posts
    Route::get('/posts/deletePost/{id}', [PostsController::class, 'deletePost']);
    // add like to post
    Route::get('/posts/addLike/{id}', [PostsController::class, 'addLike']);
    // remove like to post
    Route::get('/posts/removeLike/{id}', [PostsController::class, 'removeLike']);
    // save post
    Route::post('/posts/savePost', [PostsController::class,'savePost']);
    // un save post
    Route::post('/posts/unsavePost', [PostsController::class, 'unSavePost']);
    // get saved post
    Route::get('posts/getSavedPosts',[PostsController::class,'getSavedPosts']);

    // user profiles routes
    Route::post('/profile/myProfile/posts',[UserProfileController::class, 'myPosts']);
    // users anonymous posts
    Route::post('/profile/myProfile/posts/anonymousPosts',[UserProfileController::class,'myAnonymousPosts']);
    // update my profile
    Route::post('/profile/myProfile/updateMyProfile',[UserProfileController::class,"updateMyProfile"]);
    // change password
    Route::post('/profile/myProfile/changePassword',[UserProfileController::class,'changePassword']);
    // get other users profile 
    Route::post('/profile/userProfile',[UserProfileController::class, 'userProfile']);
    // get other users posts
    Route::post('/profile/userProfile/posts',[UserProfileController::class, 'usersPost']);

});

// Authenctions routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'signIn']);

// comments routes

Route::get('/getcomment', [CommentsController::class, 'getAllComments']);


// comments routes
