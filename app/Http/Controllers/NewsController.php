<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with(['likes', 'comments']);
        
        // Фільтрація за категорією
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        $news = $query->orderBy('date', 'desc')->paginate(9);
        
        // Зберігаємо параметри фільтрації для пагінації
        $news->appends($request->query());
        
        // Лічильники для кожної категорії
        $categoryCounts = [
            'all' => News::count(),
            'events' => News::where('category', 'events')->count(),
            'achievements' => News::where('category', 'achievements')->count(),
            'announcements' => News::where('category', 'announcements')->count(),
        ];
        
        return view('news', compact('news', 'categoryCounts'));
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
            'author_name' => $request->author_name,
            'content' => $request->content,
        ]);

        return redirect()->route('news.show', $id);
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'author_name' => 'required',
            'content' => 'required',
            'parent_id' => 'required|exists:comments,id',
        ]);

        $parent = Comment::findOrFail($request->parent_id);

        Comment::create([
            'news_id' => $id,
            'author_name' => $request->author_name,
            'content' => $request->content,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('news.show', $parent->news_id);
    }

    public function like(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();

        // Перевіряємо чи вже лайкнув цей IP
        $existingLike = Like::where('news_id', $id)
                           ->where('ip_address', $ipAddress)
                           ->first();

        if ($existingLike) {
            // Якщо вже лайкнув - видаляємо лайк (unlike)
            $existingLike->delete();
            $liked = false;
        } else {
            // Якщо не лайкнув - додаємо лайк
            Like::create([
                'news_id' => $id,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
            ]);
            $liked = true;
        }

        // Повертаємо JSON відповідь для AJAX
        if ($request->ajax()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $news->likes()->count()
            ]);
        }

        return redirect()->back();
    }
}
