<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ميثان | عيادة التجميل المتخصصة</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
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
                        src="logo.png"
                        alt="logo">
                </a>

                <!-- Desktop Nav Links -->
                <div class="hidden lg:flex items-center gap-1">
                    <a href="#home" class="nav-link px-5 py-2 rounded-full text-brand-800 font-semibold bg-brand-50 transition-all duration-300">الرئيسية</a>
                    <a href="#services" class="nav-link px-5 py-2 rounded-full text-gray-500 hover:text-brand-800 hover:bg-brand-50 font-medium transition-all duration-300">خدماتنا</a>
                    <a href="#about" class="nav-link px-5 py-2 rounded-full text-gray-500 hover:text-brand-800 hover:bg-brand-50 font-medium transition-all duration-300">من نحن</a>
                    <a href="#results" class="nav-link px-5 py-2 rounded-full text-gray-500 hover:text-brand-800 hover:bg-brand-50 font-medium transition-300">النتائج</a>
                    <a href="#testimonials" class="nav-link px-5 py-2 rounded-full text-gray-500 hover:text-brand-800 hover:bg-brand-50 font-medium transition-all duration-300">آراء العملاء</a>
                    <a href="#booking" class="nav-link px-5 py-2 rounded-full text-gray-500 hover:text-brand-800 hover:bg-brand-50 font-medium transition-all duration-300">احجز الآن</a>
                </div>

                <!-- CTA + Mobile Toggle -->
                <div class="flex items-center gap-3">
                    <a href="#booking" class="hidden sm:flex items-center gap-2 bg-brand-800 text-white px-6 py-3 rounded-full font-semibold hover:bg-brand-700 transition-all duration-300 hover:shadow-lg hover:shadow-brand-800/25">
                        <i data-lucide="calendar-check" class="w-4 h-4"></i>
                        احجزي موعدك
                    </a>
                    <a href="tel:+966500000000" class="hidden sm:flex items-center gap-2 text-brand-800 font-semibold hover:text-gold-500 transition-colors">
                        <i data-lucide="phone" class="w-4 h-4"></i>
                        <span class="text-sm">966500000000+</span>
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
    <div id="mobileMenu" class="mobile-menu fixed top-0 right-0 w-80 h-full bg-white z-[60] shadow-2xl">
        <div class="p-6">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-xl bg-brand-800 flex items-center justify-center">
                        <i data-lucide="sparkles" class="w-5 h-5 text-gold-400"></i>
                    </div>
                    <span class="font-bold text-brand-800">جلو كلينك</span>
                </div>
                <button id="closeMenu" class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div class="flex flex-col gap-2">
                <a href="#home" class="mobile-link px-4 py-3 rounded-xl text-brand-800 font-semibold bg-brand-50">الرئيسية</a>
                <a href="#services" class="mobile-link px-4 py-3 rounded-xl text-gray-600 hover:bg-brand-50 hover:text-brand-800 transition-colors">خدماتنا</a>
                <a href="#about" class="mobile-link px-4 py-3 rounded-xl text-gray-600 hover:bg-brand-50 hover:text-brand-800 transition-colors">من نحن</a>
                <a href="#results" class="mobile-link px-4 py-3 rounded-xl text-gray-600 hover:bg-brand-50 hover:text-brand-800 transition-colors">النتائج</a>
                <a href="#testimonials" class="mobile-link px-4 py-3 rounded-xl text-gray-600 hover:bg-brand-50 hover:text-brand-800 transition-colors">آراء العملاء</a>
                <a href="#booking" class="mobile-link px-4 py-3 rounded-xl text-gray-600 hover:bg-brand-50 hover:text-brand-800 transition-colors">احجز الآن</a>
            </div>
            <div class="mt-8 pt-6 border-t border-gray-100">
                <a href="#booking" class="flex items-center justify-center gap-2 bg-brand-800 text-white w-full py-3 rounded-xl font-semibold hover:bg-brand-700 transition-colors">
                    <i data-lucide="calendar-check" class="w-4 h-4"></i>
                    احجزي موعدك الآن
                </a>
                <a href="tel:+966500000000" class="flex items-center justify-center gap-2 mt-3 text-brand-800 font-semibold">
                    <i data-lucide="phone" class="w-4 h-4"></i>
                    966500000000+
                </a>
            </div>
        </div>
    </div>
    <div id="menuOverlay" class="fixed inset-0 bg-black/40 z-[55] hidden opacity-0 transition-opacity duration-300"></div>



    <!-- ===== SERVICES ===== -->
    <section id="services" class="py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-16 reveal">
                <div class="inline-flex items-center gap-2 bg-brand-50 rounded-full px-5 py-2 mb-4">
                    <i data-lucide="heart" class="w-4 h-4 text-brand-800"></i>
                    <span class="text-brand-800 font-semibold text-sm">خدماتنا المتخصصة</span>
                </div>
                <h2 class="text-3xl lg:text-5xl font-black text-brand-800 mb-4">كل ما تحتاجينه <span class="text-gold-500">لجمالكِ</span></h2>
                <p class="text-gray-500 text-lg">نقدم مجموعة شاملة من خدمات التجميل المتقدمة بأحدث التقنيات العالمية</p>
            </div>

            <!-- Services Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Service 1 -->
                <div class="service-card bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 reveal">
                    <div class="service-icon w-14 h-14 rounded-2xl bg-brand-50 text-brand-800 flex items-center justify-center mb-5 transition-all duration-300">
                        <i data-lucide="sparkles" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-800 mb-3">تقنيات البشرة المتقدمة</h3>
                    <p class="text-gray-500 leading-relaxed mb-4">علاجات حديثة لتجديد البشرة وعلاج التصبغات والحنكلة بأجهزة الليزر والأشعة</p>
                    <div class="flex items-center gap-2 text-brand-800 font-semibold text-sm">
                        <span>اقرئي المزيد</span>
                        <i data-lucide="arrow-left" class="w-4 h-4 service-arrow opacity-0 transition-all duration-300"></i>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="service-card bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 reveal">
                    <div class="service-icon w-14 h-14 rounded-2xl bg-brand-50 text-brand-800 flex items-center justify-center mb-5 transition-all duration-300">
                        <i data-lucide="syringe" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-800 mb-3">الحقن التجميلي</h3>
                    <p class="text-gray-500 leading-relaxed mb-4">فيلر وبوتوكس وميزوثيرابي بأعلى معايير الجودة والسلامة لنتائج طبيعية ومذهلة</p>
                    <div class="flex items-center gap-2 text-brand-800 font-semibold text-sm">
                        <span>اقرئي المزيد</span>
                        <i data-lucide="arrow-left" class="w-4 h-4 service-arrow opacity-0 transition-all duration-300"></i>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="service-card bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 reveal">
                    <div class="service-icon w-14 h-14 rounded-2xl bg-brand-50 text-brand-800 flex items-center justify-center mb-5 transition-all duration-300">
                        <i data-lucide="scissors" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-800 mb-3">نحت الجسم</h3>
                    <p class="text-gray-500 leading-relaxed mb-4">تقنيات متقدمة لنحت الجسم والتخلص من الدهون العنيدة بشد الجلد وتنسيق القوام</p>
                    <div class="flex items-center gap-2 text-brand-800 font-semibold text-sm">
                        <span>اقرئي المزيد</span>
                        <i data-lucide="arrow-left" class="w-4 h-4 service-arrow opacity-0 transition-all duration-300"></i>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="service-card bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 reveal">
                    <div class="service-icon w-14 h-14 rounded-2xl bg-brand-50 text-brand-800 flex items-center justify-center mb-5 transition-all duration-300">
                        <i data-lucide="droplets" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-800 mb-3">علاج تساقط الشعر</h3>
                    <p class="text-gray-500 leading-relaxed mb-4">بلازما الغنية بالصفائح الدموية وميزوثيرابي الشعر لإنعاش بصيلات وتكثيف الشعر</p>
                    <div class="flex items-center gap-2 text-brand-800 font-semibold text-sm">
                        <span>اقرئي المزيد</span>
                        <i data-lucide="arrow-left" class="w-4 h-4 service-arrow opacity-0 transition-all duration-300"></i>
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="service-card bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 reveal">
                    <div class="service-icon w-14 h-14 rounded-2xl bg-brand-50 text-brand-800 flex items-center justify-center mb-5 transition-all duration-300">
                        <i data-lucide="eye" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-800 mb-3">تجميل العيون</h3>
                    <p class="text-gray-500 leading-relaxed mb-4">شد الجفون وعلاج الهالات السوداء وتجميل محيط العين لإطلالة شابة ومشرقة</p>
                    <div class="flex items-center gap-2 text-brand-800 font-semibold text-sm">
                        <span>اقرئي المزيد</span>
                        <i data-lucide="arrow-left" class="w-4 h-4 service-arrow opacity-0 transition-all duration-300"></i>
                    </div>
                </div>

                <!-- Service 6 -->
                <div class="service-card bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 reveal">
                    <div class="service-icon w-14 h-14 rounded-2xl bg-brand-50 text-brand-800 flex items-center justify-center mb-5 transition-all duration-300">
                        <i data-lucide="smile" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-800 mb-3">تجميل الشفاه</h3>
                    <p class="text-gray-500 leading-relaxed mb-4">فيلر الشفاه بأساليب طبيعية للحصول على شفاه ممتلئة ومتناسقة بشكل أنيق</p>
                    <div class="flex items-center gap-2 text-brand-800 font-semibold text-sm">
                        <span>اقرئي المزيد</span>
                        <i data-lucide="arrow-left" class="w-4 h-4 service-arrow opacity-0 transition-all duration-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>


    

    <!-- ===== ABOUT ===== -->
    <section id="about" class="py-20 lg:py-28 bg-brand-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <!-- Image Side -->
                <div class="relative reveal">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-brand-800/10">
                        <img src="https://picsum.photos/seed/doctor-beauty5/700/900.jpg" alt="طبيبة العيادة" class="w-full h-[500px] lg:h-[600px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-900/60 to-transparent"></div>
                        <!-- Floating card -->
                        <div class="absolute bottom-6 right-6 bg-white rounded-2xl p-4 shadow-xl float">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-gold-400 flex items-center justify-center">
                                    <i data-lucide="award" class="w-6 h-6 text-brand-900"></i>
                                </div>
                                <div>
                                    <div class="text-2xl font-black text-brand-800">+15</div>
                                    <div class="text-xs text-gray-500">عام خبرة معتمدة</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative -->
                    <div class="absolute -top-4 -left-4 w-24 h-24 border-2 border-gold-400/30 rounded-3xl -z-10"></div>
                    <div class="absolute -bottom-4 -right-4 w-32 h-32 border-2 border-brand-800/10 rounded-3xl -z-10"></div>
                </div>

                <!-- Text Side -->
                <div class="reveal">
                    <div class="inline-flex items-center gap-2 bg-brand-800/10 rounded-full px-5 py-2 mb-4">
                        <i data-lucide="info" class="w-4 h-4 text-brand-800"></i>
                        <span class="text-brand-800 font-semibold text-sm">من نحن</span>
                    </div>
                    <h2 class="text-3xl lg:text-5xl font-black text-brand-800 mb-6 leading-tight">نحن نصنع <span class="text-gold-500">الجمال</span> بثقة واحترافية</h2>
                    <p class="text-gray-500 text-lg leading-relaxed mb-6">
                        في مجموعة ميسان الطبية، نؤمن أن كل تفصيلة صغيرة تصنع فرقًا كبيرًا. انطلقنا كمنظومة متكاملة منذ عشر سنوات لنجمع تحت سقف واحد الطب الحديث والجمال الراقي، لنلبي احتياجات عملائنا في جميع التخصصات، بدءًا من الجراحة التجميلية، مرورًا بخدمات البشرة والليزر، وصولًا إلى الأسنان والطب العام
                    </p>
                    <p class="text-gray-500 leading-relaxed mb-8">
                        تقديم خدمات طبية وجمالية متكاملة، تعتمد على التقنيات الحديثة والخبرة العالمية، مع ضمان أعلى معايير الأمان والجودة.
                    </p>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-brand-800 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="check" class="w-5 h-5 text-gold-400"></i>
                            </div>
                            <span class="text-brand-800 font-semibold text-sm">التميز الطبي.</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-brand-800 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="check" class="w-5 h-5 text-gold-400"></i>
                            </div>
                            <span class="text-brand-800 font-semibold text-sm">الإنسانية في التعامل.</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-brand-800 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="check" class="w-5 h-5 text-gold-400"></i>
                            </div>
                            <span class="text-brand-800 font-semibold text-sm">الأمانة والشفافية.</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-brand-800 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="check" class="w-5 h-5 text-gold-400"></i>
                            </div>
                            <span class="text-brand-800 font-semibold text-sm">الاستدامة في الخدمة.</span>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-brand-800 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="check" class="w-5 h-5 text-gold-400"></i>
                            </div>
                            <span class="text-brand-800 font-semibold text-sm">الابتكار والتطوير المستمر.</span>
                        </div>
                    </div>

                    <a href="#booking" class="group inline-flex items-center gap-3 bg-brand-800 text-white px-8 py-4 rounded-full font-bold hover:bg-brand-700 transition-all duration-300 hover:shadow-xl hover:shadow-brand-800/25">
                        تعرفي علينا أكثر
                        <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== RESULTS / GALLERY ===== -->
    <section id="results" class="py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16 reveal">
                <div class="inline-flex items-center gap-2 bg-brand-50 rounded-full px-5 py-2 mb-4">
                    <i data-lucide="image" class="w-4 h-4 text-brand-800"></i>
                    <span class="text-brand-800 font-semibold text-sm">نتائج حقيقية</span>
                </div>
                <h2 class="text-3xl lg:text-5xl font-black text-brand-800 mb-4">نتائج <span class="text-gold-500">تتحدث</span> عن نفسها</h2>
                <p class="text-gray-500 text-lg">شاهدي التحولات الحقيقية لعميلاتنا مع صور قبل وبعد</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 reveal">
                <div class="group relative rounded-2xl overflow-hidden shadow-lg cursor-pointer">
                    <img src="a.jpeg" alt="نتيجة علاج بشرة" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute bottom-0 right-0 left-0 p-5 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <span class="bg-gold-400 text-brand-900 text-xs font-bold px-3 py-1 rounded-full">قبل وبعد</span>
                        <h4 class="text-white font-bold text-lg mt-2">تجميل الوجه</h4>
                        <p class="text-white/70 text-sm">فيلر للوجه كامل</p>
                    </div>
                </div>

                <div class="group relative rounded-2xl overflow-hidden shadow-lg cursor-pointer">
                    <img src="b.jpeg" alt="نتيجة تجميل شفاه" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute bottom-0 right-0 left-0 p-5 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <span class="bg-gold-400 text-brand-900 text-xs font-bold px-3 py-1 rounded-full">قبل وبعد</span>
                        <h4 class="text-white font-bold text-lg mt-2">تجميل اندر ارم</h4>
                        <p class="text-white/70 text-sm">تنظيف عميق لمنطقة الاندر ارم</p>
                    </div>
                </div>

                <div class="group relative rounded-2xl overflow-hidden shadow-lg cursor-pointer sm:col-span-2 lg:col-span-1">
                    <img src="c.jpeg" alt="نتيجة نحت جسم" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute bottom-0 right-0 left-0 p-5 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <span class="bg-gold-400 text-brand-900 text-xs font-bold px-3 py-1 rounded-full">قبل وبعد</span>
                        <h4 class="text-white font-bold text-lg mt-2">تجميل الشفايف</h4>
                        <p class="text-white/70 text-sm">فيلر</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA BANNER ===== -->
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://picsum.photos/seed/spa-luxury7/1920/600.jpg" alt="خلفية" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-brand-800/90"></div>
        </div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-5 py-2 mb-6">
                <i data-lucide="gift" class="w-4 h-4 text-gold-400"></i>
                <span class="text-white/90 font-semibold text-sm">عرض خاص</span>
            </div>
            <h2 class="text-3xl lg:text-5xl font-black text-white mb-4">استشارتك الأولى <span class="text-gold-400">مجاناً</span></h2>
            <p class="text-white/70 text-lg mb-8 max-w-xl mx-auto">احصلي على استشارة مجانية مع أفضل أطباء التجميل، وخصم 20% على أول جلسة عند الحجز الآن</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#booking" class="group flex items-center gap-3 bg-gold-400 text-brand-900 px-8 py-4 rounded-full font-bold text-lg hover:bg-gold-500 transition-all duration-300 hover:shadow-xl hover:shadow-gold-400/25">
                    احجزي الآن
                    <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <a href="tel:+966500000000" class="flex items-center gap-3 bg-white/10 backdrop-blur-sm border border-white/30 text-white px-8 py-4 rounded-full font-semibold hover:bg-white/20 transition-all">
                    <i data-lucide="phone" class="w-5 h-5"></i>
                    اتصلي بنا
                </a>
            </div>
        </div>
    </section>

    <!-- ===== TESTIMONIALS ===== -->
    <section id="testimonials" class="py-20 lg:py-28 bg-brand-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16 reveal">
                <div class="inline-flex items-center gap-2 bg-brand-800/10 rounded-full px-5 py-2 mb-4">
                    <i data-lucide="message-circle" class="w-4 h-4 text-brand-800"></i>
                    <span class="text-brand-800 font-semibold text-sm">آراء العملاء</span>
                </div>
                <h2 class="text-3xl lg:text-5xl font-black text-brand-800 mb-4">ماذا تقول <span class="text-gold-500">عميلاتنا</span></h2>
                <p class="text-gray-500 text-lg">تجارب حقيقية من عميلات حقيقيات</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 reveal">
                <!-- Testimonial 1 -->
                <div class="testimonial-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="flex gap-1 mb-4">
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-6">"تجربة رائعة! النتائج فاقت توقعاتي بكثير. الدكتورة كانت محترفة جداً وشرحت لي كل خطوة. بشرة أصبحت مشرقة وصحية."</p>
                    <div class="flex items-center gap-3">
                        <img src="https://picsum.photos/seed/client1face/48/48.jpg" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <div class="font-bold text-brand-800">سارة العتيبي</div>
                            <div class="text-sm text-gray-400">علاج البشرة بالليزر</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="flex gap-1 mb-4">
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-6">"أفضل عيادة تجميل زرتها. النظافة والترتيب والاهتمام بالتفاصيل شيء مميز. شكراً لكم على النتائج المذهلة في نحت الجسم."</p>
                    <div class="flex items-center gap-3">
                        <img src="https://picsum.photos/seed/client2face/48/48.jpg" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <div class="font-bold text-brand-800">نورة الشمري</div>
                            <div class="text-sm text-gray-400">نحت الجسم</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="flex gap-1 mb-4">
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-gold-400 fill-gold-400"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-6">"كنت خائفة من الحقن التجميلي لكن الطاقم الطبي جعلني مطمئنة تماماً. النتيجة طبيعية جداً وكل صديقاتي لاحظوا الفرق."</p>
                    <div class="flex items-center gap-3">
                        <img src="https://picsum.photos/seed/client3face/48/48.jpg" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <div class="font-bold text-brand-800">ريم القحطاني</div>
                            <div class="text-sm text-gray-400">حقن فيلر وبوتوكس</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== BOOKING FORM ===== -->
    <section id="booking" class="py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-start">
                <!-- Info Side -->
                <div class="reveal">
                    <div class="inline-flex items-center gap-2 bg-brand-50 rounded-full px-5 py-2 mb-4">
                        <i data-lucide="calendar" class="w-4 h-4 text-brand-800"></i>
                        <span class="text-brand-800 font-semibold text-sm">احجزي موعدك</span>
                    </div>
                    <h2 class="text-3xl lg:text-5xl font-black text-brand-800 mb-6 leading-tight">خطوة واحدة <span class="text-gold-500">نحو جمالكِ</span></h2>
                    <p class="text-gray-500 text-lg leading-relaxed mb-8">احجزي استشارتك المجانية الآن واتركي العناية بجمالك لأخصائيينا المعتمدين</p>

                    <div class="space-y-5 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="map-pin" class="w-5 h-5 text-brand-800"></i>
                            </div>
                            <div>
                                <div class="font-bold text-brand-800">العنوان</div>
                                <div class="text-gray-500 text-sm">الرياض، حي العليا، شارع التحلية</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="clock" class="w-5 h-5 text-brand-800"></i>
                            </div>
                            <div>
                                <div class="font-bold text-brand-800">ساعات العمل</div>
                                <div class="text-gray-500 text-sm">السبت - الخميس: 10 صباحاً - 10 مساءً</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="phone" class="w-5 h-5 text-brand-800"></i>
                            </div>
                            <div>
                                <div class="font-bold text-brand-800">الهاتف</div>
                                <div class="text-gray-500 text-sm">966500000000+</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="mail" class="w-5 h-5 text-brand-800"></i>
                            </div>
                            <div>
                                <div class="font-bold text-brand-800">البريد الإلكتروني</div>
                                <div class="text-gray-500 text-sm">info@glowclinic.sa</div>
                            </div>
                        </div>
                    </div>

                    <!-- Social -->
                    <div class="flex items-center gap-3">
                        <a href="#" class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 hover:bg-brand-800 hover:text-white transition-all">
                            <i data-lucide="instagram" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 hover:bg-brand-800 hover:text-white transition-all">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 hover:bg-brand-800 hover:text-white transition-all">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 hover:bg-brand-800 hover:text-white transition-all">
                            <i data-lucide="message-circle" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>

                <!-- Form Side -->
                <div class="reveal">
                    <div class="bg-white rounded-3xl shadow-2xl shadow-brand-800/10 border border-gray-100 p-8 lg:p-10">
                        <h3 class="text-2xl font-bold text-brand-800 mb-6">حجز استشارة مجانية</h3>
                        <form id="bookingForm" class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-brand-800 mb-2">الاسم الكامل</label>
                                <input type="text" required class="form-input w-full border border-gray-200 rounded-xl px-4 py-3 text-brand-800 placeholder-gray-400 focus:outline-none transition-all" placeholder="أدخلي اسمكِ">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-brand-800 mb-2">رقم الجوال</label>
                                    <input type="tel" required class="form-input w-full border border-gray-200 rounded-xl px-4 py-3 text-brand-800 placeholder-gray-400 focus:outline-none transition-all" placeholder="05xxxxxxxx">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-brand-800 mb-2">العمر</label>
                                    <input type="number" class="form-input w-full border border-gray-200 rounded-xl px-4 py-3 text-brand-800 placeholder-gray-400 focus:outline-none transition-all" placeholder="العمر">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-brand-800 mb-2">الخدمة المطلوبة</label>
                                <select required class="form-input w-full border border-gray-200 rounded-xl px-4 py-3 text-brand-800 focus:outline-none transition-all bg-white">
                                    <option value="">اختاري الخدمة</option>
                                    <option>تقنيات البشرة المتقدمة</option>
                                    <option>الحقن التجميلي</option>
                                    <option>نحت الجسم</option>
                                    <option>علاج تساقط الشعر</option>
                                    <option>تجميل العيون</option>
                                    <option>تجميل الشفاه</option>
                                    <option>استشارة عامة</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-brand-800 mb-2">التاريخ المفضل</label>
                                <input type="date" class="form-input w-full border border-gray-200 rounded-xl px-4 py-3 text-brand-800 focus:outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-brand-800 mb-2">ملاحظات إضافية</label>
                                <textarea rows="3" class="form-input w-full border border-gray-200 rounded-xl px-4 py-3 text-brand-800 placeholder-gray-400 focus:outline-none transition-all resize-none" placeholder="أي تفاصيل تريدين إخبارنا بها..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-brand-800 text-white py-4 rounded-xl font-bold text-lg hover:bg-brand-700 transition-all duration-300 hover:shadow-xl hover:shadow-brand-800/25 flex items-center justify-center gap-2">
                                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                                تأكيد الحجز
                            </button>
                        </form>
                        <!-- Success message -->
                        <div id="successMsg" class="hidden text-center py-8">
                            <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="check-circle" class="w-8 h-8 text-green-500"></i>
                            </div>
                            <h4 class="text-xl font-bold text-brand-800 mb-2">تم الحجز بنجاح!</h4>
                            <p class="text-gray-500">سنتواصل معكِ قريباً لتأكيد الموعد</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== آخر المقالات ===== -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- عنوان السيكشن -->
            <div class="text-center max-w-2xl mx-auto mb-12">
                <div class="inline-flex items-center gap-2 bg-[#135158]/10 rounded-full px-5 py-2 mb-4">
                    <i class="fa-solid fa-newspaper text-[#135158] text-sm"></i>
                    <span class="text-[#135158] font-semibold text-sm">مدونة الجمال</span>
                </div>
                <h2 class="text-3xl lg:text-4xl font-black text-[#135158] mb-4">أحدث <span class="text-[#d4a853]">المقالات</span> والنصائح</h2>
                <p class="text-gray-500 text-lg">اكتشفي أحدث المقالات والأسرار من خبرائنا للحفاظ على جمالكِ ونضارتكِ</p>
            </div>

            <!-- شبكة المقالات -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($latestArticles as $article)
                <article class="group bg-gray-50 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <!-- صورة المقال -->
                    <a href="{{ route('articles.show', $article->slug) }}" class="block overflow-hidden">
                        @if($article->image)
                        <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                        <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                            <i class="fa-solid fa-newspaper text-4xl text-gray-400"></i>
                        </div>
                        @endif
                    </a>

                    <div class="p-6">
                        <!-- القسم والتاريخ -->
                        <div class="flex items-center gap-3 mb-3">
                            @if($article->department)
                            <span class="text-xs font-bold text-[#d4a853] bg-[#d4a853]/10 px-3 py-1 rounded-full">{{ $article->department->name }}</span>
                            @endif
                            <span class="text-xs text-gray-400">{{ $article->created_at->format('Y/m/d') }}</span>
                        </div>

                        <!-- العنوان -->
                        <h3 class="text-xl font-bold text-[#135158] mb-3 line-clamp-2 group-hover:text-[#d4a853] transition leading-tight">
                            <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                        </h3>

                        <!-- الملخص -->
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-4">{{ $article->excerpt }}</p>

                        <!-- زر اقرأ المزيد -->
                        <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center gap-2 text-[#135158] font-semibold text-sm group-hover:text-[#d4a853] transition">
                            اقرئي المزيد
                            <i class="fa-solid fa-arrow-left text-xs group-hover:-translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </article>
                @empty
                <div class="col-span-full text-center py-8 text-gray-400">
                    <i class="fa-solid fa-newspaper text-3xl mb-2 block"></i>
                    لا توجد مقالات حالياً
                </div>
                @endforelse
            </div>

            <!-- زر عرض كل المقالات -->
            @if($latestArticles->count() > 0)
            <div class="text-center mt-10">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 bg-[#135158] text-white px-8 py-3.5 rounded-full font-bold hover:bg-[#0a3a40] transition shadow-lg shadow-[#135158]/25">
                    تصفحي كل المقالات
                    <i class="fa-solid fa-arrow-left text-sm"></i>
                </a>
            </div>
            @endif

        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-brand-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                <!-- Brand -->
                <div class="sm:col-span-2 lg:col-span-1">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center">
                            <i data-lucide="sparkles" class="w-6 h-6 text-gold-400"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">جلو كلينك</h3>
                            <p class="text-xs text-white/50">GLOW CLINIC</p>
                        </div>
                    </div>
                    <p class="text-white/60 leading-relaxed text-sm">وجهتك الأولى للجمال والأناقة. نقدم أحدث تقنيات التجميل بأيدي خبراء معتمدين دولياً.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold text-lg mb-5">روابط سريعة</h4>
                    <ul class="space-y-3">
                        <li><a href="#home" class="text-white/60 hover:text-gold-400 transition-colors text-sm">الرئيسية</a></li>
                        <li><a href="#services" class="text-white/60 hover:text-gold-400 transition-colors text-sm">خدماتنا</a></li>
                        <li><a href="#about" class="text-white/60 hover:text-gold-400 transition-colors text-sm">من نحن</a></li>
                        <li><a href="#results" class="text-white/60 hover:text-gold-400 transition-colors text-sm">النتائج</a></li>
                        <li><a href="#booking" class="text-white/60 hover:text-gold-400 transition-colors text-sm">احجز الآن</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h4 class="font-bold text-lg mb-5">خدماتنا</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-white/60 hover:text-gold-400 transition-colors text-sm">تقنيات البشرة</a></li>
                        <li><a href="#" class="text-white/60 hover:text-gold-400 transition-colors text-sm">الحقن التجميلي</a></li>
                        <li><a href="#" class="text-white/60 hover:text-gold-400 transition-colors text-sm">نحت الجسم</a></li>
                        <li><a href="#" class="text-white/60 hover:text-gold-400 transition-colors text-sm">علاج الشعر</a></li>
                        <li><a href="#" class="text-white/60 hover:text-gold-400 transition-colors text-sm">تجميل العيون</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-bold text-lg mb-5">تواصلي معنا</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-2 text-white/60 text-sm">
                            <i data-lucide="map-pin" class="w-4 h-4 flex-shrink-0"></i>
                            الرياض، حي العليا
                        </li>
                        <li class="flex items-center gap-2 text-white/60 text-sm">
                            <i data-lucide="phone" class="w-4 h-4 flex-shrink-0"></i>
                            966500000000+
                        </li>
                        <li class="flex items-center gap-2 text-white/60 text-sm">
                            <i data-lucide="mail" class="w-4 h-4 flex-shrink-0"></i>
                            info@glowclinic.sa
                        </li>
                    </ul>
                    <div class="flex items-center gap-3 mt-5">
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-gold-400 hover:text-brand-900 transition-all">
                            <i data-lucide="instagram" class="w-4 h-4"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-gold-400 hover:text-brand-900 transition-all">
                            <i data-lucide="twitter" class="w-4 h-4"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-gold-400 hover:text-brand-900 transition-all">
                            <i data-lucide="facebook" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/10 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-white/40 text-sm">© 2025 جلو كلينك. جميع الحقوق محفوظة</p>
                <div class="flex gap-6">
                    <a href="#" class="text-white/40 hover:text-white/70 text-sm transition-colors">سياسة الخصوصية</a>
                    <a href="#" class="text-white/40 hover:text-white/70 text-sm transition-colors">الشروط والأحكام</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ===== WHATSAPP FLOATING BUTTON ===== -->
    <a href="https://wa.me/966500000000" target="_blank" class="fixed bottom-6 left-6 z-50 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-xl shadow-green-500/30 hover:bg-green-600 hover:scale-110 transition-all duration-300 pulse-ring">
        <i data-lucide="message-circle" class="w-7 h-7 text-white"></i>
    </a>

    <!-- ===== SCRIPTS ===== -->
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // ===== HERO SLIDER =====
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.dot');
        const progressBar = document.getElementById('slideProgress');
        let currentSlide = 0;
        let slideInterval;
        const slideDuration = 5000;

        function goToSlide(index) {
            slides[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('active');
            currentSlide = index;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
            resetProgress();
        }

        function nextSlide() {
            goToSlide((currentSlide + 1) % slides.length);
        }

        function prevSlide() {
            goToSlide((currentSlide - 1 + slides.length) % slides.length);
        }

        function resetProgress() {
            progressBar.style.transition = 'none';
            progressBar.style.width = '0%';
            setTimeout(() => {
                progressBar.style.transition = `width ${slideDuration}ms linear`;
                progressBar.style.width = '100%';
            }, 50);
        }

        function startAutoSlide() {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, slideDuration);
            resetProgress();
        }

        document.getElementById('nextSlide').addEventListener('click', () => {
            nextSlide();
            startAutoSlide();
        });

        document.getElementById('prevSlide').addEventListener('click', () => {
            prevSlide();
            startAutoSlide();
        });

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                goToSlide(parseInt(dot.dataset.index));
                startAutoSlide();
            });
        });

        // Touch/Swipe support for hero
        let touchStartX = 0;
        const heroSection = document.getElementById('home');
        heroSection.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        });
        heroSection.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].screenX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) nextSlide();
                else prevSlide();
                startAutoSlide();
            }
        });

        startAutoSlide();

        // ===== NAVBAR SCROLL =====
        const navbar = document.getElementById('navbar');
        const navInner = document.getElementById('navInner');
        const logo = document.getElementById('logo');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                // حالة التصغير - بعد التمرير
                navbar.classList.add('nav-scrolled');
                navInner.classList.remove('h-40');
                navInner.classList.add('h-20');
                logo.classList.remove('h-40');
                logo.classList.add('h-16');
            } else {
                // حالة الطبيعي - فوق
                navbar.classList.remove('nav-scrolled');
                navInner.classList.remove('h-20');
                navInner.classList.add('h-40');
                logo.classList.remove('h-16');
                logo.classList.add('h-40');
            }
        });

        // ===== MOBILE MENU =====
        const menuBtn = document.getElementById('menuBtn');
        const closeMenuBtn = document.getElementById('closeMenu');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuOverlay = document.getElementById('menuOverlay');

        function openMenu() {
            mobileMenu.classList.add('open');
            menuOverlay.classList.remove('hidden');
            setTimeout(() => menuOverlay.style.opacity = '1', 10);
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            mobileMenu.classList.remove('open');
            menuOverlay.style.opacity = '0';
            setTimeout(() => menuOverlay.classList.add('hidden'), 300);
            document.body.style.overflow = '';
        }

        menuBtn.addEventListener('click', openMenu);
        closeMenuBtn.addEventListener('click', closeMenu);
        menuOverlay.addEventListener('click', closeMenu);

        document.querySelectorAll('.mobile-link').forEach(link => {
            link.addEventListener('click', closeMenu);
        });

        // ===== SCROLL REVEAL =====
        const revealElements = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, i * 100);
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));

        // ===== COUNTER ANIMATION =====
        const counters = document.querySelectorAll('[data-count]');
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.dataset.count);
                    let current = 0;
                    const increment = target / 60;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        if (target >= 1000) {
                            entry.target.textContent = Math.floor(current).toLocaleString('en') + '+';
                        } else {
                            entry.target.textContent = Math.floor(current) + (target === 98 ? '%' : '+');
                        }
                    }, 30);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        counters.forEach(counter => counterObserver.observe(counter));

        // ===== SMOOTH SCROLL =====
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offset = navbar.offsetHeight;
                    const top = target.getBoundingClientRect().top + window.scrollY - offset;
                    window.scrollTo({
                        top,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // ===== ACTIVE NAV LINK =====
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 120;
                if (window.scrollY >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('text-brand-800', 'bg-brand-50', 'font-semibold');
                link.classList.add('text-gray-500', 'font-medium');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('text-brand-800', 'bg-brand-50', 'font-semibold');
                    link.classList.remove('text-gray-500', 'font-medium');
                }
            });
        });

        // ===== BOOKING FORM =====
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            this.style.display = 'none';
            document.getElementById('successMsg').classList.remove('hidden');
            lucide.createIcons();
        });
    </script>
</body>

</html>
