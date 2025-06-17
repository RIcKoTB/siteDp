<?php

namespace App\Http\Controllers;

use App\Models\PracticalCategory;
use App\Models\StudentApplication;
use App\Exports\SimpleTopicsExport;
use App\Exports\StudentApplicationsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PracticalController extends Controller
{
    public function index()
    {
        $categories = PracticalCategory::orderBy('title')->get();
        return view('practical.index', compact('categories'));
    }

    public function show($slug)
    {
        $category = PracticalCategory::where('slug', $slug)->firstOrFail();

        $data = [
            'topics' => $category->topics()->where('is_active', true)->orderBy('created_at', 'desc')->get(),
            'applications' => StudentApplication::where('category_id', $category->id)
                ->where('status', 'approved')
                ->orderBy('approved_at', 'desc')
                ->get(),
        ];

        return view('practical.show', compact('category', 'data'));
    }

    public function submitApplication(Request $request, $slug)
    {
        $category = PracticalCategory::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'topic_id' => 'required|exists:practical_topics,id',
            'student_name' => 'required|string|max:255',
            'student_email' => 'required|email|max:255',
            'student_phone' => 'nullable|string|max:255',
            'student_group' => 'nullable|string|max:255',
            'motivation' => 'required|string|min:50',
        ]);

        $validated['category_id'] = $category->id;

        // Перевіряємо, чи студент вже не подав заявку на цю тему
        $existingApplication = StudentApplication::where('topic_id', $validated['topic_id'])
            ->where('student_email', $validated['student_email'])
            ->first();

        if ($existingApplication) {
            return redirect()->route('practical.category', $slug)
                ->with('error', 'Ви вже подали заявку на цю тему!');
        }

        StudentApplication::create($validated);

        return redirect()->route('practical.category', $slug)
            ->with('success', 'Вашу заявку на тему успішно подано! Очікуйте на розгляд викладачем.');
    }

    public function showTopic($slug, $topicId)
    {
        $category = PracticalCategory::where('slug', $slug)->firstOrFail();
        $topic = $category->topics()->findOrFail($topicId);

        return view('practical.topic', compact('category', 'topic'));
    }

    public function exportTopics($slug)
    {
        // Збільшуємо ліміт часу виконання
        set_time_limit(300); // 5 хвилин
        ini_set('memory_limit', '512M');

        $category = PracticalCategory::where('slug', $slug)->firstOrFail();

        // Перевіряємо кількість записів
        $query = $category->topics();
        $count = $query->count();

        // Якщо записів багато, використовуємо CSV
        if ($count > 100) {
            return $this->exportTopicsAsCsv($category);
        }

        return Excel::download(
            new SimpleTopicsExport($slug),
            'topics_' . $category->slug . '_' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    private function exportTopicsAsCsv($category)
    {
        $filename = 'topics_' . $category->slug . '_' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($category) {
            $file = fopen('php://output', 'w');

            // Заголовки
            fputcsv($file, [
                'ID', 'Категорія', 'Назва теми', 'Опис', 'Викладач',
                'Години', 'Активна', 'Керівник', 'Email керівника', 'Дата створення'
            ]);

            // Дані по частинах
            $category->topics()->with('category:id,title')->chunk(100, function($topics) use ($file) {
                foreach ($topics as $topic) {
                    fputcsv($file, [
                        $topic->id,
                        $topic->category ? $topic->category->title : '',
                        $topic->title,
                        $topic->description,
                        $topic->teacher,
                        $topic->hours,
                        $topic->is_active ? 'Так' : 'Ні',
                        $topic->supervisor_name,
                        $topic->supervisor_email,
                        $topic->created_at ? $topic->created_at->format('d.m.Y H:i') : '',
                    ]);
                }
            });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportApplications($slug)
    {
        // Збільшуємо ліміт часу виконання
        set_time_limit(300); // 5 хвилин
        ini_set('memory_limit', '512M');

        $category = PracticalCategory::where('slug', $slug)->firstOrFail();

        return Excel::download(
            new StudentApplicationsExport($slug, 'approved'),
            'approved_applications_' . $category->slug . '_' . now()->format('Y-m-d') . '.xlsx'
        );
    }
}
