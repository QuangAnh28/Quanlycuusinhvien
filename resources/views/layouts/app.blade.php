<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Quanlycuusinhvien')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main style="max-width: 900px; margin: 24px auto; padding: 0 16px;">
        @yield('content')
    </main>
</body>
</html>