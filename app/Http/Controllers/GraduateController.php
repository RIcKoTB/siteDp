<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;

class GraduateController extends Controller
{
    public function index(Request $request)
    {
        $query = Graduate::active()->ordered();
        
        // Фільтрація по року
        if ($request->filled('year')) {
            $query->byYear($request->year);
        }
        
        // Фільтрація по спеціальності
        if ($request->filled('specialty')) {
            $query->bySpecialty($request->specialty);
        }
        
        // Пошук
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('middle_name', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('current_position', 'like', "%{$search}%");
            });
        }
        
        $graduates = $query->paginate(12);
        $featuredGraduates = Graduate::active()->featured()->ordered()->limit(6)->get();
        $availableYears = Graduate::getAvailableYears();
        $availableSpecialties = Graduate::getAvailableSpecialties();
        
        return view('graduates.index', compact(
            'graduates', 
            'featuredGraduates', 
            'availableYears', 
            'availableSpecialties'
        ));
    }

    public function show($id)
    {
        $graduate = Graduate::active()->findOrFail($id);
        $relatedGraduates = Graduate::active()
            ->where('id', '!=', $graduate->id)
            ->where(function ($query) use ($graduate) {
                $query->where('specialty', $graduate->specialty)
                      ->orWhere('graduation_year', $graduate->graduation_year);
            })
            ->ordered()
            ->limit(4)
            ->get();
        
        return view('graduates.show', compact('graduate', 'relatedGraduates'));
    }
}
