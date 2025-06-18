<?php

namespace App\Http\Controllers;

use App\Models\EducationalComponent;
use App\Models\EducationalCategory;
use Illuminate\Http\Request;

class EducationalComponentController extends Controller
{
    public function index(Request $request)
    {
        $query = EducationalComponent::with('categoryModel')->active();
        
        // Фільтрація за категорією
        if ($request->has('category') && $request->category !== 'all') {
            $query->byCategory($request->category);
        }
        
        // Пошук
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('teacher_name', 'like', "%{$search}%");
            });
        }
        
        $components = $query->ordered()->paginate(12);
        
        // Зберігаємо параметри фільтрації для пагінації
        $components->appends($request->query());
        
        // Отримуємо категорії для фільтрації
        $categories = EducationalCategory::active()->ordered()->get();
        
        // Лічильники для кожної категорії
        $categoryCounts = [
            'all' => EducationalComponent::active()->count(),
        ];
        
        foreach ($categories as $category) {
            $categoryCounts[$category->slug] = EducationalComponent::active()
                ->byCategory($category->slug)->count();
        }
        
        return view('educational.index', compact('components', 'categories', 'categoryCounts'));
    }

    public function show($id)
    {
        $component = EducationalComponent::with('categoryModel')->active()->findOrFail($id);
        
        // Схожі предмети з тієї ж категорії
        $relatedComponents = EducationalComponent::active()
            ->byCategory($component->category)
            ->where('id', '!=', $component->id)
            ->ordered()
            ->limit(3)
            ->get();
        
        return view('educational.show', compact('component', 'relatedComponents'));
    }

    public function byCategory($categorySlug)
    {
        $category = EducationalCategory::active()->where('slug', $categorySlug)->firstOrFail();
        
        $components = EducationalComponent::with('categoryModel')
            ->active()
            ->byCategory($categorySlug)
            ->ordered()
            ->paginate(12);
        
        // Отримуємо всі категорії для навігації
        $categories = EducationalCategory::active()->ordered()->get();
        
        return view('educational.category', compact('components', 'category', 'categories'));
    }
}
