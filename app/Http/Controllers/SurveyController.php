<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::available()->ordered()->get();
        
        return view('surveys.index', compact('surveys'));
    }

    public function show($id)
    {
        $survey = Survey::available()->findOrFail($id);
        
        return view('surveys.show', compact('survey'));
    }

    public function submit(Request $request, $id)
    {
        $survey = Survey::available()->findOrFail($id);
        
        // Валідація відповідей
        $rules = [];
        foreach ($survey->questions as $index => $question) {
            if ($question['required'] ?? false) {
                $rules["answers.{$index}"] = 'required';
            }
        }
        
        $request->validate($rules);
        
        // Збереження відповідей (якщо є модель SurveyResponse)
        if (class_exists(SurveyResponse::class)) {
            SurveyResponse::create([
                'survey_id' => $survey->id,
                'answers' => $request->answers,
                'user_id' => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }
        
        return view('surveys.thank-you', compact('survey'));
    }
}
