<?php

namespace App\Http\Controllers;

use App\Models\PracticalCategory;
use Illuminate\Http\Request;

class PracticalController extends Controller
{
    public function index()
    {
        $categories = PracticalCategory::orderBy('title')->get();
        return view('practical.index', compact('categories'));
    }

    public function show(PracticalCategory $category)
    {
        return view('practical.show', compact('category'));
    }
}
