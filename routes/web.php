<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VersioningController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('versionings.index');
    } else {
        return redirect()->route('login');
    }
});

Route::resource('projects', ProjectController::class);
Route::resource('versionings', VersioningController::class);
Route::resource('users',UserController::class);
// Route::resource('users', UserController::class)
//     ->middleware(isAdmin::class)
//     ->except(['show']);
// Route::get('users/{user}', [UserController::class, 'show'])
//     ->name('users.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
