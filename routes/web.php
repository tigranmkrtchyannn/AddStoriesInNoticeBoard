<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/registration', function () {
    return view('registration');
});
Route::post('/registration-user', [AuthController::class,'registration']);
Route::get('/login', function () {
    return view('login');
});
Route::post('/login-user', [AuthController::class,'login'])->name('login');

Route::group(['middleware' => ['admin']], function () {
Route::get('/add-story',[StoryController::class,'create'])->name('addStory');
Route::post('/store-story', [StoryController::class, 'store']);
Route::get('/stories/approve/{token}', [StoryController::class, 'approve'])->name('story-approval');
Route::get('/notice-board',[StoryController::class,'index'])->name('noticeBoard');
Route::get('/get-new-approved-stories', [StoryController::class, 'getNewApprovedStories'])->name('newApprovedStories');
});
