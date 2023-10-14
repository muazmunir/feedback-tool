<?php

use App\Http\Controllers\Admin\FeedbackItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\Admin\UserController;
use App\Providers\RouteServiceProvider;
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

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::get('/admin', function () {
    return redirect()->intended(RouteServiceProvider::AdminDashboard);
});

Route::middleware('auth','verified','user-access:admin')->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');
    Route::get('/users/dataTable', [UserController::class,'dataTable'])->name('users.dataTable');
    Route::resource('users', UserController::class);
    Route::get('/feedback-items/dataTable', [FeedbackItemController::class,'dataTable'])->name('feedback-items.dataTable');
    Route::resource('feedback-items', FeedbackItemController::class);
});

Route::middleware('auth','user-access:user')->group(function () {
    Route::controller(FeedbackController::class)->name('feedback')->group(function () {
        Route::get('home','showFeedbackForm')->name('.form');
        Route::post('feedback', 'store')->name('.store');
        Route::get('feedbacks', 'feedbacks')->name('.all');
        Route::get('feedbacks/{slug}', 'getfeedback');
        Route::get('feedback/{feedbackId}/vote-count','getVoteCount')->name('.count');
    });
    Route::controller(CommentController::class)->name('comments')->group(function () {
        Route::get('comments/{feedback}','index')->name('.index');
        Route::post('comments', 'store')->name('.store');
    });
    Route::controller(VoteController::class)->name('feedback')->group(function () {
        Route::post('/feedback/{feedback}/upvote','upvote')->name('.upvote');
        Route::post('/feedback/{feedback}/downvote','downvote')->name('.downvote');
    });
});
