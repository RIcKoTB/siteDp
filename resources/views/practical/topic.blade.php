@extends('layouts.app')

@section('title', $topic->title . ' - ' . $category->title)

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">
    
    <!-- Хлібні крихти -->
    <nav style="margin-bottom: 30px;">
        <div style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #6b7280;">
            <a href="{{ route('practical.index') }}" style="color: #3b82f6; text-decoration: none;">Практична підготовка</a>
            <span>→</span>
            <a href="{{ route('practical.category', $category->slug) }}" style="color: #3b82f6; text-decoration: none;">{{ $category->title }}</a>
            <span>→</span>
            <span style="color: #374151;">{{ $topic->title }}</span>
        </div>
    </nav>

    <!-- Заголовок теми -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 16px; padding: 40px; margin-bottom: 40px; color: white; position: relative; overflow: hidden;">
        <div style="position: absolute; top: 0; right: 0; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%; transform: translate(50%, -50%);"></div>
        <div style="position: relative; z-index: 1;">
            <h1 style="font-size: 32px; font-weight: bold; margin: 0 0 15px 0; line-height: 1.2;">{{ $topic->title }}</h1>
            <p style="font-size: 18px; opacity: 0.9; margin: 0; line-height: 1.5;">{{ $topic->description }}</p>
            
            <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 25px;">
                @if($topic->teacher)
                    <div style="display: flex; align-items: center; background: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 20px;">
                        <span style="margin-right: 8px;">👨‍🏫</span>
                        <span>{{ $topic->teacher }}</span>
                    </div>
                @endif
                
                @if($topic->hours)
                    <div style="display: flex; align-items: center; background: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 20px;">
                        <span style="margin-right: 8px;">⏱️</span>
                        <span>{{ $topic->hours }} годин</span>
                    </div>
                @endif
                
                <div style="display: flex; align-items: center; background: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 20px;">
                    <span style="margin-right: 8px;">📂</span>
                    <span>{{ $category->title }}</span>
                </div>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 350px; gap: 40px;">
        
        <!-- Основний контент -->
        <div>
            
            <!-- Керівник -->
            @if($topic->supervisor_name)
                <section style="background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 30px; margin-bottom: 30px;">
                    <h2 style="font-size: 24px; font-weight: bold; margin: 0 0 25px 0; color: #1f2937; display: flex; align-items: center;">
                        <span style="margin-right: 10px;">👨‍💼</span>
                        Керівник
                    </h2>

                    <div style="border: 1px solid #3b82f6; border-radius: 8px; padding: 20px; background: #f8faff;">
                        <h3 style="font-size: 18px; font-weight: 600; margin: 0 0 10px 0; color: #1f2937;">{{ $topic->supervisor_name }}</h3>

                        @if($topic->supervisor_position)
                            <p style="color: #6b7280; margin: 0 0 8px 0; font-size: 14px;">{{ $topic->supervisor_position }}</p>
                        @endif

                        <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 10px;">
                            @if($topic->supervisor_email)
                                <a href="mailto:{{ $topic->supervisor_email }}" style="color: #3b82f6; text-decoration: none; font-size: 14px; display: flex; align-items: center;">
                                    <span style="margin-right: 5px;">📧</span>
                                    {{ $topic->supervisor_email }}
                                </a>
                            @endif

                            @if($topic->supervisor_phone)
                                <a href="tel:{{ $topic->supervisor_phone }}" style="color: #3b82f6; text-decoration: none; font-size: 14px; display: flex; align-items: center;">
                                    <span style="margin-right: 5px;">📞</span>
                                    {{ $topic->supervisor_phone }}
                                </a>
                            @endif
                        </div>

                        @if($topic->supervisor_bio)
                            <p style="color: #374151; font-size: 14px; line-height: 1.5; margin: 10px 0 0 0;">{{ $topic->supervisor_bio }}</p>
                        @endif
                    </div>
                </section>
            @endif

            <!-- Вимоги -->
            @if($topic->requirements)
                <section style="background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 30px; margin-bottom: 30px;">
                    <h2 style="font-size: 24px; font-weight: bold; margin: 0 0 25px 0; color: #1f2937; display: flex; align-items: center;">
                        <span style="margin-right: 10px;">📋</span>
                        Вимоги до студента
                    </h2>

                    <div style="background: #f9fafb; border-radius: 8px; padding: 20px; border-left: 4px solid #f59e0b;">
                        <p style="color: #374151; font-size: 14px; line-height: 1.6; margin: 0;">{{ $topic->requirements }}</p>
                    </div>
                </section>
            @endif

            <!-- Етапи виконання -->
            @if($topic->stages && count($topic->stages) > 0)
                <section style="background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 30px; margin-bottom: 30px;">
                    <h2 style="font-size: 24px; font-weight: bold; margin: 0 0 25px 0; color: #1f2937; display: flex; align-items: center;">
                        <span style="margin-right: 10px;">⏱️</span>
                        Етапи виконання
                    </h2>

                    <div style="position: relative;">
                        @foreach($topic->stages as $index => $stage)
                            <div style="display: flex; margin-bottom: {{ $loop->last ? '0' : '25px' }};">
                                <!-- Лінія часу -->
                                <div style="flex-shrink: 0; width: 40px; display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
                                    <div style="width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; color: white;
                                        {{ ($stage['status'] ?? 'pending') === 'completed' ? 'background: #10b981;' : (($stage['status'] ?? 'pending') === 'in_progress' ? 'background: #f59e0b;' : 'background: #6b7280;') }}">
                                        {{ $index + 1 }}
                                    </div>
                                    @if(!$loop->last)
                                        <div style="width: 2px; height: 40px; background: #e5e7eb; margin-top: 5px;"></div>
                                    @endif
                                </div>

                                <!-- Контент етапу -->
                                <div style="flex: 1; padding-bottom: 20px;">
                                    <div style="display: flex; justify-content: between; align-items: start; margin-bottom: 8px;">
                                        <h3 style="font-size: 16px; font-weight: 600; margin: 0; color: #1f2937;">{{ $stage['title'] ?? 'Етап ' . ($index + 1) }}</h3>
                                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; margin-left: 10px;
                                            {{ ($stage['status'] ?? 'pending') === 'completed' ? 'background: #d1fae5; color: #065f46;' : (($stage['status'] ?? 'pending') === 'in_progress' ? 'background: #fef3c7; color: #92400e;' : 'background: #f3f4f6; color: #374151;') }}">
                                            {{ ($stage['status'] ?? 'pending') === 'completed' ? 'Завершено' : (($stage['status'] ?? 'pending') === 'in_progress' ? 'В процесі' : 'Очікує') }}
                                        </span>
                                    </div>

                                    @if(isset($stage['description']) && $stage['description'])
                                        <p style="color: #6b7280; margin: 0 0 10px 0; font-size: 14px; line-height: 1.5;">{{ $stage['description'] }}</p>
                                    @endif

                                    @if((isset($stage['start_date']) && $stage['start_date']) || (isset($stage['end_date']) && $stage['end_date']))
                                        <div style="display: flex; gap: 15px; font-size: 13px; color: #374151;">
                                            @if(isset($stage['start_date']) && $stage['start_date'])
                                                <span>📅 Початок: {{ \Carbon\Carbon::parse($stage['start_date'])->format('d.m.Y') }}</span>
                                            @endif
                                            @if(isset($stage['end_date']) && $stage['end_date'])
                                                <span>🏁 Завершення: {{ \Carbon\Carbon::parse($stage['end_date'])->format('d.m.Y') }}</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

        </div>

        <!-- Бічна панель -->
        <div>
            
            <!-- Корисні ресурси -->
            @if($topic->resources && count($topic->resources) > 0)
                <section style="background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 25px; margin-bottom: 25px;">
                    <h3 style="font-size: 20px; font-weight: bold; margin: 0 0 20px 0; color: #1f2937; display: flex; align-items: center;">
                        <span style="margin-right: 8px;">📚</span>
                        Корисні ресурси
                    </h3>

                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach($topic->resources as $resource)
                            <div style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 15px; {{ ($resource['is_required'] ?? false) ? 'border-color: #f59e0b; background: #fffbeb;' : '' }}">
                                <div style="display: flex; justify-content: between; align-items: start; margin-bottom: 8px;">
                                    <h4 style="font-size: 14px; font-weight: 600; margin: 0; color: #1f2937;">{{ $resource['title'] ?? 'Ресурс' }}</h4>
                                    @if($resource['is_required'] ?? false)
                                        <span style="background: #f59e0b; color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px;">Обов'язково</span>
                                    @endif
                                </div>

                                @if(isset($resource['description']) && $resource['description'])
                                    <p style="color: #6b7280; margin: 0 0 8px 0; font-size: 13px; line-height: 1.4;">{{ $resource['description'] }}</p>
                                @endif

                                @if(isset($resource['url']) && $resource['url'])
                                    <a href="{{ $resource['url'] }}" target="_blank" style="color: #3b82f6; text-decoration: none; font-size: 13px; display: flex; align-items: center;">
                                        <span style="margin-right: 5px;">
                                            @if(($resource['type'] ?? 'link') === 'video') 🎥
                                            @elseif(($resource['type'] ?? 'link') === 'book') 📖
                                            @elseif(($resource['type'] ?? 'link') === 'article') 📄
                                            @elseif(($resource['type'] ?? 'link') === 'file') 📁
                                            @else 🔗
                                            @endif
                                        </span>
                                        Перейти до ресурсу
                                        <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="margin-left: 4px;">
                                            <path d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                                            <path d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Консультації -->
            @if($topic->consultations && count($topic->consultations) > 0)
                <section style="background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 25px; margin-bottom: 25px;">
                    <h3 style="font-size: 20px; font-weight: bold; margin: 0 0 20px 0; color: #1f2937; display: flex; align-items: center;">
                        <span style="margin-right: 8px;">👥</span>
                        Консультації
                    </h3>

                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach($topic->consultations as $consultation)
                            <div style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 15px; background: #f8faff;">
                                <div style="display: flex; justify-content: between; align-items: start; margin-bottom: 8px;">
                                    <h4 style="font-size: 14px; font-weight: 600; margin: 0; color: #1f2937;">{{ $consultation['teacher'] ?? 'Викладач' }}</h4>
                                    <span style="background: #3b82f6; color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px;">Консультація</span>
                                </div>

                                <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 8px; font-size: 13px; color: #374151;">
                                    @if(isset($consultation['datetime']) && $consultation['datetime'])
                                        <span>📅 {{ \Carbon\Carbon::parse($consultation['datetime'])->format('d.m.Y H:i') }}</span>
                                    @endif
                                    @if(isset($consultation['location']) && $consultation['location'])
                                        <span>📍 {{ $consultation['location'] }}</span>
                                    @endif
                                </div>

                                @if(isset($consultation['notes']) && $consultation['notes'])
                                    <p style="color: #6b7280; margin: 0; font-size: 13px; line-height: 1.4;">{{ $consultation['notes'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Кнопка повернення -->
            <div style="text-align: center;">
                <a href="{{ route('practical.category', $category->slug) }}" 
                   style="display: inline-flex; align-items: center; background: #6b7280; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: background 0.3s;"
                   onmouseover="this.style.background='#4b5563'"
                   onmouseout="this.style.background='#6b7280'">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 8px;">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    Повернутися до списку тем
                </a>
            </div>

        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    div[style*="grid-template-columns: 1fr 350px"] {
        display: block !important;
    }
    
    div[style*="grid-template-columns: 1fr 350px"] > div:last-child {
        margin-top: 30px;
    }
}
</style>
@endsection
