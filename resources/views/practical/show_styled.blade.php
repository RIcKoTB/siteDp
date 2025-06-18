@extends('layouts.app')

@section('title', $category->title)

@section('content')
    <!-- Hero Section -->
    <section class="practical-hero">
        <div class="hero-background">
            <div class="hero-particles"></div>
            <div class="hero-gradient"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-breadcrumb">
                    <a href="{{ route('practical.index') }}" class="breadcrumb-link">
                        <span class="breadcrumb-icon">🏠</span>
                        <span>Практична підготовка</span>
                    </a>
                    <span class="breadcrumb-separator">→</span>
                    <span class="breadcrumb-current">{{ $category->title }}</span>
                </div>
                <h1 class="hero-title">{{ $category->title }}</h1>
                <p class="hero-subtitle">Деталі категорії практичної підготовки</p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ $data['topics']->count() }}</span>
                        <span class="stat-label">Тем</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $data['applications']->count() }}</span>
                        <span class="stat-label">Заявок</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $category->created_at->format('Y') }}</span>
                        <span class="stat-label">Рік</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-scroll-indicator">
            <div class="scroll-arrow"></div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="practical-content">
        <div class="container">
            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success">
                    <div class="alert-icon">✅</div>
                    <div class="alert-content">
                        <h4 class="alert-title">Успіх!</h4>
                        <p class="alert-message">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <div class="alert-icon">❌</div>
                    <div class="alert-content">
                        <h4 class="alert-title">Помилка!</h4>
                        <p class="alert-message">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <!-- Category Description -->
            @if($category->content)
                <div class="content-card description-card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <span class="title-icon">📋</span>
                            Опис категорії
                        </h2>
                    </div>
                    <div class="card-content">
                        <div class="description-content">
                            {!! $category->content !!}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Topics Section -->
            <div class="section-header">
                <div class="section-title-wrapper">
                    <h2 class="section-title">
                        <span class="title-icon">📌</span>
                        Перелік тем
                    </h2>
                    <p class="section-subtitle">Доступні теми для практичної підготовки</p>
                </div>
                <div class="section-actions">
                    <a href="{{ route('practical.export.topics', $category->slug) }}" class="action-btn export-btn">
                        <span class="btn-icon">📥</span>
                        <span class="btn-text">Експорт тем</span>
                    </a>
                </div>
            </div>

            <!-- Topics Grid -->
            <div class="topics-grid">
                @forelse ($data['topics'] as $topic)
                    <div class="topic-card">
                        <div class="topic-card-header">
                            <div class="topic-status">
                                <span class="status-badge active">Активна</span>
                            </div>
                            <div class="topic-actions">
                                <button class="topic-action-btn bookmark-btn" title="Зберегти">
                                    <span class="action-icon">🔖</span>
                                </button>
                                <button class="topic-action-btn share-btn" title="Поділитися">
                                    <span class="action-icon">📤</span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="topic-content">
                            <h3 class="topic-title">
                                <a href="{{ route('practical.topic', ['slug' => $category->slug, 'topicId' => $topic->id]) }}">
                                    {{ $topic->title }}
                                </a>
                            </h3>
                            
                            <p class="topic-description">
                                {{ Str::limit($topic->description, 120) }}
                            </p>
                            
                            <div class="topic-meta">
                                @if($topic->teacher)
                                    <div class="meta-item">
                                        <span class="meta-icon">👨‍🏫</span>
                                        <span class="meta-text">{{ $topic->teacher }}</span>
                                    </div>
                                @endif
                                
                                @if($topic->hours)
                                    <div class="meta-item">
                                        <span class="meta-icon">⏱️</span>
                                        <span class="meta-text">{{ $topic->hours }} год</span>
                                    </div>
                                @endif
                                
                                <div class="meta-item">
                                    <span class="meta-icon">📅</span>
                                    <span class="meta-text">{{ $topic->created_at->format('d.m.Y') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="topic-footer">
                            <a href="{{ route('practical.topic', ['slug' => $category->slug, 'topicId' => $topic->id]) }}" 
                               class="topic-link">
                                <span class="link-text">Детальніше</span>
                                <span class="link-arrow">→</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">📝</div>
                        <h3 class="empty-title">Поки що немає тем</h3>
                        <p class="empty-description">Теми для цієї категорії ще не додані. Слідкуйте за оновленнями!</p>
                    </div>
                @endforelse
            </div>

            <!-- Applications Section -->
            <div class="section-header">
                <div class="section-title-wrapper">
                    <h2 class="section-title">
                        <span class="title-icon">✅</span>
                        Затверджені заявки
                    </h2>
                    <p class="section-subtitle">Студенти, які вже отримали теми</p>
                </div>
                <div class="section-actions">
                    <a href="{{ route('practical.export.applications', $category->slug) }}" class="action-btn export-btn">
                        <span class="btn-icon">📥</span>
                        <span class="btn-text">Експорт заявок</span>
                    </a>
                </div>
            </div>

            <!-- Applications Grid -->
            <div class="applications-grid">
                @forelse ($data['applications'] as $application)
                    <div class="application-card">
                        <div class="application-header">
                            <div class="student-info">
                                <div class="student-avatar">
                                    <span class="avatar-text">{{ substr($application->student_name, 0, 1) }}</span>
                                </div>
                                <div class="student-details">
                                    <h4 class="student-name">{{ $application->student_name }}</h4>
                                    <p class="student-email">{{ $application->student_email }}</p>
                                </div>
                            </div>
                            <div class="application-status">
                                <span class="status-badge approved">Затверджено</span>
                            </div>
                        </div>
                        
                        <div class="application-content">
                            <div class="application-topic">
                                <h5 class="topic-label">Тема:</h5>
                                <p class="topic-name">{{ $application->topic_title }}</p>
                            </div>
                            
                            @if($application->consultation_time)
                                <div class="consultation-info">
                                    <span class="consultation-icon">📅</span>
                                    <span class="consultation-text">
                                        Консультація: {{ \Carbon\Carbon::parse($application->consultation_time)->format('d.m.Y H:i') }}
                                    </span>
                                </div>
                            @endif
                            
                            <div class="application-dates">
                                <div class="date-item">
                                    <span class="date-label">Подано:</span>
                                    <span class="date-value">{{ $application->created_at->format('d.m.Y') }}</span>
                                </div>
                                <div class="date-item">
                                    <span class="date-label">Затверджено:</span>
                                    <span class="date-value">{{ $application->approved_at ? \Carbon\Carbon::parse($application->approved_at)->format('d.m.Y') : 'Не вказано' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        @if($application->topic)
                            <div class="application-footer">
                                <a href="{{ route('practical.topic', ['slug' => $category->slug, 'topicId' => $application->topic->id]) }}" 
                                   class="topic-detail-link">
                                    <span class="link-icon">📋</span>
                                    <span class="link-text">Детальна інформація про тему</span>
                                    <span class="link-arrow">→</span>
                                </a>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">📋</div>
                        <h3 class="empty-title">Поки що немає затверджених заявок</h3>
                        <p class="empty-description">Заявки студентів ще не затверджені або не подані.</p>
                    </div>
                @endforelse
            </div>

            <!-- Application Form Section -->
            <div class="application-form-section">
                @auth
                    @if(Auth::user()->hasValidStudentEmail())
                        <div class="form-card">
                            <div class="form-header">
                                <h2 class="form-title">
                                    <span class="title-icon">📝</span>
                                    Подати заявку на тему
                                </h2>
                                <p class="form-subtitle">Заповніть форму для подачі заявки на обрану тему</p>
                            </div>
                            
                            <form method="POST" action="{{ route('practical.application', $category->slug) }}" class="application-form">
                                @csrf
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="student_name" class="form-label">
                                            <span class="label-icon">👤</span>
                                            Ім'я студента
                                        </label>
                                        <input type="text" 
                                               id="student_name" 
                                               name="student_name" 
                                               class="form-input" 
                                               value="{{ old('student_name', Auth::user()->name) }}" 
                                               required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="student_email" class="form-label">
                                            <span class="label-icon">📧</span>
                                            Email студента
                                        </label>
                                        <input type="email" 
                                               id="student_email" 
                                               name="student_email" 
                                               class="form-input" 
                                               value="{{ old('student_email', Auth::user()->email) }}" 
                                               required>
                                    </div>
                                    
                                    <div class="form-group full-width">
                                        <label for="topic_title" class="form-label">
                                            <span class="label-icon">📋</span>
                                            Назва теми
                                        </label>
                                        <input type="text" 
                                               id="topic_title" 
                                               name="topic_title" 
                                               class="form-input" 
                                               value="{{ old('topic_title') }}" 
                                               placeholder="Введіть назву теми для практичної підготовки" 
                                               required>
                                    </div>
                                    
                                    <div class="form-group full-width">
                                        <label for="topic_description" class="form-label">
                                            <span class="label-icon">📝</span>
                                            Опис теми
                                        </label>
                                        <textarea id="topic_description" 
                                                  name="topic_description" 
                                                  class="form-textarea" 
                                                  rows="4" 
                                                  placeholder="Детальний опис теми, цілі та завдання">{{ old('topic_description') }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="form-actions">
                                    <button type="submit" class="submit-btn">
                                        <span class="btn-icon">📤</span>
                                        <span class="btn-text">Подати заявку</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="warning-card">
                            <div class="warning-icon">⚠️</div>
                            <div class="warning-content">
                                <h3 class="warning-title">Недійсний email</h3>
                                <p class="warning-message">
                                    Для подачі заявки потрібен студентський email з доменом <strong>@student.uzhnu.edu.ua</strong>
                                </p>
                                <p class="warning-current">
                                    Ваш поточний email: <strong>{{ Auth::user()->email }}</strong>
                                </p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="auth-card">
                        <div class="auth-icon">🔐</div>
                        <div class="auth-content">
                            <h3 class="auth-title">Потрібна авторизація</h3>
                            <p class="auth-message">
                                Для подачі заявки на тему потрібно увійти в систему через студентський Google акаунт
                            </p>
                            <a href="{{ route('login') }}" class="auth-btn">
                                <span class="btn-icon">🔐</span>
                                <span class="btn-text">Увійти в систему</span>
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
/* Practical Hero Section */
.practical-hero {
    position: relative;
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.hero-particles {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(2px 2px at 20px 30px, rgba(255,255,255,0.3), transparent),
        radial-gradient(2px 2px at 40px 70px, rgba(255,255,255,0.2), transparent),
        radial-gradient(1px 1px at 90px 40px, rgba(255,255,255,0.4), transparent);
    background-repeat: repeat;
    background-size: 100px 100px;
    animation: particleFloat 20s linear infinite;
}

@keyframes particleFloat {
    0% { transform: translateY(0px); }
    100% { transform: translateY(-100px); }
}

.hero-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(102, 126, 234, 0.8) 0%, rgba(118, 75, 162, 0.8) 100%);
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

.hero-breadcrumb {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-bottom: 20px;
    font-size: 14px;
}

.breadcrumb-link {
    display: flex;
    align-items: center;
    gap: 5px;
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-link:hover {
    color: white;
}

.breadcrumb-separator {
    color: rgba(255, 255, 255, 0.7);
}

.breadcrumb-current {
    color: white;
    font-weight: 600;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 20px;
    line-height: 1.2;
    text-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size: 1.2rem;
    margin-bottom: 40px;
    opacity: 0.9;
    line-height: 1.6;
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin-top: 40px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.hero-scroll-indicator {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
    cursor: pointer;
}

.scroll-arrow {
    width: 30px;
    height: 30px;
    border: 2px solid rgba(255,255,255,0.7);
    border-top: none;
    border-left: none;
    transform: rotate(45deg);
    animation: scrollBounce 2s infinite;
}

@keyframes scrollBounce {
    0%, 20%, 50%, 80%, 100% { transform: rotate(45deg) translateY(0); }
    40% { transform: rotate(45deg) translateY(-10px); }
    60% { transform: rotate(45deg) translateY(-5px); }
}

/* Main Content */
.practical-content {
    padding: 80px 0;
    background: #f8fafc;
}

/* Alerts */
.alert {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 30px;
    border: 1px solid;
    animation: slideInDown 0.5s ease;
}

.alert-success {
    background: #d1fae5;
    border-color: #a7f3d0;
    color: #065f46;
}

.alert-error {
    background: #fee2e2;
    border-color: #fecaca;
    color: #991b1b;
}

.alert-icon {
    font-size: 24px;
    flex-shrink: 0;
}

.alert-title {
    font-size: 16px;
    font-weight: 600;
    margin: 0 0 5px 0;
}

.alert-message {
    margin: 0;
    line-height: 1.5;
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Content Cards */
.content-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    margin-bottom: 40px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.content-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

.card-header {
    padding: 30px 30px 0 30px;
}

.card-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
}

.title-icon {
    font-size: 28px;
}

.card-content {
    padding: 20px 30px 30px 30px;
}

.description-content {
    color: #4b5563;
    line-height: 1.7;
    font-size: 16px;
}

.description-content h1,
.description-content h2,
.description-content h3 {
    color: #1f2937;
    margin-top: 25px;
    margin-bottom: 15px;
}

.description-content p {
    margin-bottom: 15px;
}

.description-content ul,
.description-content ol {
    margin-bottom: 15px;
    padding-left: 25px;
}

.description-content li {
    margin-bottom: 8px;
}

/* Section Headers */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 40px;
    gap: 20px;
}

.section-title-wrapper {
    flex: 1;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 28px;
    font-weight: 700;
    color: #1f2937;
    margin: 0 0 8px 0;
}

.section-subtitle {
    color: #6b7280;
    font-size: 16px;
    margin: 0;
    line-height: 1.5;
}

.section-actions {
    display: flex;
    gap: 12px;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 12px 20px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    color: white;
}

.export-btn {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
}

.export-btn:hover {
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
}

.btn-icon {
    font-size: 16px;
}

/* Topics Grid */
.topics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
    gap: 30px;
    margin-bottom: 60px;
}

/* Topic Cards */
.topic-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    animation: slideInUp 0.6s ease forwards;
    opacity: 0;
    transform: translateY(30px);
}

.topic-card:nth-child(1) { animation-delay: 0.1s; }
.topic-card:nth-child(2) { animation-delay: 0.2s; }
.topic-card:nth-child(3) { animation-delay: 0.3s; }
.topic-card:nth-child(4) { animation-delay: 0.4s; }
.topic-card:nth-child(5) { animation-delay: 0.5s; }
.topic-card:nth-child(6) { animation-delay: 0.6s; }

@keyframes slideInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.topic-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.topic-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 20px 20px 0 20px;
}

.topic-status {
    display: flex;
    gap: 8px;
}

.status-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge.active {
    background: #d1fae5;
    color: #065f46;
}

.topic-actions {
    display: flex;
    gap: 8px;
}

.topic-action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: #f3f4f6;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.topic-action-btn:hover {
    background: #e5e7eb;
    transform: scale(1.1);
}

.bookmark-btn:hover {
    background: #fef3c7;
    color: #d97706;
}

.share-btn:hover {
    background: #dbeafe;
    color: #2563eb;
}

.action-icon {
    font-size: 14px;
}

.topic-content {
    padding: 0 20px 20px 20px;
}

.topic-title {
    margin: 0 0 15px 0;
    line-height: 1.4;
}

.topic-title a {
    color: #1f2937;
    text-decoration: none;
    font-size: 20px;
    font-weight: 700;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.topic-title a:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.topic-description {
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 14px;
}

.topic-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 20px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #6b7280;
    background: #f9fafb;
    padding: 6px 10px;
    border-radius: 12px;
}

.meta-icon {
    font-size: 14px;
}

.topic-footer {
    padding: 20px;
    border-top: 1px solid #f3f4f6;
    background: #f9fafb;
}

.topic-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}

.topic-link:hover {
    color: #5a67d8;
    transform: translateX(3px);
}

.link-arrow {
    transition: transform 0.3s ease;
    font-size: 16px;
}

.topic-link:hover .link-arrow {
    transform: translateX(3px);
}
</style>
@endsection


/* Applications Grid */
.applications-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 30px;
    margin-bottom: 60px;
}

