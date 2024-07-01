<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\UserPostController;
use Illuminate\Support\Facades\Route;

//      Home
Route::get('/', [PostController::class, 'index'])->name('home');

//      Register
Route::controller(RegisterController::class)
    ->name('register')
    ->middleware(['guest'])
    ->group(function () {
        Route::get('register', 'create');
        Route::post('register', 'store')->name('.store');
    });

//      Login
Route::controller(LoginController::class)
    ->name('login')
    ->middleware(['throttle:login', 'guest'])
    ->group(function () {
        Route::get('login', 'create');
        Route::post('login', 'authenticate')->name('.authenticate');
    });

//      Logout
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

//      Account
Route::controller(AccountController::class)
    ->name('account')
    ->prefix('account/panel/')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')->name('.panel');
        Route::match(['GET', 'PATCH'], 'update-name', 'updateName')->name('.updateName');
        Route::match(['GET', 'PATCH'], 'update-pass', 'updatePassword')->name('.updatePassword');
        Route::match(['GET', 'DELETE'], 'delete-account', 'deleteAccount')->name('.deleteAccount');
    });

//      Posts
Route::resource('posts', PostController::class)
    ->only(['index', 'show']);

//      User posts
Route::resource('user/posts', UserPostController::class)
    ->names('user.posts')
    ->middleware('auth');