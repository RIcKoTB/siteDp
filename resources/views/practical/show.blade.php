@extends('layouts.app')

@section('title', $category->title)

@section('content')
    <section class="section">
        <div class="container">
            <h2 class="section-title">{{ $category->title }}</h2>
            <p>Контент для цієї категорії з’явиться тут...</p>
        </div>
    </section>
@endsection
