@extends('layouts.app')

@section('title', $category->title)

@section('content')
    <!-- Hero -->
    <section class="hero" style="background-image: url('/storage/images/1.jpg')">
        <div class="hero-overlay">
            <h1>{{ $category->title }}</h1>
            <p>Деталі категорії практичної підготовки</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="section">
        <div class="container">

            <!-- Мета -->
            <div style="background: #fff; border-radius: 12px; padding: 24px; margin-bottom: 40px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                <h2 style="margin-bottom: 10px;">🎯 Мета курсових робіт</h2>
                <p style="color: #555;">
                    Розвиток навичок дослідження, проєктування та реалізації програмних модулів згідно з вимогами замовника та стандартами галузі.
                </p>
            </div>

            <!-- Перелік тем -->
            <h2 class="section-title">📌 Перелік тем</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-bottom: 50px;">
                @foreach ($data['topics'] as $topic)
                    <div style="background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 20px;">
                        <h3 style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">{{ $topic->title ?? 'Без назви' }}</h3>
                        <p style="color: #555; font-size: 14px;">{{ $topic->description ?? 'Опис відсутній' }}</p>
                        <div style="margin-top: 12px;">
                            <a href="#" style="color: #007bff; font-size: 14px; font-weight: bold;">Деталі →</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Затверджені теми -->
            <h2 class="section-title">✅ Затверджені теми</h2>
            <div style="overflow-x: auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); margin-bottom: 50px;">
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th style="padding: 12px; border: 1px solid #e9ecef;">#</th>
                        <th style="padding: 12px; border: 1px solid #e9ecef;">Тема</th>
                        <th style="padding: 12px; border: 1px solid #e9ecef;">Студент</th>
                        <th style="padding: 12px; border: 1px solid #e9ecef;">Керівник</th>
                        <th style="padding: 12px; border: 1px solid #e9ecef;">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($data['requirements'] as $i => $req)
                        <tr>
                            <td style="padding: 10px; border: 1px solid #e9ecef; text-align: center;">{{ $i + 1 }}</td>
                            <td style="padding: 10px; border: 1px solid #e9ecef;">{{ $req->title ?? '-' }}</td>
                            <td style="padding: 10px; border: 1px solid #e9ecef;">{{ $req->student_name ?? '-' }}</td>
                            <td style="padding: 10px; border: 1px solid #e9ecef;">{{ $req->supervisor ?? '-' }}</td>
                            <td style="padding: 10px; border: 1px solid #e9ecef; text-align: center; color: green;">✅ Ухвалено</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" style="text-align: center; padding: 20px;">Немає затверджених тем</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Графік консультацій -->
            <h2 class="section-title">📅 Графік консультацій</h2>
            <div style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); margin-bottom: 50px;">
                @forelse ($data['timelines'] as $item)
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding: 10px 0;">
                        <span>📆 {{ $item->date ?? '—' }} &nbsp; 🕒 {{ $item->time ?? '' }}</span>
                        <span>👨‍🏫 {{ $item->teacher ?? '-' }} — {{ $item->location ?? '-' }}</span>
                    </div>
                @empty
                    <p>Немає графіку консультацій</p>
                @endforelse
            </div>

            <!-- Подати власну тему -->
            <h2 class="section-title">📤 Подати власну тему</h2>
            <form method="POST" action="#" style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); margin-bottom: 50px;">
                @csrf
                <input type="text" name="title" placeholder="Назва теми" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; margin-bottom: 12px;">
                <textarea name="description" rows="3" placeholder="Короткий опис" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; margin-bottom: 12px;"></textarea>
                <button type="submit" style="background-color: #007bff; color: white; padding: 12px 24px; border: none; border-radius: 6px; font-weight: bold;">
                    Подати заявку
                </button>
            </form>

            <!-- Література -->
            <h2 class="section-title">📚 Рекомендована література</h2>
            <ul style="list-style: disc; padding-left: 20px; color: #007bff;">
                @forelse ($data['links'] as $link)
                    <li style="margin-bottom: 6px;">
                        <a href="{{ $link->url }}" target="_blank" style="color: #007bff; text-decoration: underline;">
                            {{ $link->text ?? $link->url }}
                        </a>
                    </li>
                @empty
                    <li class="text-muted">Немає рекомендованої літератури</li>
                @endforelse
            </ul>

        </div>
    </section>
@endsection
