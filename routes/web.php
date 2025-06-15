<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
});
use App\Http\Controllers\TeamController;

Route::get('/team', [TeamController::class, 'index']);
use App\Http\Controllers\AboutController;

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

Route::post('/news/{id}/comment', [NewsController::class, 'comment'])->name('news.comment');
Route::post('/news/{id}/reply', [NewsController::class, 'reply'])->name('news.reply');
