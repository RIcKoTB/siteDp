<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index()
    {
        // Отримуємо доступні опитування
        $surveys = Survey::available()->ordered()->get();
        
        // Додаємо інформацію про завершення для авторизованих користувачів
        if (Auth::check()) {
            foreach ($surveys as $survey) {
                $survey->user_completed = $survey->hasUserCompleted();
            }
        }
        
        return view('surveys.index', compact('surveys'));
    }

    public function show($id)
    {
        $survey = Survey::available()->findOrFail($id);
        
        // Перевіряємо, чи користувач авторизований
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Для проходження опитування необхідно увійти в систему.');
        }
        
        // Перевіряємо, чи користувач вже проходив це опитування
        $hasCompleted = $survey->hasUserCompleted();
        $userResponse = null;
        
        if ($hasCompleted) {
            $userResponse = $survey->getUserResponse();
        }
        
        return view('surveys.show', compact('survey', 'hasCompleted', 'userResponse'));
    }

    public function submit(Request $request, $id)
    {
        $survey = Survey::available()->findOrFail($id);
        
        // Перевіряємо авторизацію
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Для проходження опитування необхідно увійти в систему.');
        }
        
        // Перевіряємо, чи користувач вже проходив це опитування
        if ($survey->hasUserCompleted()) {
            return redirect()->route('surveys.show', $survey->id)
                ->with('error', 'Ви вже проходили це опитування.');
        }
        
        // Валідація відповідей
        $rules = [];
        $messages = [];
        
        foreach ($survey->questions as $index => $question) {
            if ($question['required'] ?? false) {
                $rules["answers.{$index}"] = 'required';
                $messages["answers.{$index}.required"] = "Питання \"" . $question['question'] . "\" є обов'язковим.";
            }
        }
        
        $request->validate($rules, $messages);
        
        // Збереження відповідей
        SurveyResponse::create([
            'survey_id' => $survey->id,
            'user_id' => Auth::id(),
            'answers' => $request->answers ?? [],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'completed_at' => now(),
        ]);
        
        return redirect()->route('surveys.show', $survey->id)
            ->with('success', 'Дякуємо за участь в опитуванні! Ваші відповіді збережено.');
    }
}
