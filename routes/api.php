<?php

use App\Http\Controllers\ApiController\AuthController;
use App\Http\Controllers\ApiController\UserProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AppFeedBacksController;
use App\Http\Controllers\BlockUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FollowersController;

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
    Route::post('/posts/addLike', [PostsController::class, 'addLike']);
    // remove like to post
    Route::post('/posts/removeLike', [PostsController::class, 'removeLike']);
    // save post
    Route::post('/posts/savePost', [PostsController::class, 'savePost']);
    // un save post
    Route::post('/posts/unsavePost', [PostsController::class, 'unSavePost']);
    // get saved post
    Route::get('posts/getSavedPosts', [PostsController::class, 'getSavedPosts']);

    // user profiles routes
    Route::post('/profile/myProfile/posts', [UserProfileController::class, 'myPosts']);
    // users anonymous posts
    Route::post('/profile/myProfile/posts/anonymousPosts', [UserProfileController::class, 'myAnonymousPosts']);
    // update my profile
    Route::post('/profile/myProfile/updateMyProfile', [UserProfileController::class, "updateMyProfile"]);
    // change password
    Route::post('/profile/myProfile/changePassword', [UserProfileController::class, 'changePassword']);
    // get other users profile
    Route::post('/profile/userProfile', [UserProfileController::class, 'userProfile']);
    // get other users posts
    Route::post('/profile/userProfile/posts', [UserProfileController::class, 'usersPost']);
    // user serch route
    Route::post('/users/search', [UserProfileController::class, 'searchUserByName']);
    // update user profile picture
    Route::post('/profile/updateProfilePicture', [UserProfileController::class,'updateProfilePicture']);

    //// reports routes

    // report user
    Route::post('/reports/user', [ReportsController::class, 'reportUser']);
    // report comment
    Route::post('/reports/comment', [ReportsController::class, 'reportComment']);
    // report post
    Route::post('/reports/post', [ReportsController::class, 'reportPost']);

    //// comments apis

    // comments routes
    Route::post('/posts/comments/getcomment', [CommentsController::class, 'getAllComments']);

    // add comment
    Route::post('/posts/comments/add', [CommentsController::class, 'addComment']);

    // delete comment
    Route::get("/posts/comments/delete/{id}", [CommentsController::class, 'deleteComment']);

    // like comment
    Route::post("/posts/comments/like", [CommentsController::class, 'likeComment']);

    // dislike comment
    Route::post("/posts/comments/dislike", [CommentsController::class, 'dislikeComment']);

    /// notification

    // add notification
    Route::post('/notifications/add', [NotificationController::class,'addNotification']);

    /// Block User

    // add block user
    Route::post("users/block/add",[BlockUserController::class, 'addBlockUser']);

    // show user
    Route::get("/users/block/showBlockUsers/{id}",[BlockUserController::class, 'showBlockUsers']);

    // unblock user
    Route::post("/users/block/unblock",[BlockUserController::class, 'unblockUser']);

    /// Followers apis

    // get follower count
    Route::get("/followers/followCount/{id}",[FollowersController::class,'getFollowersCount']);

    // send following request
    Route::post("/followers/sendRequest",[FollowersController::class,'sendFollowingRequest']);

    // accept following request
    Route::post("/followers/acceptRequest",[FollowersController::class,'acceptFollowRequest']);

    // remove following request or follower
    Route::post("/followers/removeFollower",[FollowersController::class,"removeRequestOrRemoveFollower"]);


});

// Authenctions routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'signIn']);


