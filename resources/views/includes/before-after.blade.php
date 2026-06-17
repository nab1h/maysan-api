<!-- ===== BEFORE & AFTER SECTION ===== -->
@isset($beforeAfters)
<section id="results" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="text-center mb-16 reveal">
            <span class="text-gold-400 text-sm font-bold tracking-wider">النتائج الحقيقية</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-2">قبل وبعد</h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto">شاهدي التحولات الحقيقية لعملائنا والنتائج المذهلة التي نحققها باستخدام أحدث التقنيات.</p>
        </div>

        <!-- Results Grid - Modified to 3 square cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($beforeAfters->take(3) as $result)

            <div class="group relative aspect-square rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 reveal">

                <img src="{{ asset('storage/' . $result->image) }}"
                    alt="قبل وبعد"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-brand-900/80 via-brand-900/40 to-transparent z-10 flex items-end p-5">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('storage/' . $setting->logo) }}" class="w-full h-full object-contain" alt="logo" />
                        </div>
                        <span class="text-white font-bold text-sm">قبل و بعد</span>
                    </div>
                </div>

                <div class="absolute inset-0 bg-brand-900/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-[5]"></div>

            </div>
            @endforeach
        </div>

    </div>
</section>
@endisset
