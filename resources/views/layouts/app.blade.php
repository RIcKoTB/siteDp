<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Мій Сайт')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggle = document.getElementById('menu-toggle');
            const nav = document.querySelector('.main-nav');
            toggle.addEventListener('click', () => nav.classList.toggle('active'));
        });
    </script>
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
                    <a href="/public/view/program.html">Освітньо-професійна програма</a>
                    <a href="/public/view/survey.html">Опитування</a>
                </div>
            </div>

            <div class="dropdown">
                <a href="#">Освітні компоненти ▾</a>
                <div class="dropdown-menu">
                    <a href="/public/view/practice_programming.html">Програмування</a>
                    <a href="/public/view/practice_db.html">Бази даних</a>
                    <a href="/public/view/practice_web.html">Веб-розробка</a>
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
</header>

<main class="site-main">
    @yield('content')
</main>

<footer class="site-footer">
    <div class="container">
        &copy; {{ date('Y') }} Мій Сайт. Усі права захищено.
    </div>
</footer>

</body>
</html>
