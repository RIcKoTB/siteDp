@extends('layouts.app')

@section('title', 'Освітні компоненти')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/educational.css') }}">
@endpush

@section('content')

<!-- Hero Section -->
<section class="hero educational-hero">
    <div class="hero-overlay">
        <div class="container">
            <h1>📚 Освітні компоненти</h1>
            <p>Навчальні дисципліни та курси нашого коледжу</p>
        </div>
    </div>
</section>

<!-- Filters Section -->
<section class="filters-section">
    <div class="container">
        <div class="filters-wrapper">
            <!-- Search -->
            <div class="search-box">
                <form method="GET" action="{{ route('education.index') }}">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Пошук предметів..."
                           class="search-input">
                    <input type="hidden" name="category" value="{{ request('category', 'all') }}">
                    <button type="submit" class="search-btn">🔍</button>
                </form>
            </div>

            <!-- Category Filters -->
            <div class="category-filters">
                <a href="{{ route('education.index', ['category' => 'all', 'search' => request('search')]) }}" 
                   class="filter-btn {{ request('category', 'all') === 'all' ? 'active' : '' }}">
                    Всі предмети
                    <span class="count">{{ $categoryCounts['all'] }}</span>
                </a>
                
                @foreach($categories as $category)
                    <a href="{{ route('education.index', ['category' => $category->slug, 'search' => request('search')]) }}" 
                       class="filter-btn {{ request('category') === $category->slug ? 'active' : '' }}"
                       style="--category-color: {{ $category->color }}">
                        @if($category->icon)
                            <span class="category-icon">{{ $category->icon }}</span>
                        @endif
                        {{ $category->name }}
                        <span class="count">{{ $categoryCounts[$category->slug] ?? 0 }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Components Grid -->
<section class="components-section">
    <div class="container">
        @if($components->count() > 0)
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
                <div class="no-results-icon">📚</div>
                <h3>Предмети не знайдено</h3>
                <p>Спробуйте змінити критерії пошуку або фільтрації</p>
                <a href="{{ route('education.index') }}" class="btn btn-primary">Показати всі предмети</a>
            </div>
        @endif
    </div>
</section>

@endsection
