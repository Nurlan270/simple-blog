<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'admin/dashboard');

Route::get('dashboard', [AdminController::class, 'dashboard'])
    ->name('dashboard');
