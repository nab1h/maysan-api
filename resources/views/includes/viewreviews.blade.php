<!-- ===== REVIEWS & VIDEO PAGE ===== -->
<div class="bg-brand-50/30 min-h-screen py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="text-center mb-16 reveal">
            <span class="text-gold-400 text-sm font-bold tracking-wider">آراء عملائنا</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-2">تجارب حقيقية، نتائج استثنائية</h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto">استمعي وشاهدي ماذا تقول عملاؤنا عن تجاربهن معنا في ميثان كلينك.</p>
        </div>

        <!-- Main Grid: Video + Reviews -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

            <!-- العمود الأيمن: الفيديو (ثابت أثناء التمرير في الديسكتوب) -->
            <div class="lg:sticky lg:top-28 space-y-6 reveal">
                <div class="bg-white rounded-3xl p-2 shadow-xl shadow-brand-800/5 border border-brand-100">
                    <!-- Video Player -->
                    <div class="relative rounded-2xl overflow-hidden aspect-[4/4] bg-brand-900">
                        <video controls class="w-full h-full object-cover" poster="https://images.unsplash.com/photo-1629909615184-74f495363b67?q=80&w=800&auto=format&fit=crop">
                            <!-- ضعي رابط الفيديو هنا -->
                            <source src="{{ asset('storage/' .$heroVideo->path) }}" type="video/mp4">
                            متصفحك لا يدعم تشغيل الفيديو.
                        </video>
                    </div>

                </div>

                <!-- تنبيه بسيط لتشغيل الصوت -->
                <div class="flex items-center justify-center gap-2 text-xs text-gray-400 bg-white p-3 rounded-xl border border-gray-100 shadow-sm">
                    <i class="fas fa-volume-up text-gold-400"></i>
                    <span>تأكدي من تشغيل الصوت لسماع رأي العميلات بوضوح</span>
                </div>
            </div>

            <!-- العمود الأيسر: التقييمات النصية -->
            <div class="space-y-6">
                @forelse($testimonials as $testimonial)
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition relative reveal">
                    <!-- Quote Icon -->
                    <i data-lucide="quote" class="absolute top-4 left-4 w-10 h-10 text-brand-100"></i>

                    <!-- Rating Stars -->
                    <div class="flex gap-1 mb-3">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                            @endfor
                            @for($i = $testimonial->rating; $i < 5; $i++)
                                <i class="far fa-star text-gray-300 text-sm"></i>
                                @endfor
                    </div>

                    <!-- Message -->
                    <p class="text-gray-700 mb-5 leading-relaxed relative z-10">{{ $testimonial->message }}</p>

                    <!-- User Info -->
                    <div class="flex items-center gap-3 border-t border-gray-100 pt-4">
                        <!-- Avatar (أول حرف من الاسم إذا لم تكن هناك صورة) -->
                        <div class="w-10 h-10 rounded-full bg-brand-50 flex items-center justify-center text-brand-800 font-bold border border-brand-100">
                            {{ \Illuminate\Support\Str::substr($testimonial->name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-brand-900 text-sm">{{ $testimonial->name }}</h4>
                            <p class="text-gray-500 text-xs">{{ $testimonial->role ?? 'عميلة ميثان' }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <i data-lucide="message-circle" class="w-12 h-12 text-gray-300 mx-auto mb-4"></i>
                    <h3 class="text-lg font-bold text-gray-400">لا توجد تقييمات حالياً</h3>
                    <p class="text-gray-400 text-sm mt-1">كوني أول من يشاركنا رأيه!</p>
                    <a href="{{ route('testimonials.create') ?? '#' }}" class="inline-block mt-4 text-gold-400 font-semibold text-sm hover:underline">اكتبي تقييمك الآن</a>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
