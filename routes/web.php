<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PracticalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Models\News;

Route::get('/', function () {
    $latestNews = News::latest('date')->take(3)->get();
    return view('home', compact('latestNews'));
});

use App\Http\Controllers\TeamController;

Route::get('/team', [TeamController::class, 'index']);
use App\Http\Controllers\AboutController;

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

Route::post('/news/{id}/comment', [NewsController::class, 'comment'])->name('news.comment');
Route::post('/news/{id}/reply', [NewsController::class, 'reply'])->name('news.reply');
use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/practical/{slug}', [PracticalController::class, 'show'])->name('practical.category');
