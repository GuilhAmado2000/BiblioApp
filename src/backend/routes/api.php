<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\TypeBookController;
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

    Route::prefix('author')->group(function () {
        Route::get('/', [AuthorController::class, 'index'])
            ->name('author.all');
    });

    Route::prefix('publisher')->group(function () {
        Route::get('/', [PublisherController::class, 'index'])
            ->name('publisher.all');
    });

    Route::prefix('language')->group(function () {
        Route::get('/', [LanguageController::class, 'index'])
            ->name('language.all');
    });

    Route::prefix('type')->group(function () {
        Route::get('/', [TypeBookController::class, 'index'])
            ->name('type.all');
    });

    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])
            ->name('category.all');
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

