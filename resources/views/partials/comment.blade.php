<div class="comment-box" style="margin-bottom: 25px; border: 1px solid #ddd; padding: 15px; border-radius: 8px; background: #f9f9f9; margin-left: {{ $comment->parent_id ? '40px' : '0' }};">
    <strong>{{ $comment->author_name }}</strong>
    <p style="color: #777;">{{ $comment->created_at->format('d.m.Y H:i') }}</p>
    <p>{{ $comment->content }}</p>

    <!-- Форма відповіді -->
    <form action="{{ route('news.reply', $comment->id) }}" method="POST" style="margin-top: 10px;">
        @csrf
        <input type="text" name="author_name" placeholder="Ваше ім’я" class="form-control mb-2" required>
        <textarea name="content" placeholder="Ваша відповідь" class="form-control mb-2" required></textarea>
        <button type="submit" class="btn btn-primary btn-sm">Відповісти</button>
    </form>

    <!-- Відповіді -->
    @if ($comment->replies)
        @foreach ($comment->replies as $reply)
            @include('partials.comment', ['comment' => $reply])
        @endforeach
    @endif
</div>
