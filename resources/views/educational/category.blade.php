@extends('layouts.app')

@section('title', $category->name . ' - Освітні компоненти')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/educational.css') }}">
@endpush

@section('content')

<!-- Hero Section -->
<section class="hero category-hero" style="background-image: url('/storage/images/1.jpg')" >
    <div class="hero-overlay">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('education.index') }}">Освітні компоненти</a>
                <span>/</span>
                <span>{{ $category->name }}</span>
            </div>

            <h1>
                @if($category->icon)
                    <span class="category-icon">{{ $category->icon }}</span>
                @endif
                {{ $category->name }}
            </h1>

            @if($category->description)
                <p>{{ $category->description }}</p>
            @endif

            <div class="category-stats">
                <div class="stat-item">
                    <span class="stat-value">{{ $components->total() }}</span>
                    <span class="stat-label">предметів</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Navigation -->
<section class="category-navigation">
    <div class="container">
        <div class="category-tabs">
            <a href="{{ route('education.index') }}" class="tab-btn">
                Всі категорії
            </a>

            @foreach($categories as $cat)
                <a href="{{ route('education.category', $cat->slug) }}"
                   class="tab-btn {{ $cat->slug === $category->slug ? 'active' : '' }}"
                   style="--category-color: {{ $cat->color }}">
                    @if($cat->icon)
                        <span class="tab-icon">{{ $cat->icon }}</span>
                    @endif
                    {{ $cat->name }}
                    <span class="tab-count">{{ $cat->components_count }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Components Grid -->
<section class="components-section">
    <div class="container">
        @if($components->count() > 0)
            <div class="section-header">
                <h2>Предмети категорії "{{ $category->name }}"</h2>
                <p>Знайдено {{ $components->total() }} {{ $components->total() == 1 ? 'предмет' : ($components->total() < 5 ? 'предмети' : 'предметів') }}</p>
            </div>

            <div class="components-grid">
                @foreach($components as $component)
                    <div class="component-card">
                        <div class="card-header">
                            <div class="component-image">
                                <img src="{{ $component->image }}" alt="{{ $component->title }}">
                                <div class="category-badge" style="background: {{ $component->category_color }}">
                                    {{ $component->category_name }}
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="component-meta">
                                <span class="component-code">{{ $component->code }}</span>
                                <span class="component-credits">{{ $component->credits }} кредитів</span>
                            </div>

                            <h3 class="component-title">
                                <a href="{{ route('education.show', $component->id) }}">
                                    {{ $component->title }}
                                </a>
                            </h3>

                            <p class="component-description">
                                {{ $component->short_description }}
                            </p>

                            <div class="component-details">
                                <div class="detail-item">
                                    <span class="icon">⏰</span>
                                    <span>{{ $component->hours_total }} год</span>
                                </div>
                                <div class="detail-item">
                                    <span class="icon">📅</span>
                                    <span>{{ $component->semester }} семестр</span>
                                </div>
                                @if($component->teacher_name)
                                    <div class="detail-item">
                                        <span class="icon">👨‍🏫</span>
                                        <span>{{ $component->teacher_name }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('education.show', $component->id) }}" class="btn btn-primary">
                                Детальніше
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($components->hasPages())
                <div class="pagination-wrapper">
                    {{ $components->links() }}
                </div>
            @endif
        @else
            <div class="no-results">
                <div class="no-results-icon" style="color: {{ $category->color }}">
                    {{ $category->icon ?: '📚' }}
                </div>
                <h3>Предмети не знайдено</h3>
                <p>У категорії "{{ $category->name }}" поки що немає доступних предметів</p>
                <a href="{{ route('education.index') }}" class="btn btn-primary">Переглянути всі предмети</a>
            </div>
        @endif
    </div>
</section>

@endsection

@push('styles')
<style>
/* Category Hero */
.category-hero {
    min-height: 350px;
    color: white;
    text-align: center;
}

.category-hero .breadcrumb {
    margin-bottom: 1rem;
    font-size: 0.9rem;
    opacity: 0.9;
}

.category-hero .breadcrumb a {
    color: white;
    text-decoration: none;
}

.category-hero .breadcrumb a:hover {
    text-decoration: underline;
}

.category-hero .breadcrumb span {
    margin: 0 0.5rem;
}

.category-hero h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.category-icon {
    font-size: 3rem;
}

.category-stats {
    margin-top: 2rem;
}

.stat-item {
    display: inline-block;
    text-align: center;
    margin: 0 1rem;
}

.stat-value {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    line-height: 1;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

/* Category Navigation */
.category-navigation {
    background: #f8f9fa;
    padding: 1.5rem 0;
    border-bottom: 1px solid #e9ecef;
}

.category-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    justify-content: center;
}

.tab-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: white;
    color: #6c757d;
    text-decoration: none;
    border: 2px solid #e9ecef;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.tab-btn:hover {
    border-color: var(--category-color, #667eea);
    color: var(--category-color, #667eea);
    transform: translateY(-2px);
}

.tab-btn.active {
    background: var(--category-color, #667eea);
    color: white;
    border-color: var(--category-color, #667eea);
}

.tab-icon {
    font-size: 1.1rem;
}

.tab-count {
    background: rgba(0,0,0,0.1);
    padding: 0.2rem 0.5rem;
    border-radius: 12px;
    font-size: 0.8rem;
}

.tab-btn.active .tab-count {
    background: rgba(255,255,255,0.2);
}

/* Section Header */
.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-header h2 {
    font-size: 2rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.section-header p {
    color: #6c757d;
    font-size: 1.1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .category-hero h1 {
        font-size: 2rem;
        flex-direction: column;
        gap: 0.5rem;
    }

    .category-icon {
        font-size: 2rem;
    }

    .category-tabs {
        justify-content: flex-start;
        overflow-x: auto;
        padding-bottom: 0.5rem;
    }

    .tab-btn {
        white-space: nowrap;
    }
}
</style>
@endpush
