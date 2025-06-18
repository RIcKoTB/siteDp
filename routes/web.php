<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\EducationalProgramController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\PracticalController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;

use App\Models\News;

Route::get('/', function () {
    // Отримуємо останні новини для головної сторінки
    $latestNews = News::latest('date')->take(3)->get();

    // Якщо немає новин в базі, створюємо тестові
    if ($latestNews->isEmpty()) {
        $latestNews = collect([
            (object)[
                'id' => 1,
                'title' => 'Відкриття нової комп\'ютерної лабораторії',
                'date' => '2025-06-15',
                'img_url' => '/storage/images/gallery/placeholder.svg'
            ],
            (object)[
                'id' => 2,
                'title' => 'Студенти перемогли в олімпіаді з програмування',
                'date' => '2025-06-10',
                'img_url' => '/storage/images/gallery/placeholder.svg'
            ],
            (object)[
                'id' => 3,
                'title' => 'Нові курси підвищення кваліфікації',
                'date' => '2025-06-05',
                'img_url' => '/storage/images/gallery/placeholder.svg'
            ]
        ]);
    }

    // Отримуємо фото для альбому (перші 4 активні)
    $galleryPhotos = \App\Models\Gallery::active()->ordered()->take(4)->get();

    // Отримуємо налаштування контактів
    $contactSettings = \App\Models\ContactSetting::all()->pluck('value', 'key')->toArray();

    return view('home', compact('latestNews', 'galleryPhotos', 'contactSettings'));
})->name('home');

use App\Http\Controllers\TeamController;

Route::get('/team', [TeamController::class, 'index']);
use App\Http\Controllers\AboutController;

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

Route::post('/news/{id}/comment', [NewsController::class, 'comment'])->name('news.comment');
Route::post('/news/{id}/reply', [NewsController::class, 'reply'])->name('news.reply');
Route::post('/news/{id}/like', [NewsController::class, 'like'])->name('news.like');
use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/practical', [PracticalController::class, 'index'])->name('practical.index');
Route::get('/practical/{slug}', [PracticalController::class, 'show'])->name('practical.category');
Route::get('/practical/{slug}/topic/{topicId}', [PracticalController::class, 'showTopic'])->name('practical.topic');
Route::post('/practical/{slug}/application', [PracticalController::class, 'submitApplication'])->name('practical.application');

// Експорт маршрути
Route::get('/practical/{slug}/export/topics', [PracticalController::class, 'exportTopics'])->name('practical.export.topics');
Route::get('/practical/{slug}/export/applications', [PracticalController::class, 'exportApplications'])->name('practical.export.applications');

// Google OAuth маршрути
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
Route::post('/logout', [GoogleController::class, 'logout'])->name('logout');

// Сторінка входу
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Галерея
Route::get('/gallery', function () {
    // Отримуємо всі активні фото з галереї
    $photos = \App\Models\Gallery::active()->ordered()->get();

    // Якщо немає фото в базі, створюємо тестові
    if ($photos->isEmpty()) {
        $photos = collect([
            (object)['title' => 'Комп\'ютерна аудиторія', 'image_url' => asset('storage/images/gallery/placeholder.svg')],
            (object)['title' => 'Студенти на заняттях', 'image_url' => asset('storage/images/gallery/placeholder.svg')],
            (object)['title' => 'Лабораторія', 'image_url' => asset('storage/images/gallery/placeholder.svg')],
            (object)['title' => 'Випуск студентів', 'image_url' => asset('storage/images/gallery/placeholder.svg')],
            (object)['title' => 'Конференція', 'image_url' => asset('storage/images/gallery/placeholder.svg')],
            (object)['title' => 'Хакатон', 'image_url' => asset('storage/images/gallery/placeholder.svg')],
        ]);
    }

    return view('gallery', compact('photos'));
})->name('gallery');


// Тестовий роут для перевірки форми коментарів
Route::get('/test-comment', function() {
    return view('test-comment');
});


// Освітні компоненти
Route::get('/education', [App\Http\Controllers\EducationalComponentController::class, 'index'])->name('education.index');
Route::get('/education/{id}', [App\Http\Controllers\EducationalComponentController::class, 'show'])->name('education.show');
Route::get('/education/category/{categorySlug}', [App\Http\Controllers\EducationalComponentController::class, 'byCategory'])->name('education.category');


// Освітньо-професійні програми
Route::get("/programs", [EducationalProgramController::class, "index"])->name("programs.index");
Route::get("/programs/{id}", [EducationalProgramController::class, "show"])->name("programs.show");

// Опитування
Route::get("/surveys", [SurveyController::class, "index"])->name("surveys.index");
Route::get("/surveys/{id}", [SurveyController::class, "show"])->name("surveys.show");
Route::post("/surveys/{id}/submit", [SurveyController::class, "submit"])->name("surveys.submit");

