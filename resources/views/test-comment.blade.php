<!DOCTYPE html>
<html>
<head>
    <title>Test Comment Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Test Comment Form</h1>
    
    @if(session('success'))
        <div style="color: green; padding: 10px; border: 1px solid green; margin: 10px 0;">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div style="color: red; padding: 10px; border: 1px solid red; margin: 10px 0;">
            {{ session('error') }}
        </div>
    @endif
    
    @if($errors->any())
        <div style="color: red; padding: 10px; border: 1px solid red; margin: 10px 0;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <p>Current user: {{ auth()->check() ? auth()->user()->name : 'Not logged in' }}</p>
    
    @auth
        <form action="{{ route('news.comment', 3) }}" method="POST">
            @csrf
            <textarea name="content" rows="3" placeholder="Ваш коментар" required style="width: 300px;">Це тестовий коментар від {{ auth()->user()->name }}</textarea>
            <br><br>
            <button type="submit">Надіслати коментар</button>
        </form>
    @else
        <p>Потрібно увійти в систему для додавання коментарів</p>
        <a href="{{ route('login') }}">Увійти</a>
    @endauth
    
    <hr>
    <h2>Recent Comments for News #3</h2>
    @php
        $comments = \App\Models\Comment::where('news_id', 3)->with('user')->latest()->take(5)->get();
    @endphp
    
    @foreach($comments as $comment)
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0;">
            <strong>{{ $comment->user ? $comment->user->name : $comment->author_name }}</strong>
            <small>({{ $comment->created_at->format('d.m.Y H:i') }})</small>
            <p>{{ $comment->content }}</p>
        </div>
    @endforeach
</body>
</html>
