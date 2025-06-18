<?php

namespace App\Http\Controllers;

use App\Models\EducationalProgram;
use Illuminate\Http\Request;

class EducationalProgramController extends Controller
{
    public function index()
    {
        $programs = EducationalProgram::active()->ordered()->get();
        
        return view('educational-programs.index', compact('programs'));
    }

    public function show($id)
    {
        $program = EducationalProgram::active()->findOrFail($id);
        
        return view('educational-programs.show', compact('program'));
    }
}
