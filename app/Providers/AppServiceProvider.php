<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\PracticalCategory;
use App\Models\EducationalCategory;

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
        // Автоматична передача категорій у всі шаблони
        View::composer('*', function ($view) {
            $view->with('practicalCategories', PracticalCategory::orderBy('title')->get());
            $view->with('educationalCategories', EducationalCategory::active()->ordered()->get());
        });
    }
}
