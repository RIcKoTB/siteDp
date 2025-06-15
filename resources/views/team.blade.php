@extends('layouts.app')

@section('title', 'Наша команда')

@section('content')

    <!-- HERO -->
    <section class="hero-alt">
        <div class="container">
            <h1>Наша команда</h1>
            <p>Ті, хто творять рішення та рухають нас уперед</p>
        </div>
    </section>

    <!-- Секція карток -->
    <section class="team-section">
        <div class="container">
            <h2>Знайомтесь з учасниками</h2>

            <div class="team-grid">
                @foreach ($teamMembers as $member)
                    <div class="team-card">
                        <div class="avatar-wrapper">
                            <img src="{{ asset('storage/' . $member->img_path) }}" alt="{{ $member->name }}">
                        </div>
                        <div class="card-content">
                            <h3>{{ $member->name }}</h3>
                            <p>{{ $member->role }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
