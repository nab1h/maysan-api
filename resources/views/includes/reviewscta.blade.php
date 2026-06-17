<!-- ===== REVIEW CTA SECTION ===== -->
<section class="py-16 md:py-24 bg-brand-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 reveal">

        <div class="bg-[#135158] rounded-3xl overflow-hidden shadow-2xl shadow-[#135158]/20 flex flex-col lg:flex-row">

            <div class="lg:w-1/2 relative min-h-[300px] lg:min-h-[500px]">
                <img src="cta.jpeg"
                    alt="فرع ميسان"
                    class="absolute inset-0 w-full h-full object-cover">

                <div class="absolute inset-0 bg-gradient-to-t lg:bg-gradient-to-l from-[#135158] via-[#135158]/50 to-transparent"></div>

                <div class="absolute bottom-8 right-8 z-10 hidden lg:block">
                    <span class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-5 py-2 rounded-full text-sm font-bold">ميثان كلينك</span>
                </div>
            </div>

            <div class="lg:w-1/2 p-8 md:p-12 lg:p-16 flex flex-col justify-center text-center lg:text-right relative">

                <div class="absolute top-0 left-0 w-32 h-32 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-2xl"></div>

                <div class="relative z-10">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-6">
                        <i data-lucide="star" class="w-8 h-8 text-gold-400"></i>
                    </div>

                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight mb-3">
                        هل زرتِ فرع من فروع ميسان؟
                    </h2>
                    <h3 class="text-xl sm:text-2xl font-bold text-gold-400 mb-4">
                        شاركينا رأيكِ وتجربتكِ!
                    </h3>

                    <p class="text-white/70 text-base leading-relaxed max-w-md mx-auto lg:mx-0 mb-8">
                        رأيكِ يهمنا جداً! تساعدنا تقييماتكِ وكلماتكِ على التحسين المستمر وضمان تقديم أفضل تجربة جمالية وعناية.
                    </p>

                    <a href="{{ route('reviews.index') }}" class="group inline-flex items-center gap-3 bg-gold-400 text-brand-900 px-8 py-4 rounded-full font-bold text-base hover:bg-gold-500 transition-all duration-300 shadow-xl shadow-gold-400/20 hover:shadow-gold-500/40 hover:scale-105">
                        <i data-lucide="pen-line" class="w-5 h-5 group-hover:animate-pulse"></i>
                        اكتبي تقييمكِ الآن
                    </a>

                    <p class="mt-6 text-white/40 text-sm flex items-center justify-center lg:justify-start gap-2">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        يستغرق الأمر أقل من دقيقة
                    </p>
                </div>

            </div>
        </div>

    </div>
</section>
