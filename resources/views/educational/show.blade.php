@extends('layouts.app')

@section('title', $component->title)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/educational.css') }}">
    <link rel="stylesheet" href="{{ asset('css/educational-detail.css') }}">
@endpush

@section('content')

<!-- Hero Section -->
<section class="hero component-hero">
    <div class="hero-overlay">
        <div class="container">
            <div class="hero-content">
                <div class="breadcrumb">
                    <a href="{{ route('education.index') }}">Освітні компоненти</a>
                    <span>/</span>
                    <a href="{{ route('education.category', $component->category) }}">{{ $component->category_name }}</a>
                    <span>/</span>
                    <span>{{ $component->title }}</span>
                </div>
                
                <div class="component-header">
                    <div class="component-meta">
                        <span class="component-code">{{ $component->code }}</span>
                        <span class="category-badge" style="background: {{ $component->category_color }}">
                            {{ $component->category_name }}
                        </span>
                    </div>
                    
                    <h1>{{ $component->title }}</h1>
                    
                    <div class="component-stats">
                        <div class="stat-item">
                            <span class="stat-value">{{ $component->credits }}</span>
                            <span class="stat-label">кредитів</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">{{ $component->hours_total }}</span>
                            <span class="stat-label">годин</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">{{ $component->semester }}</span>
                            <span class="stat-label">семестр</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="component-content">
    <div class="container">
        <div class="content-grid">
            <!-- Main Content -->
            <div class="main-content">
                <!-- Description -->
                <div class="content-block">
                    <h2>📋 Опис дисципліни</h2>
                    <div class="content-text">
                        {!! nl2br(e($component->description)) !!}
                    </div>
                </div>

                <!-- Objectives -->
                <div class="content-block">
                    <h2>🎯 Цілі та завдання</h2>
                    <div class="content-text">
                        {!! nl2br(e($component->objectives)) !!}
                    </div>
                </div>

                <!-- Content -->
                @if($component->content)
                    <div class="content-block">
                        <h2>📚 Зміст дисципліни</h2>
                        <div class="content-html">
                            {!! $component->content !!}
                        </div>
                    </div>
                @endif

                <!-- Learning Outcomes -->
                @if($component->learning_outcomes && count($component->learning_outcomes) > 0)
                    <div class="content-block">
                        <h2>🎓 Результати навчання</h2>
                        <ul class="outcomes-list">
                            @foreach($component->learning_outcomes as $outcome)
                                <li>{{ $outcome }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Assessment Methods -->
                @if($component->assessment_methods && count($component->assessment_methods) > 0)
                    <div class="content-block">
                        <h2>📊 Методи оцінювання</h2>
                        <ul class="assessment-list">
                            @foreach($component->assessment_methods as $method)
                                <li>{{ $method }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Literature -->
                @if($component->literature && count($component->literature) > 0)
                    <div class="content-block">
                        <h2>📖 Література</h2>
                        <div class="literature-list">
                            @foreach($component->literature as $book)
                                <div class="literature-item">
                                    @if(is_array($book))
                                        <h4>{{ $book['title'] ?? 'Без назви' }}</h4>
                                        @if(isset($book['author']))
                                            <p class="author">Автор: {{ $book['author'] }}</p>
                                        @endif
                                        @if(isset($book['year']))
                                            <p class="year">Рік: {{ $book['year'] }}</p>
                                        @endif
                                        @if(isset($book['type']))
                                            <span class="book-type">{{ $book['type'] }}</span>
                                        @endif
                                    @else
                                        <p>{{ $book }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Schedule -->
                @if($component->schedule && count($component->schedule) > 0)
                    <div class="content-block">
                        <h2>📅 Розклад занять</h2>
                        <div class="schedule-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>День тижня</th>
                                        <th>Час</th>
                                        <th>Тип заняття</th>
                                        <th>Аудиторія</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($component->schedule as $lesson)
                                        <tr>
                                            <td>{{ $lesson['day'] ?? '-' }}</td>
                                            <td>{{ $lesson['time'] ?? '-' }}</td>
                                            <td>{{ $lesson['type'] ?? '-' }}</td>
                                            <td>{{ $lesson['room'] ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Component Info -->
                <div class="sidebar-block">
                    <h3>ℹ️ Інформація про предмет</h3>
                    <div class="info-list">
                        <div class="info-item">
                            <span class="label">Код:</span>
                            <span class="value">{{ $component->code }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Кредити:</span>
                            <span class="value">{{ $component->credits }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Семестр:</span>
                            <span class="value">{{ $component->semester }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Всього годин:</span>
                            <span class="value">{{ $component->hours_total }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Лекції:</span>
                            <span class="value">{{ $component->hours_lectures }} год</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Практичні:</span>
                            <span class="value">{{ $component->hours_practical }} год</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Лабораторні:</span>
                            <span class="value">{{ $component->hours_laboratory }} год</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Самостійна робота:</span>
                            <span class="value">{{ $component->hours_independent }} год</span>
                        </div>
                    </div>
                </div>

                <!-- Teacher Info -->
                @if($component->teacher_name)
                    <div class="sidebar-block">
                        <h3>👨‍🏫 Викладач</h3>
                        <div class="teacher-info">
                            <h4>{{ $component->teacher_name }}</h4>
                            @if($component->teacher_email)
                                <p>
                                    <a href="mailto:{{ $component->teacher_email }}">
                                        {{ $component->teacher_email }}
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Related Components -->
                @if($relatedComponents->count() > 0)
                    <div class="sidebar-block">
                        <h3>📚 Схожі предмети</h3>
                        <div class="related-list">
                            @foreach($relatedComponents as $related)
                                <div class="related-item">
                                    <a href="{{ route('education.show', $related->id) }}">
                                        <h4>{{ $related->title }}</h4>
                                        <p>{{ $related->code }} • {{ $related->credits }} кредитів</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
