<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Avora') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;400;700;900&family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app-CuY7xmCv.css') }}">

    <style>
        :root {
            --bg: #f8fafc;
            --card: #ffffff;
            --border: #e2e8f0;
            --muted: #64748b;
            --accent: #E60914;
            --surface: #f1f5f9;
        }

        body {
            background-color: var(--bg);
            color: #0f172a;
            font-family: 'Tajawal', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent);
        }

        .app-bg {
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(230, 9, 20, 0.06), transparent),
                #f8fafc;
            pointer-events: none;
            z-index: -1;
        }

        .qr-container canvas {
            max-width: 100%;
            height: auto;
            display: block;
            margin: auto;
        }
    </style>
</head>

<body class="antialiased">
    <div class="app-bg"></div>

    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')

        @isset($header)
        <header class="border-b border-[#e2e8f0] bg-white/80 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <main class="">
            {{ $slot }}
        </main>
    </div>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
    <script src="{{ asset('js/app-YtA_lim_.js') }}" defer></script>
</body>

</html>
