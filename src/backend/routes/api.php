<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/users/create', [UserController::class, 'create'])
    ->name('users.create');

Route::middleware('auth:api')->group(function () {
    Route::prefix('book-management')->group(function () {

        Route::get('/{userId}', [BookController::class, 'getBookByUserId'])
           ->name('book-management.show');
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

