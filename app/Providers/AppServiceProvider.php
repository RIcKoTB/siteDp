<?php

namespace App\Providers;

use App\Observers\PracticalCategoryObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\PracticalCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Автоматична передача категорій практичної підготовки у всі шаблони
        View::composer('*', function ($view) {
            $view->with('practicalCategories', PracticalCategory::orderBy('title')->get());
        });

        PracticalCategory::observe(PracticalCategoryObserver::class);

    }
}
