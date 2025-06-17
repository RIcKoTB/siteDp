@extends('layouts.app')

@section('title', 'Практична підготовка')

@section('content')
    <!-- Hero -->
    <section class="hero" style="background-image: url('/storage/images/1.jpg')">
        <div class="hero-overlay">
            <h1>Практична підготовка</h1>
            <p>Оберіть категорію для детальної інформації</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="section">
        <div class="container">
            
            <!-- Загальна інформація -->
            <div style="background: #fff; border-radius: 12px; padding: 24px; margin-bottom: 40px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); text-align: center;">
                <h2 style="margin-bottom: 15px; color: #333;">🎯 Практична підготовка студентів</h2>
                <p style="color: #666; font-size: 16px; line-height: 1.6; max-width: 800px; margin: 0 auto;">
                    Практична підготовка є невід'ємною частиною навчального процесу, що забезпечує формування професійних компетентностей 
                    та практичних навичок, необхідних для успішної професійної діяльності.
                </p>
            </div>

            <!-- Категорії -->
            <h2 class="section-title">📚 Категорії практичної підготовки</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px; margin-bottom: 50px;">
                @forelse ($categories as $category)
                    <div style="background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 24px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div style="display: flex; align-items: center; margin-bottom: 15px;">
                            <div style="background: linear-gradient(135deg, #007bff, #0056b3); color: white; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 20px;">
                                📋
                            </div>
                            <h3 style="font-size: 20px; font-weight: bold; margin: 0; color: #333;">{{ $category->title }}</h3>
                        </div>
                        
                        @if($category->content)
                            <div style="color: #666; font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                                {!! Str::limit(strip_tags($category->content), 150) !!}
                            </div>
                        @endif
                        
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a href="{{ route('practical.category', $category->slug) }}" 
                               style="background: #007bff; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-flex; align-items: center;">
                                Детальніше
                                <span style="margin-left: 8px;">→</span>
                            </a>
                            <span style="color: #999; font-size: 12px;">
                                Створено: {{ $category->created_at->format('d.m.Y') }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: #666;">
                        <div style="font-size: 48px; margin-bottom: 20px;">📚</div>
                        <h3 style="margin-bottom: 10px;">Категорії ще не створені</h3>
                        <p>Категорії практичної підготовки будуть додані найближчим часом.</p>
                    </div>
                @endforelse
            </div>

            <!-- Додаткова інформація -->
            <div style="background: linear-gradient(135deg, #f8f9fa, #e9ecef); border-radius: 12px; padding: 30px; text-align: center;">
                <h3 style="margin-bottom: 15px; color: #333;">💡 Потрібна допомога?</h3>
                <p style="color: #666; margin-bottom: 20px;">
                    Якщо у вас є питання щодо практичної підготовки, зверніться до координатора або перегляньте детальну інформацію в обраній категорії.
                </p>
                <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                    <a href="/contact" style="background: #28a745; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                        📞 Контакти
                    </a>
                    <a href="/about" style="background: #17a2b8; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                        ℹ️ Про нас
                    </a>
                </div>
            </div>

        </div>
    </section>

    <style>
        .hero {
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .hero-overlay {
            background: rgba(0, 0, 0, 0.6);
            color: white;
            text-align: center;
            padding: 40px;
            border-radius: 12px;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            font-weight: bold;
        }
        
        .hero p {
            font-size: 1.2rem;
            margin: 0;
        }
        
        .section {
            padding: 60px 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .section-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }
        
        /* Hover effects */
        div[style*="transition"]:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        }
        
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection
