<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ArticleController;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider and all of them will | be assigned to the "web" middleware group. Make something great! | */

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');

    Route::get('/articles/create', [UserController::class , 'create'])->name('articles.create');
    Route::post('/articles', [UserController::class , 'store'])->name('articles.store');
    Route::get('/dashboard', [UserController::class , 'index'])->name('dashboard');
    Route::get('/articles/{article}/edit', [UserController::class , 'edit'])->name('articles.edit');
    Route::post('/articles/{article}/update', [UserController::class , 'update'])->name('articles.update');
    Route::get('/articles/{article}/remove', [UserController::class , 'remove'])->name('articles.remove');
    Route::post('/comments', [CommentController::class , 'store'])->name('comments.store');
    Route::post('/articles/{article}/like', [ArticleController::class , 'like'])->name('article.like');
});

require __DIR__ . '/auth.php';

Route::middleware('web')->group(function () {
    Route::get('/{user}', [PublicController::class, 'index'])->name('public.index');
    Route::get('/{user}/{article}', [PublicController::class, 'show'])->name('public.show');
});
