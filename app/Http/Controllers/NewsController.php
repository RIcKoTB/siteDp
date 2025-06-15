<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Comment;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('date', 'desc')->paginate(9); // Кількість новин на сторінку
        return view('news', compact('news'));
    }


    public function show(News $news)
    {
        // 🔥 Інкремент переглядів
        $news->increment('views');

        // Тільки кореневі коментарі (без parent_id)
        $comments = $news->comments()
            ->with('replies')
            ->whereNull('parent_id')
            ->paginate(9);

        return view('news.show', compact('news', 'comments'));
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'author_name' => 'required',
            'content' => 'required',
        ]);

        Comment::create([
            'news_id' => $id,
            'author_name' => $request->input('author_name'),
            'content' => $request->input('content'),
            'views' => 0,
        ]);

        return redirect()->route('news.show', $id);
    }


    public function reply(Request $request, $id)
    {
        $request->validate([
            'author_name' => 'required',
            'content' => 'required',
        ]);

        $parent = Comment::findOrFail($id);

        Comment::create([
            'news_id' => $parent->news_id,
            'parent_id' => $id,
            'author_name' => $request->input('author_name'),
            'content' => $request->input('content'),
            'views' => 0,
        ]);

        return redirect()->route('news.show', $parent->news_id);
    }

}
