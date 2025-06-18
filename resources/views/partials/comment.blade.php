<div class="comment">
    <div class="comment-header">
        <div class="comment-author">
            <img src="{{ $comment->user ? ($comment->user->avatar ?? asset('images/default-avatar.png')) : asset('images/default-avatar.png') }}" 
                 alt="Avatar" class="user-avatar">
            <div>
                <div class="comment-author-name">
                    {{ $comment->user ? $comment->user->name : $comment->author_name }}
                    @if($comment->user && $comment->user->group)
                        <span class="user-group">{{ $comment->user->group }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="comment-date">
            {{ $comment->created_at->format('d.m.Y H:i') }}
        </div>
    </div>
    
    <div class="comment-content">
        {{ $comment->content }}
    </div>
    
    <div class="comment-actions">
        @auth
            <button class="reply-btn" onclick="toggleReplyForm({{ $comment->id }})">
                Відповісти
            </button>
        @endauth
    </div>
    
    @auth
        <div id="reply-form-{{ $comment->id }}" class="reply-form">
            <div class="user-info">
                <img src="{{ auth()->user()->avatar ?? asset('images/default-avatar.png') }}" alt="Avatar" class="user-avatar">
                <div>
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    @if(auth()->user()->group)
                        <span class="user-group">{{ auth()->user()->group }}</span>
                    @endif
                </div>
            </div>
            <form action="{{ route('news.reply', $newsId) }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea name="content" rows="2" placeholder="Напишіть відповідь..." required class="form-control"></textarea>
                <div class="character-counter">0/1000</div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary btn-sm">Відповісти</button>
                    <button type="button" class="btn btn-outline btn-sm" onclick="toggleReplyForm({{ $comment->id }})">Скасувати</button>
                </div>
            </form>
        </div>
    @endauth
</div>

@if($comment->replies && $comment->replies->count() > 0)
    <div class="replies">
        @foreach($comment->replies as $reply)
            @include('partials.comment', ['comment' => $reply, 'newsId' => $newsId])
        @endforeach
    </div>
@endif