/* Application Cards */
.application-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border-left: 4px solid #10b981;
}

.application-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

.application-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 25px 25px 0 25px;
}

.student-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.student-avatar {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 18px;
}

.student-details {
    flex: 1;
}

.student-name {
    font-size: 18px;
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 5px 0;
}

.student-email {
    font-size: 14px;
    color: #6b7280;
    margin: 0;
}

.application-status {
    flex-shrink: 0;
}

.status-badge.approved {
    background: #d1fae5;
    color: #065f46;
}

.application-content {
    padding: 20px 25px;
}

.application-topic {
    margin-bottom: 20px;
}

.topic-label {
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin: 0 0 8px 0;
}

.topic-name {
    font-size: 16px;
    color: #1f2937;
    margin: 0;
    line-height: 1.5;
}

.consultation-info {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f0f9ff;
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 20px;
    border: 1px solid #e0f2fe;
}

.consultation-icon {
    font-size: 16px;
    color: #0284c7;
}

.consultation-text {
    font-size: 14px;
    color: #0c4a6e;
    font-weight: 500;
}

.application-dates {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.date-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.date-label {
    font-size: 12px;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.date-value {
    font-size: 14px;
    color: #1f2937;
    font-weight: 500;
}

.application-footer {
    padding: 20px 25px;
    border-top: 1px solid #f3f4f6;
    background: #f9fafb;
}

.topic-detail-link {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #3b82f6;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.topic-detail-link:hover {
    color: #1d4ed8;
    transform: translateX(3px);
}

.link-icon {
    font-size: 16px;
}

/* Empty States */
.empty-state {
    grid-column: 1 / -1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    text-align: center;
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.7;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}

.empty-title {
    font-size: 24px;
    font-weight: 700;
    color: #374151;
    margin: 0 0 15px 0;
}

.empty-description {
    font-size: 16px;
    color: #6b7280;
    margin: 0;
    line-height: 1.6;
    max-width: 400px;
}

/* Application Form Section */
.application-form-section {
    margin-top: 60px;
}

.form-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    overflow: hidden;
}

.form-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    text-align: center;
}

