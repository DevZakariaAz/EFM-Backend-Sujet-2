<?php

use Modules\Blog\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

// Dashboard Route
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('articles', ArticleController::class);
