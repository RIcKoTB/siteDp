<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Мій Сайт')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>

<!-- HEADER -->
<header class="site-header">
    <div class="container header-inner">
        <a href="/" class="logo">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Логотип" class="logo-img">
            <span class="logo-text">ЦК ПІТ</span>
        </a>
        <nav class="main-nav">
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
                <a href="#">Практична ▾</a>
                <div class="dropdown-menu">
                    <a href="/public/view/practice_programming.html">Програмування</a>
                    <a href="/public/view/practice_db.html">Бази даних</a>
                    <a href="/public/view/practice_web.html">Веб-розробка</a>
                </div>
            </div>

            <div class="dropdown">
                <a href="#">Курсові/Диплом ▾</a>
                <div class="dropdown-menu">
                    <a href="/public/view/projects_course.html">Курсові роботи</a>
                    <a href="/public/view/projects_diploma.html">Дипломне проєктування</a>
                </div>
            </div>

            <a href="/public/view/graduates.html">Випускники</a>
        </nav>

    </div>
</header>



<!-- MAIN CONTENT -->
<main class="site-main">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="site-footer">
    <div class="container">
        &copy; {{ date('Y') }} Мій Сайт. Усі права захищено.
    </div>
</footer>

</body>
</html>