.form-title {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 10px 0;
}

.form-subtitle {
    font-size: 16px;
    opacity: 0.9;
    margin: 0;
    line-height: 1.5;
}

.application-form {
    padding: 30px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
    margin-bottom: 30px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

.label-icon {
    font-size: 16px;
}

.form-input,
.form-textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    font-size: 14px;
    transition: all 0.3s ease;
    background: #f9fafb;
}

.form-input:focus,
.form-textarea:focus {
    outline: none;
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
}

.form-actions {
    display: flex;
    justify-content: center;
}

.submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.submit-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

/* Warning and Auth Cards */
.warning-card,
.auth-card {
    background: white;
    border-radius: 16px;
    padding: 40px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

.warning-card {
    border: 2px solid #fbbf24;
    background: #fffbeb;
}

.auth-card {
    border: 2px solid #3b82f6;
    background: #eff6ff;
}

.warning-icon,
.auth-icon {
    font-size: 3rem;
    margin-bottom: 10px;
}

.warning-title,
.auth-title {
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 15px 0;
}

.warning-title {
    color: #92400e;
}

.auth-title {
    color: #1e40af;
}

.warning-message,
.auth-message {
    font-size: 16px;
    line-height: 1.6;
    margin: 0 0 15px 0;
    max-width: 500px;
}

.warning-message {
    color: #92400e;
}

.auth-message {
    color: #1e40af;
}

.warning-current {
    font-size: 14px;
    color: #92400e;
    margin: 0;
}

.auth-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    padding: 12px 24px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.auth-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-stats {
        flex-direction: column;
        gap: 20px;
    }
    
    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .topics-grid,
    .applications-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .application-dates {
        grid-template-columns: 1fr;
        gap: 10px;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .practical-content {
        padding: 40px 0;
    }
    
    .card-content,
    .application-form {
        padding: 20px;
    }
    
    .form-header {
        padding: 20px;
    }
}

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for hero scroll indicator
    const scrollIndicator = document.querySelector('.hero-scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', function() {
            document.querySelector('.practical-content').scrollIntoView({
                behavior: 'smooth'
            });
        });
    }

    // Bookmark functionality
    const bookmarkButtons = document.querySelectorAll('.bookmark-btn');
    bookmarkButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.classList.contains('bookmarked')) {
                this.classList.remove('bookmarked');
                this.style.background = '#f3f4f6';
                this.style.color = '#6b7280';
                this.title = 'Зберегти';
            } else {
                this.classList.add('bookmarked');
                this.style.background = '#fef3c7';
                this.style.color = '#d97706';
                this.title = 'Збережено';
            }
        });
    });

    // Share functionality
    const shareButtons = document.querySelectorAll('.share-btn');
    shareButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const topicCard = this.closest('.topic-card');
            const title = topicCard.querySelector('.topic-title a').textContent;
            const url = topicCard.querySelector('.topic-title a').href;
            
            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                });
            } else {
                // Fallback - copy to clipboard
                navigator.clipboard.writeText(url).then(() => {
                    // Show temporary notification
                    showNotification('Посилання скопійовано!', 'success');
                });
            }
        });
    });

    // Form validation
    const applicationForm = document.querySelector('.application-form');
    if (applicationForm) {
        applicationForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.submit-btn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnIcon = submitBtn.querySelector('.btn-icon');
            
            // Disable button and show loading state
            submitBtn.disabled = true;
            btnText.textContent = 'Відправляємо...';
            btnIcon.textContent = '⏳';
            
            // Re-enable after 3 seconds if form doesn't submit
            setTimeout(() => {
                submitBtn.disabled = false;
                btnText.textContent = 'Подати заявку';
                btnIcon.textContent = '📤';
            }, 3000);
        });
    }

    // Parallax effect for hero
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.practical-hero');
        if (hero) {
            const rate = scrolled * -0.5;
            hero.style.transform = `translateY(${rate}px)`;
        }
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe cards
    const cards = document.querySelectorAll('.topic-card, .application-card, .content-card');
    cards.forEach(card => {
        observer.observe(card);
    });
});

// Notification function
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <span class="notification-icon">${type === 'success' ? '✅' : 'ℹ️'}</span>
            <span class="notification-message">${message}</span>
        </div>
    `;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : '#3b82f6'};
        color: white;
        padding: 15px 20px;
        border-radius: 10px;
        z-index: 1000;
        animation: slideInRight 0.3s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        max-width: 300px;
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease forwards';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Add CSS for notifications
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .notification-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .notification-icon {
        font-size: 18px;
    }
    
    .notification-message {
        font-weight: 500;
    }
`;
document.head.appendChild(style);
</script>
@endsection
