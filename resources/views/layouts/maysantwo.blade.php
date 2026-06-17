@include('includes.header')
<!-- ===== HERO SECTION WITH WAVE ===== -->
<section id="home" class="mt-10 relative min-h-screen flex items-center justify-center overflow-hidden bg-cover bg-center bg-no-repeat" style="background-image: url('/layout.jpg')">

    <div class="absolute inset-0 bg-gradient-to-bl from-brand-600/90 via-brand-800/85 to-brand-900/90"></div>

    <!-- Decorative Elements -->
    <div class="absolute top-20 right-20 w-72 h-72 bg-gold-400/10 rounded-full blur-3xl float"></div>
    <div class="absolute bottom-40 left-10 w-96 h-96 bg-brand-900/20 rounded-full blur-3xl"></div>

    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto pt-40 pb-20">
        <!-- Main Title -->
        <h1 class="text-4xl sm:text-5xl md:text-7xl font-extrabold text-white leading-tight mb-8">
            @yield('title')
        </h1>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('booking.index') }}" class="flex items-center gap-2 bg-gold-400 text-brand-900 px-8 py-4 rounded-full font-bold text-lg hover:bg-gold-500 transition-all duration-300 shadow-xl shadow-gold-400/20 hover:shadow-gold-500/30 hover:scale-105">
                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                احجزي استشارتك الآن
            </a>
            <a href="{{ route('alldepart.index') }}" class="flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white/20 transition-all duration-300 hover:scale-105">
                تعرفي على خدماتنا
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
        </div>
    </div>

    <!-- Simple Wave SVG at the Bottom -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
            <path fill="#ffffff" d="M0,192L48,186.7C96,181,192,171,288,181.3C384,192,480,224,576,224C672,224,768,192,864,176C960,160,1056,160,1152,165.3C1248,171,1344,181,1392,186.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

<!-- ===== MAIN CONTENT ===== -->
<main class="relative z-10">
    @yield('contentpage')
</main>

@include('includes.footer')
