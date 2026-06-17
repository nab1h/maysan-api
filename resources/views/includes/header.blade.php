<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Icons -->
    @if($setting->icon_180)
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/' . $setting->icon_180) }}">
    @endif

    @if($setting->icon_32)
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/' . $setting->icon_32) }}">
    @endif

    @if($setting->icon_16)
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/' . $setting->icon_16) }}">
    @endif

    @if($setting->manifest)
    <link rel="manifest" href="{{ asset('storage/' . $setting->manifest) }}">
    @endif
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#e8f0f1',
                            100: '#c5d9db',
                            200: '#9fbfc2',
                            300: '#79a5a9',
                            400: '#5c9297',
                            500: '#3f7f85',
                            600: '#2d6d74',
                            700: '#1f5a61',
                            800: '#135158',
                            900: '#0a3a40',
                        },
                        gold: {
                            400: '#d4a853',
                            500: '#c9952e',
                            600: '#b8841f',
                        }
                    },
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        * {
            font-family: 'Cairo', sans-serif;
        }

        /* Hero Slider */
        .hero-slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1.2s cubic-bezier(0.4, 0, 0.2, 1), transform 1.2s cubic-bezier(0.4, 0, 0.2, 1);
            transform: scale(1.05);
        }

        .hero-slide.active {
            opacity: 1;
            transform: scale(1);
        }

        /* Shimmer */
        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .shimmer-text {
            background: linear-gradient(90deg, #ffffff 0%, #d4a853 25%, #ffffff 50%, #d4a853 75%, #ffffff 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 4s linear infinite;
        }

        /* Float animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

        /* Pulse ring */
        @keyframes pulseRing {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }

            100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }

        .pulse-ring::before {
            content: '';
            position: absolute;
            inset: -4px;
            border: 2px solid #d4a853;
            border-radius: 50%;
            animation: pulseRing 2s ease-out infinite;
        }

        /* Scroll animations */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Navbar shadow on scroll */
        .nav-scrolled {
            box-shadow: 0 4px 30px rgba(19, 81, 88, 0.1);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #135158;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0a3a40;
        }

        /* Slider dots */
        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: all 0.3s;
        }

        .dot.active {
            background: #d4a853;
            width: 36px;
            border-radius: 6px;
        }

        /* Service card hover */
        .service-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(19, 81, 88, 0.15);
        }

        .service-card:hover .service-icon {
            background: #135158;
            color: white;
        }

        .service-card:hover .service-arrow {
            transform: translateX(-6px);
            opacity: 1;
        }

        /* Counter animation */
        .counter-box {
            position: relative;
            overflow: hidden;
        }

        .counter-box::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: counterShine 3s ease-in-out infinite;
        }

        @keyframes counterShine {
            0% {
                left: -100%;
            }

            50%,
            100% {
                left: 100%;
            }
        }

        /* Mobile menu */
        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-menu.open {
            transform: translateX(0);
        }

        /* Before/After slider */
        .ba-container {
            position: relative;
            overflow: hidden;
            cursor: col-resize;
        }

        .ba-after {
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100%;
            overflow: hidden;
        }

        .ba-slider {
            position: absolute;
            top: 0;
            left: 50%;
            width: 4px;
            height: 100%;
            background: #d4a853;
            transform: translateX(-50%);
            z-index: 10;
        }

        .ba-handle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 44px;
            height: 44px;
            background: #d4a853;
            border-radius: 50%;
            z-index: 11;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        /* Testimonial card */
        .testimonial-card {
            transition: all 0.4s;
        }

        .testimonial-card:hover {
            transform: scale(1.02);
        }

        /* Booking form focus */
        .form-input:focus {
            border-color: #135158;
            box-shadow: 0 0 0 3px rgba(19, 81, 88, 0.1);
        }

        /* Progress bar for slider */
        .slide-progress {
            height: 3px;
            background: #d4a853;
            transition: width linear;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            animation: marquee 30s linear infinite;
            will-change: transform;

        }

        .animate-marquee:hover {
            animation-play-state: paused;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .hero-slide {
            opacity: 0;
            position: absolute;
            inset: 0;
            transition: opacity 0.7s ease;
        }

        .hero-slide.active {
            opacity: 1;
            position: absolute;
            inset: 0;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* ========== OFFERS CAROUSEL ========== */
        .offers-track {
            display: flex;
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .offer-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .offer-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 60px rgba(19, 81, 88, 0.15);
        }

        .offer-card:hover .offer-img {
            transform: scale(1.08);
        }

        .offer-book-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .offer-book-btn::before {
            content: '';
            position: absolute;
            top: 0;
            right: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: right 0.5s ease;
        }

        .offer-book-btn:hover::before {
            right: 100%;
        }

        .offer-book-btn:hover {
            transform: scale(1.04);
            box-shadow: 0 0 25px rgba(212, 168, 83, 0.4);
        }

        @keyframes offerFloat {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-6px) rotate(-2deg);
            }
        }

        .offer-badge-float {
            animation: offerFloat 3s ease-in-out infinite;
        }

        @keyframes offerPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.03);
            }
        }

        .offer-progress-bar {
            animation: offerPulse 2.5s ease-in-out infinite;
        }

        .offer-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #c5d9db;
            cursor: pointer;
            transition: all 0.3s;
        }

        .offer-dot.active {
            width: 32px;
            border-radius: 6px;
            background: #135158;
        }

        .offer-nav-btn {
            transition: all 0.3s ease;
        }

        .offer-nav-btn:hover {
            background: #135158;
            color: white;
            border-color: #135158;
        }

        /* Toast */
        .toast-msg {
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .toast-msg.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* ===== INFINITE MARQUEE ===== */
        .marquee-container {
            overflow: hidden;
            width: 100%;
        }

        .marquee-track {
            display: flex;
            width: max-content;
            gap: 20px;
            padding: 10px 0;
        }

        .marquee-card {
            flex-shrink: 0;
        }

        /* حركة من اليمين لليسار - سريعة ولانهائية */
        .marquee-rtl {
            animation: marqueeScrollRTL 10s linear infinite;
        }

        .marquee-rtl:hover {
            animation-play-state: paused;
        }

        @keyframes marqueeScrollRTL {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* زر احجزي الآن تأثير */
        .offer-book-btn {
            position: relative;
            overflow: hidden;
        }

        .offer-book-btn::before {
            content: '';
            position: absolute;
            top: 0;
            right: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: right 0.5s ease;
        }

        .offer-book-btn:hover::before {
            right: 100%;
        }

        .offer-book-btn:hover {
            transform: scale(1.02);
            box-shadow: 0 0 20px rgba(212, 168, 83, 0.3);
        }
    </style>
</head>

<body class="bg-white text-gray-800 overflow-x-hidden">

    <!-- ===== NAVBAR ===== -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-white transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="navInner" class="flex items-center justify-between h-40 transition-all duration-500">

                <a href="#" class="flex items-center gap-3 group">
                    <img id="logo"
                        class="h-40 w-auto transition-all duration-500"
                        src="{{ asset('storage/' .$setting->logo)}}"
                        alt="logo">
                </a>

                <!-- Desktop Nav Links -->
                <div class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="nav-link px-5 py-2 rounded-full text-brand-800 font-semibold bg-brand-50 transition-all duration-300">الرئيسية</a>
                    <a href="{{ route('about.index') }}" class="nav-link px-5 py-2 rounded-full text-gray-500 hover:text-brand-800 hover:bg-brand-50 font-medium transition-300">حول</a>

                    <!-- خدمات Dropdown -->
                    <div class="relative group">
                        <a href="#services" class="nav-link flex items-center gap-1">
                            الخدمات
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform group-hover:rotate-180"></i>
                        </a>
                        <div class="absolute top-full right-0 w-56 bg-white rounded-2xl shadow-xl shadow-brand-800/10 border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50 pt-2">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs text-gray-400 font-bold uppercase">الأقسام</p>
                            </div>
                            <div class="py-2">
                                <a href="{{ route('alldepart.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-brand-50 transition-colors group/item">
                                    <span class="text-sm font-medium text-gray-700 group-hover/item:text-brand-900">جميع الخدمات</span>
                                </a>
                                @foreach($departments as $department)
                                <a href="{{ route('departments.services', $department->id) }}" class="flex items-center gap-3 px-4 py-3 hover:bg-brand-50 transition-colors group/item">
                                    <span class="text-sm font-medium text-gray-700 group-hover/item:text-brand-900">{{ $department->name }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('offers.index') }}" class="nav-link px-5 py-2 rounded-full text-gray-500 hover:text-brand-800 hover:bg-brand-50 font-medium transition-300">العروض</a>

                    <!-- الفروع Dropdown (جديد) -->
                    <div class="relative group">
                        <a href="{{ route('branches.index') }}" class="nav-link flex items-center gap-1">
                            الفروع
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform group-hover:rotate-180"></i>
                        </a>
                        <div class="absolute top-full right-0 w-56 bg-white rounded-2xl shadow-xl shadow-brand-800/10 border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50 pt-2">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs text-gray-400 font-bold uppercase">فروعنا</p>
                            </div>
                            <div class="py-2">
                                <a href="{{ route('branches.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-brand-50 transition-colors group/item">
                                    <span class="text-sm font-medium text-gray-700 group-hover/item:text-brand-900">جميع الفروع</span>
                                </a>
                                @isset($branches)
                                @foreach($branches as $branch)
                                <a href="{{ route('branch.show', $branch->id) }}" class="flex items-center gap-3 px-4 py-3 hover:bg-brand-50 transition-colors group/item">
                                    <span class="text-sm font-medium text-gray-700 group-hover/item:text-brand-900">ميسان {{ $branch->name }}</span>
                                </a>
                                @endforeach
                                @endisset
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('team.index') }}" class="nav-link px-5 py-2 rounded-full text-gray-500 hover:text-brand-800 hover:bg-brand-50 font-medium transition-all duration-300">الأطباء</a>
                    <a href="{{ route('articles.index') }}" class="nav-link px-5 py-2 rounded-full text-gray-500 hover:text-brand-800 hover:bg-brand-50 font-medium transition-all duration-300">المقالات</a>
                    <a href="{{ route('contact.index') }}" class="nav-link px-5 py-2 rounded-full text-gray-500 hover:text-brand-800 hover:bg-brand-50 font-medium transition-all duration-300">اتصل بنا</a>
                </div>

                <!-- CTA + Mobile Toggle -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('booking.index') }}" class="hidden sm:flex items-center gap-2 bg-brand-800 text-white px-6 py-3 rounded-full font-semibold hover:bg-brand-700 transition-all duration-300 hover:shadow-lg hover:shadow-brand-800/25">
                        <i data-lucide="calendar-check" class="w-4 h-4"></i>
                        احجزي موعدك
                    </a>
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $setting->mobile) }}" class="hidden sm:flex items-center gap-2 text-brand-800 font-semibold hover:text-gold-500 transition-colors">
                        <i data-lucide="phone" class="w-4 h-4"></i>
                        <span class="text-sm">{{ $setting->mobile }}</span>
                    </a>
                    <button id="menuBtn" class="lg:hidden w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 hover:bg-brand-100 transition-colors">
                        <i data-lucide="menu" class="w-5 h-5" id="menuIcon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Progress bar under nav -->
        <div class="h-[2px] bg-brand-50">
            <div id="slideProgress" class="slide-progress bg-brand-800" style="width: 0%"></div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu fixed top-0 right-0 w-80 max-w-[85vw] h-full bg-white z-[60] shadow-2xl overflow-y-auto">
        <div class="p-6 flex flex-col h-full">
            <div class="flex items-center justify-between mb-8">
                <img src="{{ asset('storage/' .$setting->logo)}}" class="h-14 w-auto object-contain" alt="Logo" />
                <button id="closeMenu" class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-red-50 hover:text-red-500 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="flex flex-col gap-1 flex-1">
                <a href="{{ route('home') }}" class="mobile-link px-4 py-3 rounded-xl text-brand-800 font-semibold bg-brand-50">الرئيسية</a>
                <a href="{{ route('about.index') }}" class="mobile-link px-4 py-3 rounded-xl text-gray-600 hover:bg-brand-50 hover:text-brand-800 transition-colors">من نحن</a>

                <!-- Services Accordion for Mobile -->
                <div class="flex flex-col">
                    <button id="mobileServicesBtn" class="flex items-center justify-between w-full px-4 py-3 rounded-xl text-gray-600 hover:bg-brand-50 hover:text-brand-800 transition-colors">
                        <span>الخدمات</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300" id="servicesChevron"></i>
                    </button>
                    <div id="mobileServicesMenu" class="hidden flex-col gap-1 pr-4 mt-1">
                        <a href="{{ route('alldepart.index') }}" class="px-4 py-2 rounded-lg text-sm text-gray-500 hover:bg-brand-50 hover:text-brand-800 transition-colors">جميع الخدمات</a>
                        @foreach($departments as $department)
                        <a href="{{ route('departments.services', $department->id) }}" class="px-4 py-2 rounded-lg text-sm text-gray-500 hover:bg-brand-50 hover:text-brand-800 transition-colors">{{ $department->name }}</a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('offers.index') }}" class="mobile-link px-4 py-3 rounded-xl text-gray-600 hover:bg-brand-50 hover:text-brand-800 transition-colors">العروض</a>

                <!-- Branches Accordion for Mobile (جديد) -->
                <div class="flex flex-col">
                    <button id="mobileBranchesBtn" class="flex items-center justify-between w-full px-4 py-3 rounded-xl text-gray-600 hover:bg-brand-50 hover:text-brand-800 transition-colors">
                        <span>الفروع</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300" id="branchesChevron"></i>
                    </button>
                    <div id="mobileBranchesMenu" class="hidden flex-col gap-1 pr-4 mt-1">
                        <a href="{{ route('branches.index') }}" class="px-4 py-2 rounded-lg text-sm text-gray-500 hover:bg-brand-50 hover:text-brand-800 transition-colors">جميع الفروع</a>
                        @isset($branches)
                        @foreach($branches as $branch)
                        <a href="{{ route('branch.show', $branch->id) }}" class="px-4 py-2 rounded-lg text-sm text-gray-500 hover:bg-brand-50 hover:text-brand-800 transition-colors">ميسان {{ $branch->name }}</a>
                        @endforeach
                        @endisset
                    </div>
                </div>

                <a href="{{ route('team.index') }}" class="mobile-link px-4 py-3 rounded-xl text-gray-600 hover:bg-brand-50 hover:text-brand-800 transition-colors">الأطباء</a>
                <a href="{{ route('articles.index') }}" class="mobile-link px-4 py-3 rounded-xl text-gray-600 hover:bg-brand-50 hover:text-brand-800 transition-colors">المقالات</a>
                <a href="{{ route('contact.index') }}" class="mobile-link px-4 py-3 rounded-xl text-gray-600 hover:bg-brand-50 hover:text-brand-800 transition-colors">اتصل بنا</a>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-100">
                <a href="{{ route('booking.index') }}" class="flex items-center justify-center gap-2 bg-brand-800 text-white w-full py-3.5 rounded-xl font-semibold hover:bg-brand-700 transition-colors">
                    <i data-lucide="calendar-check" class="w-4 h-4"></i>
                    احجزي موعدك الآن
                </a>
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $setting->mobile) }}" class="flex items-center justify-center gap-2 mt-3 text-brand-800 font-semibold py-2">
                    <i data-lucide="phone" class="w-4 h-4"></i>
                    {{ $setting->mobile }}
                </a>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="menuOverlay" class="fixed inset-0 bg-black/40 z-[55] hidden opacity-0 transition-opacity duration-300"></div>
