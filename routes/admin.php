<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'admin/dashboard');

Route::view('dashboard', 'admin.dashboard')
    ->name('dashboard');

//      Users
Route::get('users', [UsersController::class, 'index'])
    ->name('users.index');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit');

Route::patch('users/{user}', [UsersController::class, 'update'])
    ->name('users.update');

Route::delete('users/{user}', [UsersController::class, 'delete_one_user'])
    ->name('users.delete_one_user');

Route::delete('users', [UsersController::class, 'delete_selected_users'])
    ->name('users.delete_selected_users');


//      Posts
Route::get('posts', [PostsController::class, 'index'])
    ->name('posts.index');

Route::delete('posts/{post}', [PostsController::class, 'delete_one_post'])
    ->name('posts.delete_one_post');

Route::delete('posts', [PostsController::class, 'delete_selected_posts'])
    ->name('posts.delete_selected_posts');

//      Comments
Route::get('comments', [CommentController::class, 'index'])
    ->name('comments.index');

Route::delete('comments/{comment}', [CommentController::class, 'delete_one_comment'])
    ->name('comments.delete_one_comment');

Route::delete('comments', [CommentController::class, 'delete_selected_comments'])
    ->name('comments.delete_selected_comments');
