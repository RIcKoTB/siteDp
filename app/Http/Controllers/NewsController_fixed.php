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

        // Тільки кореневі коментарі (без parent_id) з користувачами
        $comments = $news->comments()
            ->with(['replies.user', 'user'])
            ->whereNull('parent_id')
            ->paginate(9);
        
        return view("news.show", compact("news", "comments"));
    }

    public function comment(Request $request, $id)
    {
        // Перевіряємо, чи користувач авторизований
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Для додавання коментарів потрібно увійти в систему');
        }

        // Додаткове логування для діагностики
        \Log::info('Comment request data:', [
            'all' => $request->all(),
            'content' => $request->input('content'),
            'content_length' => strlen($request->input('content', '')),
            'user_id' => auth()->id(),
            'news_id' => $id
        ]);

        $request->validate([
            'content' => 'required|string|min:1|max:1000',
        ]);

        // Перевіряємо, що content не порожній після валідації
        $content = trim($request->input('content'));
        if (empty($content)) {
            return redirect()->back()->with('error', 'Коментар не може бути порожнім');
        }

        Comment::create([
            'news_id' => $id,
            'user_id' => auth()->id(),
            'content' => $content,
        ]);

        return redirect()->route('news.show', $id)->with('success', 'Коментар додано успішно!');
    }

    public function reply(Request $request, $id)
    {
        // Перевіряємо, чи користувач авторизований
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Для додавання відповідей потрібно увійти в систему');
        }

        // Додаткове логування для діагностики
        \Log::info('Reply request data:', $request->all());

        $request->validate([
            'content' => 'required|string|min:1|max:1000',
            'parent_id' => 'required|exists:comments,id',
        ]);

        // Перевіряємо, що content не порожній після валідації
        $content = trim($request->input('content'));
        if (empty($content)) {
            return redirect()->back()->with('error', 'Відповідь не може бути порожньою');
        }

        $parent = Comment::findOrFail($request->parent_id);

        Comment::create([
            'news_id' => $id,
            'user_id' => auth()->id(),
            'content' => $content,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('news.show', $parent->news_id)->with('success', 'Відповідь додано успішно!');
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
