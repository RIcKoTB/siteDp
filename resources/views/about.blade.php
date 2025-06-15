@extends('layouts.app')

@section('title', 'Про нас')

@section('content')

    <!-- HERO -->
    <section class="hero" style="background-image: url('/storage/images/1.jpg')">
        <div class="hero-overlay">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Логотип" class="hero-icon">
            <h1>Про нашу комісію</h1>
            <p>Комісія ПІКС</p>
        </div>
    </section>


    <!-- МІСІЯ (ProgramOverview -> title = "Наша місія") -->
    @if ($mission)
        <section class="section">
            <div class="container">
                <h2 class="section-title">{{ $mission->title }}</h2>
                <p class="section-text">{{ $mission->value }}</p>
            </div>
        </section>
    @endif

    @if ($values && $values->isNotEmpty())
        <section class="section alt-bg">
            <div class="container">
                <h2 class="section-title">Наші цінності</h2>
                <div class="card-row">
                    @foreach ($values as $value)
                        <div class="value-card">
                            <img src="{{ asset('storage/' . $value->img_path) }}" alt="{{ $value->title }}">
                            <h3>{{ $value->title }}</h3>
                            <p>{{ $value->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    <section class="section">
        <div class="container">
            <h2 class="section-title">Наша команда</h2>
            <div class="card-row">
                @foreach ($teamMembers as $member)
                    <div class="team-card">
                        <img src="{{ asset('storage/' . $member->img_path) }}"
                             alt="{{ $member->name }}"
                             style="width: 100%; height: 220px; object-fit: cover;">
                        <div class="card-content">
                            <h3 style="font-weight: 600;">{{ $member->name }}</h3>
                            <p style="color: #555;">{{ $member->role }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    @if ($history->count())
        <section class="section alt-bg">
            <div class="container">
                <h2 class="section-title">Наша історія</h2>
                <ul class="history-list">
                    @foreach ($history as $event)
                        @if($event->event_year && $event->description)
                            <li><strong>{{ $event->event_year }}</strong> — {{ $event->description }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </section>
    @endif



@endsection
