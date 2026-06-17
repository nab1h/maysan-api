<!-- ===== CTA BOOKING SECTION ===== -->
<section class="bg-[#135158] py-16 md:py-24 relative overflow-hidden">

    <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-black/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-10 text-center lg:text-right reveal">

            <div class="lg:max-w-2xl">
                <span class="inline-block px-4 py-1 bg-gold-400/10 border border-gold-400/20 rounded-full text-gold-400 text-sm font-bold mb-6">فرصة لا تفوّت</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-4">
                    جمالكِ يستحق الأفضل، <br>
                    <span class="text-gold-400">احجزي استشارتكِ الآن!</span>
                </h2>
                <p class="text-white/70 text-lg leading-relaxed max-w-xl mx-auto lg:mx-0">
                    لا تنتظري الغد لتبدئي رحلة العناية ببشرتكِ وجمالكِ. خبراؤنا جاهزون لتقديم أفضل الحلول المصممة خصيصاً لكِ في بيئة آمنة ومريحة.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 flex-shrink-0">
                <a href="{{ route('booking.index') }}" class="group flex items-center justify-center gap-3 bg-gold-400 text-brand-900 px-10 py-5 rounded-full font-bold text-lg hover:bg-gold-500 transition-all duration-300 shadow-2xl shadow-gold-400/20 hover:shadow-gold-500/40 hover:scale-105">
                    <i data-lucide="calendar-check" class="w-6 h-6 group-hover:animate-bounce"></i>
                    احجزي موعدك
                </a>

                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}" target="_blank" class="flex items-center justify-center gap-3 bg-white/10 backdrop-blur-sm border border-white/20 text-white px-8 py-5 rounded-full font-semibold hover:bg-white/20 transition-all duration-300 hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20.52 3.48A11.91 11.91 0 0 0 12.05 0C5.41 0 .02 5.39.02 12a11.9 11.9 0 0 0 1.64 6.03L0 24l6.21-1.63A11.9 11.9 0 0 0 12.05 24C18.69 24 24 18.61 24 12a11.86 11.86 0 0 0-3.48-8.52zM12.05 21.5a9.5 9.5 0 0 1-4.86-1.33l-.35-.2-3.69.97.99-3.59-.23-.37A9.5 9.5 0 1 1 21.55 12a9.47 9.47 0 0 1-9.5 9.5zm5.19-6.72c-.28-.14-1.65-.81-1.9-.9-.26-.09-.45-.14-.64.14-.19.28-.73.9-.9 1.09-.17.19-.33.21-.61.07-.28-.14-1.18-.43-2.24-1.37-.83-.74-1.39-1.65-1.56-1.93-.16-.28-.02-.43.12-.57.12-.12.28-.33.42-.49.14-.16.19-.28.28-.47.09-.19.05-.35-.02-.49-.07-.14-.64-1.54-.88-2.11-.23-.55-.47-.47-.64-.48h-.55c-.19 0-.49.07-.75.35-.26.28-1 .98-1 2.39s1.02 2.77 1.16 2.96c.14.19 2.02 3.08 4.9 4.32.68.29 1.21.46 1.62.59.68.22 1.3.19 1.79.12.55-.08 1.65-.67 1.88-1.32.23-.65.23-1.21.16-1.32-.07-.11-.26-.17-.54-.31z" />
                    </svg>
                    تواصلي واتساب
                </a>
            </div>

        </div>
    </div>
</section>
