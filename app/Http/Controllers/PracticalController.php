<?php

namespace App\Http\Controllers;

use App\Models\PracticalCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

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
        $prefix = Str::slug($category->slug);

        $tables = [
            'topics' => "{$prefix}_topics",
            'requirements' => "{$prefix}_requirements",
            'timelines' => "{$prefix}_timelines",
            'links' => "{$prefix}_links",
        ];

        $data = [];

        foreach ($tables as $key => $table) {
            $data[$key] = Schema::hasTable($table)
                ? DB::table($table)->get()
                : collect();
        }

        return view('practical.show', compact('category', 'data'));
    }
}
