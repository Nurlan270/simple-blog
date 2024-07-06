<?php

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
