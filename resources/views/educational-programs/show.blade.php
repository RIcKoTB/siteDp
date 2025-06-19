@extends('layouts.app')

@section('title', $program->title)

@section('content')

<!-- Hero Section -->
<section class="program-hero">
    <div class="hero-overlay">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <div class="program-code">{{ $program->code }}</div>
                    <h1>{{ $program->title }}</h1>
                    @if($program->qualification)
                        <div class="qualification-badge">
                            🎯 {{ $program->qualification }}
                        </div>
                    @endif
                    <p class="hero-description">{{ $program->description }}</p>
                </div>
                @if($program->image_url)
                    <div class="hero-image">
                        <img src="{{ $program->image }}" alt="{{ $program->title }}">
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Program Details -->
<section class="program-details-section">
    <div class="container">
        <div class="details-grid">
            <!-- Основна інформація -->
            <div class="detail-card">
                <h3>📋 Основна інформація</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="label">Тривалість навчання:</span>
                        <span class="value">{{ $program->duration_years }} {{ $program->duration_years == 1 ? 'рік' : ($program->duration_years < 5 ? 'роки' : 'років') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Кількість кредитів:</span>
                        <span class="value">{{ $program->credits_total }} кредитів ЄКТС</span>
                    </div>
                    @if($program->admission_requirements)
                        <div class="info-item full-width">
                            <span class="label">Вимоги до вступу:</span>
                            <span class="value">{{ $program->admission_requirements }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Цілі програми -->
            @if($program->objectives)
                <div class="detail-card">
                    <h3>🎯 Цілі програми</h3>
                    <p>{{ $program->objectives }}</p>
                </div>
            @endif

            <!-- Перспективи кар'єри -->
            @if($program->career_prospects)
                <div class="detail-card">
                    <h3>💼 Перспективи кар'єри</h3>
                    <p>{{ $program->career_prospects }}</p>
                </div>
            @endif
        </div>

        <!-- Компетентності -->
        @if($program->competencies && count($program->competencies) > 0)
            <div class="section-block">
                <h2>🎓 Програмні компетентності</h2>
                <div class="competencies-grid">
                    @foreach($program->competencies as $competency)
                        <div class="competency-card">
                            <div class="competency-code">{{ $competency['code'] }}</div>
                            <div class="competency-description">{{ $competency['description'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Результати навчання -->
        @if($program->learning_outcomes && count($program->learning_outcomes) > 0)
            <div class="section-block">
                <h2>📚 Програмні результати навчання</h2>
                <div class="outcomes-grid">
                    @foreach($program->learning_outcomes as $outcome)
                        <div class="outcome-card">
                            <div class="outcome-code">{{ $outcome['code'] }}</div>
                            <div class="outcome-description">{{ $outcome['description'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Навчальний план -->
        @if($program->curriculum && count($program->curriculum) > 0)
            <div class="section-block">
                <h2>📖 Структура навчального плану</h2>
                <div class="curriculum-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Семестр</th>
                                <th>Навчальна дисципліна</th>
                                <th>Кредити</th>
                                <th>Тип</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($program->curriculum as $subject)
                                <tr>
                                    <td>{{ $subject['semester'] }}</td>
                                    <td>{{ $subject['subject'] }}</td>
                                    <td>{{ $subject['credits'] }}</td>
                                    <td>
                                        <span class="subject-type {{ strtolower(str_replace("'", '', $subject['type'])) }}">
                                            {{ $subject['type'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Кнопки дій -->
        <div class="action-buttons">
            <a href="{{ route('programs.index') }}" class="btn btn-secondary">
                ← Повернутися до списку програм
            </a>
            <a href="#" class="btn btn-primary">
                📧 Зв'язатися з приймальною комісією
            </a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* Hero Section */
.program-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4rem 0;
    margin-bottom: 3rem;
}

.hero-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
    align-items: center;
}

.program-code {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 1rem;
}

.program-hero h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.qualification-badge {
    background: rgba(255, 255, 255, 0.15);
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 500;
    display: inline-block;
    margin-bottom: 1.5rem;
}

.hero-description {
    font-size: 1.1rem;
    line-height: 1.6;
    opacity: 0.9;
}

.hero-image img {
    width: 100%;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

/* Details Section */
.program-details-section {
    padding: 2rem 0 4rem;
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.detail-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
}

.detail-card h3 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
    font-size: 1.3rem;
    font-weight: 600;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.info-item.full-width {
    grid-column: 1 / -1;
}

.info-item .label {
    font-weight: 600;
    color: #6c757d;
    font-size: 0.9rem;
}

.info-item .value {
    color: #2c3e50;
    font-weight: 500;
}

/* Section Blocks */
.section-block {
    margin-bottom: 3rem;
}

.section-block h2 {
    color: #2c3e50;
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 2rem;
    text-align: center;
}

/* Competencies */
.competencies-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.competency-card {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    border-left: 4px solid #667eea;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.competency-code {
    background: #667eea;
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 1rem;
}

.competency-description {
    color: #2c3e50;
    line-height: 1.6;
}

/* Learning Outcomes */
.outcomes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.outcome-card {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    border-left: 4px solid #28a745;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.outcome-code {
    background: #28a745;
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 1rem;
}

.outcome-description {
    color: #2c3e50;
    line-height: 1.6;
}

/* Curriculum Table */
.curriculum-table {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.curriculum-table table {
    width: 100%;
    border-collapse: collapse;
}

.curriculum-table th {
    background: #f8f9fa;
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: #2c3e50;
    border-bottom: 2px solid #e9ecef;
}

.curriculum-table td {
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c3e50;
}

.subject-type {
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.subject-type.обовязкова {
    background: #d4edda;
    color: #155724;
}

.subject-type.вибіркова {
    background: #fff3cd;
    color: #856404;
}

.subject-type.практика {
    background: #d1ecf1;
    color: #0c5460;
}

.subject-type.атестація {
    background: #f8d7da;
    color: #721c24;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 3rem;
}

.btn {
    display: inline-block;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    text-align: center;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: #667eea;
    color: white;
}

.btn-primary:hover {
    background: #5a6fd8;
    transform: translateY(-1px);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-1px);
}

/* Responsive */
@media (max-width: 768px) {
    .hero-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .program-hero h1 {
        font-size: 2rem;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .curriculum-table {
        overflow-x: auto;
    }
}
</style>
@endpush
