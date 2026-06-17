<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/app-CuY7xmCv.css') }}">
</head>
<style>
    :root {
        --bg: #f8fafc;
        --card: #ffffff;
        --border: #e2e8f0;
        --muted: #64748b;
        --accent: #E60914;
        --accent-light: #ff3a46;
        --surface: #f1f5f9;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: 'Tajawal', sans-serif;
        background: var(--bg);
        color: #0f172a;
        overflow-x: hidden;
    }

    .page-bg {
        position: fixed;
        inset: 0;
        background:
            radial-gradient(ellipse 80% 50% at 50% -20%, rgba(230, 9, 20, 0.06), transparent),
            radial-gradient(ellipse 60% 40% at 80% 60%, rgba(230, 9, 20, 0.04), transparent),
            radial-gradient(ellipse 40% 30% at 20% 80%, rgba(230, 9, 20, 0.02), transparent);
        pointer-events: none;
        z-index: -1;
    }
</style>

<body>
    <!-- الخلفية أصبحت عنصراً منفصلاً -->
    <div class="page-bg"></div>

    <!-- المحتوى أصبح في عنصر منفصل وفي طبقة أعلى -->
    <div class="min-h-screen flex flex-col sm:justify-center px-6 items-center pt-6 sm:pt-0 relative z-10">
        <div>
            <a href="/">
                <img src="{{ asset('avora.png') }}" class="h-[220px] w-[220px]" />
            </a>
        </div>

        <div class="w-full sm:max-w-md bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
            {{ $slot }}
        </div>
    </div>
    <script src="{{ asset('js/app-YtA_lim_.js') }}" defer></script>
</body>

</html>
