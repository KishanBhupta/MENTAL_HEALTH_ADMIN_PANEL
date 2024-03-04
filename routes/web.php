<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AppFeedbacksController;
use App\Http\Controllers\AdminController;
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
Route::get('/adminlogin',function() {
    return view('layouts.admin.adminlogin');
});

Route::get('/adminlogin',[AdminController::class,'adlogin'])->name("adlogin");
Route::get('/admincomplete',[AdminController::class,'getData'])->name("getData");
Route::post('/admincomplete', [AdminController::class, 'getData'])->name('admincomplete');
Route::get('/adminlogin', [AdminController::class, 'logout'])->name('logout');


//route to return index page ( Dashboard )
Route::get('/',[DashboardController::class,'index']);
//reports page
Route::get('/reports',[ReportsController::class,'index']);


Route::get('/admin', function () {
    return view('layouts.admin.home');
});

Route::prefix('admin')->group(function () {
    Route::get('/profile/show', [AdminProfileController::class, 'show'])->name('admin.profile.show');
    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});


Route::get('admin/feedbacks', [AppFeedbacksController::class, 'index'])->name('admin.feedback.index');

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


