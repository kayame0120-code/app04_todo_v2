<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODOアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <div class="header__logo">
            <a href="/">Todo</a>
        </div>
        <div class="header__nav">
            <nav>
                <a href="/categories">カテゴリー一覧</a>
            </nav>
            @yield('header-button')
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>