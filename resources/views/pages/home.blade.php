@extends('layouts.maysan')

@section('title', 'ميثان')

@section('content')
<!-- ===== HERO SECTION ===== -->
<section id="home" class="relative h-screen min-h-[700px] overflow-hidden mt-40">
    <!-- Slides -->
    <div class="hero-slide active">
        <img src="1.png" alt="عيادة تجميل" class="w-full h-full">
        <div class="absolute inset-0 bg-gradient-to-l from-brand-900/90 via-brand-900/70 to-brand-900/40"></div>
    </div>
    <div class="hero-slide">
        <img src="2.png" alt="تجميل بشرة" class="w-full h-full ">
        <div class="absolute inset-0 bg-gradient-to-l from-brand-900/90 via-brand-900/70 to-brand-900/40"></div>
    </div>
    <div class="hero-slide">
        <img src="3.png" alt="علاج تجميلي" class="w-full h-full ">
        <div class="absolute inset-0 bg-gradient-to-l from-brand-900/90 via-brand-900/70 to-brand-900/40"></div>
    </div>

    <!-- Hero Content -->
    <div class="absolute inset-0 flex items-center z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-5 py-2 mb-6 reveal">
                    <span class="w-2 h-2 rounded-full bg-gold-400 animate-pulse"></span>
                    <span class="text-white/90 text-sm font-medium">أفضل عيادة تجميل معتمدة</span>
                </div>

                <h2 class="text-4xl sm:text-5xl lg:text-7xl font-black text-white leading-[2] mb-6 reveal">
                    جمالكِ
                    <span class="shimmer-text">يسبق</span>
                    <br>كل الأرقام
                </h2>

                <p class="text-lg sm:text-xl text-white/80 leading-relaxed mb-8 max-w-lg reveal">
                    تقديم خدمات طبية وجمالية متكاملة، تعتمد على التقنيات الحديثة والخبرة العالمية، مع ضمان أعلى معايير الأمان والجودة.
                </p>

                <div class="flex flex-wrap gap-4 mb-10 reveal">
                    <a href="#booking" class="group flex items-center gap-3 bg-gold-400 text-brand-900 px-8 py-4 rounded-full font-bold text-lg hover:bg-gold-500 transition-all duration-300 hover:shadow-xl hover:shadow-gold-400/25">
                        احجزي استشارتك المجانية
                        <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
                    </a>
                    <a href="#services" class="flex items-center gap-3 bg-white/10 backdrop-blur-sm border border-white/30 text-white px-8 py-4 rounded-full font-semibold hover:bg-white/20 transition-all duration-300">
                        <i data-lucide="play-circle" class="w-5 h-5"></i>
                        تعرفي علينا
                    </a>
                </div>

                <!-- Trust badges -->
                <div class="flex flex-wrap items-center gap-6 reveal">
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2 space-x-reverse">
                            <img src="https://picsum.photos/seed/face1/40/40.jpg" class="w-9 h-9 rounded-full border-2 border-white object-cover">
                            <img src="https://picsum.photos/seed/face2/40/40.jpg" class="w-9 h-9 rounded-full border-2 border-white object-cover">
                            <img src="https://picsum.photos/seed/face3/40/40.jpg" class="w-9 h-9 rounded-full border-2 border-white object-cover">
                            <div class="w-9 h-9 rounded-full border-2 border-white bg-gold-400 flex items-center justify-center text-brand-900 text-xs font-bold">+2K</div>
                        </div>
                        <span class="text-white/70 text-sm">عميلة سعيدة</span>
                    </div>
                    <div class="h-8 w-px bg-white/20"></div>
                    <div class="flex items-center gap-1">
                        <div class="flex gap-0.5">
                            <i data-lucide="star" class="w-4 h-4 text-gold-400 fill-gold-400"></i>
                            <i data-lucide="star" class="w-4 h-4 text-gold-400 fill-gold-400"></i>
                            <i data-lucide="star" class="w-4 h-4 text-gold-400 fill-gold-400"></i>
                            <i data-lucide="star" class="w-4 h-4 text-gold-400 fill-gold-400"></i>
                            <i data-lucide="star" class="w-4 h-4 text-gold-400 fill-gold-400"></i>
                        </div>
                        <span class="text-white/70 text-sm mr-1">4.9 تقييم</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Slider Controls -->
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex items-center gap-4">
        <button id="prevSlide" class="w-11 h-11 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center text-white hover:bg-white/20 transition-all">
            <i data-lucide="chevron-right" class="w-5 h-5"></i>
        </button>
        <div class="flex items-center gap-2" id="dotsContainer">
            <div class="dot active" data-index="0"></div>
            <div class="dot" data-index="1"></div>
            <div class="dot" data-index="2"></div>
            <div class="dot" data-index="3"></div>
        </div>
        <button id="nextSlide" class="w-11 h-11 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center text-white hover:bg-white/20 transition-all">
            <i data-lucide="chevron-left" class="w-5 h-5"></i>
        </button>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-10 right-8 z-20 hidden lg:flex flex-col items-center gap-2 text-white/50">
        <span class="text-xs tracking-widest rotate-180" style="writing-mode: vertical-rl;">اكتشفي المزيد</span>
        <div class="w-[1px] h-12 bg-white/30 relative overflow-hidden">
            <div class="w-full h-4 bg-gold-400 absolute animate-bounce"></div>
        </div>
    </div>
</section>

<!-- ===== STATS BAR ===== -->
<section class="relative z-10 -mt-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-2xl shadow-brand-800/10 p-6 sm:p-8 grid grid-cols-2 lg:grid-cols-4 gap-6 reveal">
            <div class="counter-box text-center p-4 rounded-xl bg-brand-50/50">
                <div class="text-3xl lg:text-4xl font-black text-brand-800 mb-1" data-count="15">0</div>
                <div class="text-sm text-gray-500">عام من الخبرة</div>
            </div>
            <div class="counter-box text-center p-4 rounded-xl bg-brand-50/50">
                <div class="text-3xl lg:text-4xl font-black text-brand-800 mb-1" data-count="20000">0</div>
                <div class="text-sm text-gray-500">عميلة راضية</div>
            </div>
            <div class="counter-box text-center p-4 rounded-xl bg-brand-50/50">
                <div class="text-3xl lg:text-4xl font-black text-brand-800 mb-1" data-count="50">0</div>
                <div class="text-sm text-gray-500">جهاز حديث</div>
            </div>
            <div class="counter-box text-center p-4 rounded-xl bg-brand-50/50">
                <div class="text-3xl lg:text-4xl font-black text-brand-800 mb-1" data-count="98">0</div>
                <div class="text-sm text-gray-500">نسبة رضا العملاء %</div>
            </div>
        </div>
    </div>
</section>

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
@include('includes.doctors')

@endsection
