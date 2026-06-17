@extends('layouts.maysan')

@section('title', 'الرئسية')

@section('content')
<!-- ===== HERO SECTION ===== -->
<section id="home" class="relative h-screen min-h-[650px] md:min-h-[800px] overflow-hidden mt-24 md:mt-40">

    <!-- Slides -->
    @foreach ($galleryImages as $image)
    <div class="hero-slide {{ $loop->first ? 'active' : '' }} absolute inset-0 w-full h-full transition-opacity duration-700">

        <img src="{{ asset('storage/' . $image->path) }}"
            alt="عيادة تجميل"
            class="w-full h-full object-cover object-center">

        <div class="absolute inset-0 bg-gradient-to-l from-brand-900/70 via-brand-900/70 to-brand-900/40"></div>
    </div>
    @endforeach

    <!-- Hero Content -->
    <div class="absolute inset-0 flex items-center z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-2xl">

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

            @foreach ($stats as $stat)
            <div class="counter-box text-center p-4 rounded-xl bg-brand-50/50">
                <div class="text-3xl lg:text-4xl font-black text-brand-800 mb-1" data-count="{{ $stat->number }}">0</div>
                <div class="text-sm text-gray-500">{{ $stat->title_ar }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== OFFERS / العروض ===== -->
@isset($offers)
<section id="offers" class="py-20 lg:py-28 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-72 h-72 bg-gold-400/5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-brand-800/5 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- عنوان السيكشن -->
        <div class="text-center max-w-2xl mx-auto mb-14 reveal">
            <div class="inline-flex items-center gap-2 bg-gold-400/10 rounded-full px-5 py-2 mb-4">
                <i data-lucide="gift" class="w-4 h-4 text-gold-500"></i>
                <span class="text-gold-600 font-semibold text-sm">عروض لفترة محدودة</span>
            </div>
            <h2 class="text-3xl lg:text-5xl font-black text-brand-800 mb-4">عروض <span class="text-gold-500">حصرية</span> لا تُفوَّت</h2>
            <p class="text-gray-500 text-lg">اغتنمي الفرصة واحجزي الآن قبل انتهاء العروض المحدودة</p>
        </div>
    </div>

    <!-- ===== الشريط المتحرك الدائم ===== -->
    <div class="relative">
        <!-- تدرج على الأطراف -->
        <div class="absolute top-0 bottom-0 right-0 w-20 md:w-32 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>
        <div class="absolute top-0 bottom-0 left-0 w-20 md:w-32 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>

        <!-- الشريط -->
        <div class="marquee-container" dir="ltr">
            <div class="marquee-track marquee-rtl">

                <!-- === المجموعة الأولى === -->
                @foreach($offers as $offer)
                @php
                $discount = 0;
                if($offer->old_price > 0) {
                $discount = round((($offer->old_price - $offer->price) / $offer->old_price) * 100);
                }
                $isActive = now()->gte($offer->start_date) && now()->lte($offer->end_date);
                @endphp

                <div class="marquee-card">
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 w-[300px] md:w-[340px] h-full group">
                        <div class="relative h-52 overflow-hidden">
                            <img src="{{ asset('storage/' . $offer->img) }}"
                                alt="{{ $offer->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-900/40 via-transparent to-transparent"></div>

                            @if($discount > 0)
                            <div class="absolute top-3 left-3 bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-black px-4 py-1.5 rounded-full shadow-md flex items-center gap-1">
                                <i data-lucide="flame" class="w-3 h-3"></i>
                                خصم {{ $discount }}%
                            </div>
                            @endif

                            @if($isActive)
                            <div class="absolute top-3 right-3 bg-gold-400 text-brand-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-md flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 bg-brand-900 rounded-full animate-pulse"></span>
                                عرض ساري
                            </div>
                            @endif
                        </div>

                        <div class="p-5">
                            <h3 class="text-base font-black text-brand-800 mb-2 line-clamp-1 leading-snug">{{ $offer->title }}</h3>

                            <div class="flex items-end gap-2 mb-3">
                                <span class="text-xl font-black text-brand-800">{{ $offer->price }} <span class="text-xs font-semibold">ر.س</span></span>
                                @if($offer->old_price)
                                <span class="text-sm text-gray-400 line-through decoration-red-400">{{ $offer->old_price }} ر.س</span>
                                @endif
                            </div>

                            <div class="flex items-center gap-1.5 text-gray-400 text-xs mb-4 bg-brand-50/60 px-3 py-2 rounded-lg">
                                <i data-lucide="clock" class="w-3.5 h-3.5 text-gold-500 flex-shrink-0"></i>
                                <span>ينتهي في: {{ \Carbon\Carbon::parse($offer->end_date)->format('d M Y') }}</span>
                            </div>

                            <a href="{{ route('booking.index') }}"
                                class="offer-book-btn w-full flex items-center justify-center gap-2 bg-gold-400 hover:bg-gold-500 text-brand-900 font-bold py-2.5 rounded-xl text-sm transition-all duration-300 shadow-md hover:shadow-lg group/btn">
                                <i data-lucide="calendar-check" class="w-4 h-4 group-hover/btn:animate-bounce"></i>
                                احجزي الآن
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- === المجموعة الثانية (نسخة مكررة للتمرير اللانهائي) === -->
                @foreach($offers as $offer)
                @php
                $discount = 0;
                if($offer->old_price > 0) {
                $discount = round((($offer->old_price - $offer->price) / $offer->old_price) * 100);
                }
                $isActive = now()->gte($offer->start_date) && now()->lte($offer->end_date);
                @endphp

                <div class="marquee-card">
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 w-[300px] md:w-[340px] h-full group">
                        <div class="relative h-52 overflow-hidden">
                            <img src="{{ asset('storage/' . $offer->img) }}"
                                alt="{{ $offer->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-900/40 via-transparent to-transparent"></div>

                            @if($discount > 0)
                            <div class="absolute top-3 left-3 bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-black px-4 py-1.5 rounded-full shadow-md flex items-center gap-1">
                                <i data-lucide="flame" class="w-3 h-3"></i>
                                خصم {{ $discount }}%
                            </div>
                            @endif

                            @if($isActive)
                            <div class="absolute top-3 right-3 bg-gold-400 text-brand-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-md flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 bg-brand-900 rounded-full animate-pulse"></span>
                                عرض ساري
                            </div>
                            @endif
                        </div>

                        <div class="p-5">
                            <h3 class="text-base font-black text-brand-800 mb-2 line-clamp-1 leading-snug">{{ $offer->title }}</h3>

                            <div class="flex items-end gap-2 mb-3">
                                <span class="text-xl font-black text-brand-800">{{ $offer->price }} <span class="text-xs font-semibold">ر.س</span></span>
                                @if($offer->old_price)
                                <span class="text-sm text-gray-400 line-through decoration-red-400">{{ $offer->old_price }} ر.س</span>
                                @endif
                            </div>

                            <div class="flex items-center gap-1.5 text-gray-400 text-xs mb-4 bg-brand-50/60 px-3 py-2 rounded-lg">
                                <i data-lucide="clock" class="w-3.5 h-3.5 text-gold-500 flex-shrink-0"></i>
                                <span>ينتهي في: {{ \Carbon\Carbon::parse($offer->end_date)->format('d M Y') }}</span>
                            </div>

                            <a href="{{ route('booking.index') }}"
                                class="offer-book-btn w-full flex items-center justify-center gap-2 bg-gold-400 hover:bg-gold-500 text-brand-900 font-bold py-2.5 rounded-xl text-sm transition-all duration-300 shadow-md hover:shadow-lg group/btn">
                                <i data-lucide="calendar-check" class="w-4 h-4 group-hover/btn:animate-bounce"></i>
                                احجزي الآن
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
@endisset


@include('includes.working')
@include('includes.departments')
@include('includes.tobooking')
@include('includes.before-after')
@include('includes.reviewscta')
@include('includes.doctors')
@include('includes.viewreviews')
@include('includes.payment-way')
@include('includes.articals')


<script>
    // Initialize Lucide Icons


    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.dot');
    const progressBar = document.getElementById('slideProgress');
    let currentSlide = 0;
    let slideInterval;
    const slideDuration = 5000;

    // التحقق من وجود سلايدات لتجنب الأخطاء
    if (slides.length > 0) {
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
            if (!progressBar) return;
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
    }
</script>
@endsection
