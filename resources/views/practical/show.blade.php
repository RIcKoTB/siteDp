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

            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Опис категорії -->
            @if($category->content)
                <div style="background: #fff; border-radius: 12px; padding: 24px; margin-bottom: 40px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                    <h2 style="margin-bottom: 15px;">📋 Опис</h2>
                    <div style="color: #555; line-height: 1.6;">
                        {!! $category->content !!}
                    </div>
                </div>
            @endif

            <!-- Перелік тем -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h2 class="section-title" style="margin: 0;">📌 Перелік тем</h2>

                <!-- Кнопки експорту -->
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('practical.export.topics', $category->slug) }}"
                       class="export-btn"
                       style="display: inline-flex; align-items: center; background: #28a745; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; transition: background 0.3s;"
                       onmouseover="this.style.background='#218838'"
                       onmouseout="this.style.background='#28a745'"
                       onclick="showExportLoading(this)">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 6px;">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                        <span class="btn-text">Експорт тем</span>
                        <span class="btn-loading" style="display: none;">Завантаження...</span>
                    </a>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; margin-bottom: 50px;">
                @forelse ($data['topics'] as $topic)
                    <a href="{{ route('practical.topic', ['slug' => $category->slug, 'topicId' => $topic->id]) }}"
                       style="text-decoration: none; color: inherit; display: block; transition: all 0.3s ease;"
                       onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)'">
                        <div style="background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 25px; height: 100%; position: relative; border: 2px solid transparent; cursor: pointer;"
                             onmouseover="this.style.borderColor='#3b82f6'"
                             onmouseout="this.style.borderColor='transparent'">

                            <!-- Іконка для позначення клікабельності -->
                            <div style="position: absolute; top: 15px; right: 15px; background: #f3f4f6; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; opacity: 0.7;">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                                    <path d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                                </svg>
                            </div>

                            <div style="margin-bottom: 15px;">
                                <h3 style="font-size: 20px; font-weight: bold; margin: 0 30px 0 0; color: #1f2937; line-height: 1.3;">
                                    {{ $topic->title ?? 'Без назви' }}
                                </h3>
                            </div>

                            <p style="color: #6b7280; font-size: 14px; margin-bottom: 20px; line-height: 1.5;">
                                {{ Str::limit($topic->description ?? 'Опис відсутній', 120) }}
                            </p>

                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                @if(isset($topic->teacher) && $topic->teacher)
                                    <div style="display: flex; align-items: center; color: #374151; font-size: 13px;">
                                        <span style="margin-right: 8px;">👨‍🏫</span>
                                        <strong style="margin-right: 5px;">Викладач:</strong>
                                        <span>{{ $topic->teacher }}</span>
                                    </div>
                                @endif

                                @if(isset($topic->hours) && $topic->hours)
                                    <div style="display: flex; align-items: center; color: #374151; font-size: 13px;">
                                        <span style="margin-right: 8px;">⏱️</span>
                                        <strong style="margin-right: 5px;">Години:</strong>
                                        <span>{{ $topic->hours }} год.</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Індикатор "Детальніше" -->
                            <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #e5e7eb;">
                                <div style="display: flex; align-items: center; justify-content: center; color: #3b82f6; font-size: 14px; font-weight: 500;">
                                    <span style="margin-right: 5px;">Детальна інформація</span>
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">
                        <p>Теми ще не додані</p>
                    </div>
                @endforelse
            </div>

            <!-- Затверджені теми -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h2 class="section-title" style="margin: 0;">✅ Затверджені теми</h2>

                <!-- Кнопка експорту затверджених тем -->
                <div>
                    <a href="{{ route('practical.export.applications', $category->slug) }}"
                       class="export-btn"
                       style="display: inline-flex; align-items: center; background: #28a745; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; transition: background 0.3s;"
                       onmouseover="this.style.background='#218838'"
                       onmouseout="this.style.background='#28a745'"
                       onclick="showExportLoading(this)">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 6px;">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                        <span class="btn-text">Експорт затверджених</span>
                        <span class="btn-loading" style="display: none;">Завантаження...</span>
                    </a>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 25px; margin-bottom: 50px;">
                @forelse ($data['applications'] as $application)
                    <div style="background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 25px; border-left: 4px solid #28a745;">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                            <h3 style="font-size: 18px; font-weight: bold; margin: 0; color: #1f2937; line-height: 1.3;">
                                {{ $application->topic ? $application->topic->title : 'Тема не вказана' }}
                            </h3>
                            <span style="background: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500; white-space: nowrap; margin-left: 10px;">
                                ✅ Затверджено
                            </span>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 10px;">
                                <div>
                                    <strong style="color: #374151; font-size: 13px;">Студент:</strong>
                                    <div style="color: #6b7280; font-size: 14px;">{{ $application->student_name }}</div>
                                </div>
                                <div>
                                    <strong style="color: #374151; font-size: 13px;">Група:</strong>
                                    <div style="color: #6b7280; font-size: 14px;">{{ $application->student_group ?: 'Не вказана' }}</div>
                                </div>
                            </div>

                            <div style="margin-bottom: 10px;">
                                <strong style="color: #374151; font-size: 13px;">Email:</strong>
                                <div style="color: #6b7280; font-size: 14px;">{{ $application->student_email }}</div>
                            </div>

                            @if($application->topic && $application->topic->supervisor_name)
                                <div style="margin-bottom: 10px;">
                                    <strong style="color: #374151; font-size: 13px;">Керівник:</strong>
                                    <div style="color: #6b7280; font-size: 14px;">{{ $application->topic->supervisor_name }}</div>
                                </div>
                            @endif

                            <div>
                                <strong style="color: #374151; font-size: 13px;">Дата затвердження:</strong>
                                <div style="color: #6b7280; font-size: 14px;">{{ $application->approved_at ? $application->approved_at->format('d.m.Y H:i') : 'Не вказана' }}</div>
                            </div>
                        </div>

                        @if($application->topic)
                            <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #e5e7eb;">
                                <a href="{{ route('practical.topic', ['slug' => $category->slug, 'topicId' => $application->topic->id]) }}"
                                   style="display: inline-flex; align-items: center; color: #3b82f6; text-decoration: none; font-size: 14px; font-weight: 500;"
                                   onmouseover="this.style.color='#1d4ed8'"
                                   onmouseout="this.style.color='#3b82f6'">
                                    <span style="margin-right: 5px;">📋</span>
                                    Детальна інформація про тему
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="margin-left: 5px;">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                        <div style="font-size: 48px; margin-bottom: 15px;">📋</div>
                        <h3 style="margin: 0 0 10px 0; color: #374151;">Поки що немає затверджених тем</h3>
                        <p style="margin: 0; color: #6b7280;">Затверджені теми з'являться тут після розгляду заявок викладачами</p>
                    </div>
                @endforelse
            </div>



            <!-- Подати заявку на тему -->
            <h2 class="section-title">📤 Подати заявку на тему</h2>

            @auth
                @if(Auth::user()->hasValidStudentEmail())
                    <form method="POST" action="{{ route('practical.application', $category->slug) }}" style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); margin-bottom: 50px;">
                        @csrf
                @else
                    <div style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 12px; padding: 24px; margin-bottom: 50px; text-align: center;">
                        <h3 style="color: #856404; margin-bottom: 15px;">⚠️ Недійсний email</h3>
                        <p style="color: #856404; margin-bottom: 20px;">
                            Для подачі заявки потрібен студентський email з доменом <strong>@student.uzhnu.edu.ua</strong>
                        </p>
                        <p style="color: #856404; font-size: 14px;">
                            Ваш поточний email: <strong>{{ Auth::user()->email }}</strong>
                        </p>
                    </div>
                @endif
            @else
                <div style="background: #e3f2fd; border: 1px solid #bbdefb; border-radius: 12px; padding: 24px; margin-bottom: 50px; text-align: center;">
                    <h3 style="color: #1565c0; margin-bottom: 15px;">🔐 Потрібна авторизація</h3>
                    <p style="color: #1565c0; margin-bottom: 20px;">
                        Для подачі заявки на тему потрібно увійти в систему через студентський Google акаунт
                    </p>
                    <a href="{{ route('login') }}" style="display: inline-flex; align-items: center; background: #1976d2; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 500;">
                        🔐 Увійти в систему
                    </a>
                </div>
            @endauth

            @auth
                @if(Auth::user()->hasValidStudentEmail())

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #333; font-size: 16px;">Оберіть тему: <span style="color: red;">*</span></label>
                    <select name="topic_id" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 14px;">
                        <option value="">-- Оберіть тему зі списку --</option>
                        @foreach($data['topics'] as $topic)
                            <option value="{{ $topic->id }}" {{ old('topic_id') == $topic->id ? 'selected' : '' }}>
                                {{ $topic->title }} ({{ $topic->teacher ? $topic->teacher : 'Викладач не вказаний' }})
                            </option>
                        @endforeach
                    </select>
                    <small style="color: #666; font-size: 12px;">Оберіть тему, над якою хочете працювати</small>
                </div>

                <!-- Автоматично заповнені дані користувача -->
                <div style="background: #f8f9fa; border-radius: 8px; padding: 15px; margin-bottom: 20px;">
                    <h4 style="color: #495057; margin-bottom: 10px; font-size: 14px;">📋 Ваші дані (автоматично заповнено)</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div>
                            <strong style="color: #6c757d; font-size: 12px;">Ім'я:</strong>
                            <div style="color: #495057;">{{ Auth::user()->name }}</div>
                            <input type="hidden" name="student_name" value="{{ Auth::user()->name }}">
                        </div>
                        <div>
                            <strong style="color: #6c757d; font-size: 12px;">Email:</strong>
                            <div style="color: #495057;">{{ Auth::user()->email }}</div>
                            <input type="hidden" name="student_email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Ваш телефон:</label>
                        <input type="text" name="student_phone"
                               style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box;"
                               value="{{ old('student_phone', Auth::user()->phone) }}">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Ваша група:</label>
                        <input type="text" name="student_group"
                               style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box;"
                               value="{{ old('student_group', Auth::user()->group) }}">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #333; font-size: 16px;">Мотивація та досвід: <span style="color: red;">*</span></label>
                    <textarea name="motivation" rows="5" required
                              style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; resize: vertical;"
                              placeholder="Розкажіть, чому ви хочете працювати над цією темою, який у вас досвід, які навички маєте та що сподіваєтесь отримати від роботи (мінімум 50 символів)">{{ old('motivation') }}</textarea>
                    <small style="color: #666; font-size: 12px;">Детально опишіть вашу мотивацію та досвід (мінімум 50 символів)</small>
                </div>

                @if ($errors->any())
                    <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                        <strong>Помилки при заповненні форми:</strong>
                        <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                        {{ session('error') }}
                    </div>
                @endif

                <button type="submit" style="background-color: #007bff; color: white; padding: 15px 30px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 16px; width: 100%;">
                    📤 Подати заявку на тему
                </button>
            </form>
                @endif
            @endauth



        </div>
    </section>
<script>
function showExportLoading(button) {
    const btnText = button.querySelector('.btn-text');
    const btnLoading = button.querySelector('.btn-loading');

    if (btnText && btnLoading) {
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline';
        button.style.pointerEvents = 'none';
        button.style.opacity = '0.7';

        // Повертаємо кнопку в нормальний стан через 10 секунд
        setTimeout(() => {
            btnText.style.display = 'inline';
            btnLoading.style.display = 'none';
            button.style.pointerEvents = 'auto';
            button.style.opacity = '1';
        }, 10000);
    }
}
</script>

@endsection
