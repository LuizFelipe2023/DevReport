<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VersioningController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('versionings.index') : redirect()->route('login');
});

Route::resource('projects', ProjectController::class)->middleware(['auth']);
Route::resource('versionings', VersioningController::class)->middleware(['auth']);

Route::resource('users', UserController::class)
    ->middleware(isAdmin::class)
    ->except(['show']);
Route::get('users/{user}', [UserController::class, 'show'])
    ->middleware('auth')
    ->name('users.show');

Auth::routes();
