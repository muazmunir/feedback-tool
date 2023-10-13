<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\VoteController;
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
});

Route::middleware('auth','user-access:user')->group(function () {
    Route::get('/home', [FeedbackController::class,'showFeedbackForm'])->name('feedback.form');
    Route::post('/feedback', [FeedbackController::class,'storeFeedback'])->name('feedback.store');
    Route::get('/feedbacks', [FeedbackController::class,'feedbacks'])->name('feedback.all');
    Route::get('/feedbacks/{slug}', [FeedbackController::class,'getfeedback'])->name('feedback');
    Route::post('/comments', [CommentController::class,'store'])->name('comments.store');
    Route::get('/comments/{feedback}', [CommentController::class,'index'])->name('comments.index');
    Route::post('/feedback/{feedback}/upvote', [VoteController::class,'upvote'])->name('feedback.upvote');
    Route::post('/feedback/{feedback}/downvote', [VoteController::class,'downvote'])->name('feedback.downvote');
});
