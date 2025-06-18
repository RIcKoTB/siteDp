<div class="comment-item {{ $comment->parent_id ? 'comment-reply' : 'comment-root' }}" data-comment-id="{{ $comment->id }}">
    <div class="comment-card">
        <div class="comment-header">
            <div class="comment-author">
                <div class="author-avatar">
                    <span class="avatar-text">{{ substr($comment->author_name, 0, 1) }}</span>
                </div>
                <div class="author-info">
                    <h5 class="author-name">{{ $comment->author_name }}</h5>
                    <p class="comment-date">
                        <span class="date-icon">🕒</span>
                        {{ $comment->created_at->diffForHumans() }}
                        <span class="date-full">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                    </p>
                </div>
            </div>
            <div class="comment-actions">
                <button class="comment-action-btn like-btn" onclick="toggleCommentLike({{ $comment->id }})">
                    <span class="action-icon">👍</span>
                    <span class="action-count">{{ rand(0, 15) }}</span>
                </button>
                <button class="comment-action-btn reply-btn" onclick="toggleReplyForm({{ $comment->id }})">
                    <span class="action-icon">💬</span>
                    <span class="action-text">Відповісти</span>
                </button>
            </div>
        </div>
        
        <div class="comment-content">
            <p class="comment-text">{{ $comment->content }}</p>
        </div>

        <!-- Reply Form -->
        <div class="reply-form-wrapper" id="reply-form-{{ $comment->id }}" style="display: none;">
            <form action="{{ route('news.reply', $comment->id) }}" method="POST" class="reply-form">
                @csrf
                <div class="reply-form-header">
                    <h6 class="reply-form-title">Відповісти {{ $comment->author_name }}</h6>
                </div>
                <div class="form-group">
                    <input type="text" 
                           name="author_name" 
                           class="form-input" 
                           placeholder="Ваше ім'я" 
                           required>
                </div>
                <div class="form-group">
                    <textarea name="content" 
                              class="form-textarea" 
                              rows="3" 
                              placeholder="Ваша відповідь..." 
                              required></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-btn">
                        <span class="btn-icon">📤</span>
                        <span class="btn-text">Відповісти</span>
                    </button>
                    <button type="button" class="cancel-btn" onclick="toggleReplyForm({{ $comment->id }})">
                        <span class="btn-text">Скасувати</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Nested Replies -->
    @if($comment->replies && $comment->replies->count() > 0)
        <div class="comment-replies">
            @foreach($comment->replies as $reply)
                @include('partials.comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>
