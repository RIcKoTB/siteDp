<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Мій Сайт')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Структура хедера */
        .site-header {
            position: relative;
            display: flex;
            align-items: center;
        }

        .header-inner {
            display: flex;
            align-items: center;
            width: 100%;
        }

        /* Основна навігація */
        .main-nav {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: 20px;
        }

        .main-nav a {
            padding: 8px 12px;
            white-space: nowrap;
            font-size: 14px;
        }

        /* Секція авторизації - абсолютно справа */
        .auth-section {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1001;
        }

        /* Стилі для користувача */
        .user-link {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #28a745;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background 0.3s ease;
        }

        .user-link:hover {
            background: #f8f9fa;
        }

        .user-name {
            white-space: nowrap;
        }

        .dropdown-arrow {
            font-size: 10px;
            opacity: 0.7;
        }

        /* Dropdown меню користувача */
        .user-dropdown {
            position: relative;
        }

        .user-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            min-width: 220px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .user-dropdown:hover .user-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .user-info {
            padding: 12px 16px;
            background: #f8f9fa;
            border-radius: 8px 8px 0 0;
            border-bottom: 1px solid #e9ecef;
        }

        .user-email {
            font-size: 12px;
            color: #666;
            margin-bottom: 4px;
        }

        .user-role {
            font-size: 11px;
            color: #28a745;
            font-weight: 500;
        }

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            width: 100%;
            background: none;
            border: none;
            padding: 12px 16px;
            text-align: left;
            color: #dc3545;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.2s ease;
            border-radius: 0 0 8px 8px;
        }

        .logout-btn:hover {
            background: #f8f9fa;
        }

        /* Кнопка входу */
        .login-btn {
            background: #007bff;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .login-btn:hover {
            background: #0056b3;
            color: white;
        }

        /* Адаптивність */
        @media (max-width: 1200px) {
            .main-nav {
                gap: 10px;
                margin: 0 15px;
            }

            .main-nav a {
                padding: 6px 8px;
                font-size: 13px;
            }
        }

        @media (max-width: 1000px) {
            .main-nav {
                gap: 8px;
                margin: 0 10px;
            }

            .main-nav a {
                padding: 5px 6px;
                font-size: 12px;
            }

            .user-link {
                font-size: 13px;
                padding: 6px 8px;
            }
        }

        @media (max-width: 768px) {
            .site-header {
                flex-direction: column;
                align-items: stretch;
            }

            .header-inner {
                flex-direction: column;
                align-items: stretch;
            }

            .main-nav {
                flex-direction: column;
                gap: 0;
                margin: 10px 0;
            }

            .main-nav a {
                padding: 12px 0;
                width: 100%;
                text-align: center;
                border-bottom: 1px solid #eee;
                font-size: 14px;
            }

            .auth-section {
                position: static;
                transform: none;
                margin: 10px 0;
                text-align: center;
            }

            .user-menu {
                right: auto;
                left: 50%;
                transform: translateX(-50%) translateY(-10px);
            }

            .user-dropdown:hover .user-menu {
                transform: translateX(-50%) translateY(0);
            }
        }
    </style>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggle = document.getElementById('menu-toggle');
            const nav = document.querySelector('.main-nav');
            toggle.addEventListener('click', () => nav.classList.toggle('active'));
        });
    </script>

    @yield('scripts')
    @stack("styles")
</head>
<body>

<header class="site-header">
    <div class="container header-inner">
        <a href="/" class="logo">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Логотип" class="logo-img">
            <span class="logo-text">ЦК ПІТ</span>
        </a>

        <div id="menu-toggle" class="menu-toggle">&#9776;</div>

        <nav class="main-nav" id="mainNav">
            <a href="/">Головна</a>
            <a href="/about">Про нас</a>
            <a href="/news">Новини</a>

            <div class="dropdown">
                <a href="#">ОПП ▾</a>
                <div class="dropdown-menu">
                    <a href="{{ route("programs.index") }}">Освітньо-професійна програма</a>
                    <a href="{{ route("surveys.index") }}">Опитування</a>
                </div>
        </div>
            <div class="dropdown">
                    <a href="{{ route('education.index') }}">Освітні компоненти ▾</a>
                    <div class="dropdown-menu">
                        <a href="{{ route('education.index') }}">Всі предмети</a>
                        @foreach ($educationalCategories as $category)
                            <a href="{{ route('education.category', $category->slug) }}">
                                @if($category->icon){{ $category->icon }} @endif{{ $category->name }}
                            </a>
                        @endforeach
                    </div>
            </div>

            <div class="dropdown">
                <a href="#">Практична підготовка ▾</a>
                <div class="dropdown-menu">
                    @foreach ($practicalCategories as $category)
                        <a href="{{ route('practical.category', $category->slug) }}">
                            {{ $category->title }}
                        </a>
                    @endforeach
        </div>
        </div>


            <a href="/public/view/graduates.html">Випускники</a>
        </nav>

    </div>

    <!-- Окрема секція авторизації поза контейнером -->
    <div class="auth-section">
        @auth
            <div class="dropdown user-dropdown">
                <a href="#" class="user-link">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="dropdown-arrow">▾</span>
                </a>
                <div class="dropdown-menu user-menu">
                    <div class="user-info">
                        <div class="user-email">{{ Auth::user()->email }}</div>
                        <div class="user-role">
                            {{ Auth::user()->role === 'student' ? 'Студент' : 'Викладач' }}
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-btn">
                            Вийти з системи
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="login-btn">
                Увійти
            </a>
        @endauth
    </div>
</header>

<main class="site-main">
    @yield('content')
</main>

<footer class="site-footer">
    <div class="container">
        &copy; {{ date('Y') }} Мій Сайт. Усі права захищено.
    </div>
</footer>

    @stack("scripts")
</body>
</html>
