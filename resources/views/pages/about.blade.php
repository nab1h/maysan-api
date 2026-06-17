@extends('layouts.maysantwo')

@section('title', 'حول ميسان')

@section('contentpage')

<section id="about" class="py-20 lg:py-28 bg-brand-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <!-- Image Side -->
            <div class="relative reveal">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-brand-800/10">
                    <img src="{{ asset('storage/' .$image->path) }}" alt="طبيبة العيادة" class="w-full h-[500px] lg:h-[600px] object-cover">
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
                    {{ $content->about_desc_ar }}
                <p class="text-gray-500 leading-relaxed mb-8">
                    {{ $content->about_title_ar }}
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
            </div>
        </div>
    </div>
</section>

<!-- ===== VALUES, MISSION & VISION SECTION ===== -->
<section id="sub-about" class="mb-4 bg-brand-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 2: الرسالة (Mission) -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-brand-100 text-center hover:shadow-xl hover:border-gold-400/30 transition-all duration-500 reveal group md:-mt-4 md:mb-4">
                <!-- Icon Container -->
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gold-400/10 flex items-center justify-center mb-6 group-hover:bg-gold-400 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                    <i data-lucide="target" class="w-10 h-10 text-gold-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <!-- Title -->
                <h3 class="text-2xl font-bold text-brand-900 mb-4">رسالتنا</h3>
                <!-- Description -->
                <p class="text-gray-600 leading-relaxed">تقديم خدمات طبية وجمالية متكاملة، تعتمد على التقنيات الحديثة والخبرة العالمية، مع ضمان أعلى معايير الأمان والجودة.</p>

                <!-- Decorative Divider -->
                <div class="w-12 h-1 bg-gold-400/30 rounded-full mx-auto mt-6 group-hover:w-20 transition-all duration-500"></div>
            </div>

            <!-- Card 3: الرؤية (Vision) -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-brand-100 text-center hover:shadow-xl hover:border-gold-400/30 transition-all duration-500 reveal group">
                <!-- Icon Container -->
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gold-400/10 flex items-center justify-center mb-6 group-hover:bg-gold-400 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                    <i data-lucide="eye" class="w-10 h-10 text-gold-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <!-- Title -->
                <h3 class="text-2xl font-bold text-brand-900 mb-4">رؤيتنا</h3>
                <!-- Description -->
                <p class="text-gray-600 leading-relaxed">أن نصبح الوجهة الأولى للتجميل والرعاية الصحية في المملكة، من خلال تقديم تجربة استثنائية لكل مراجع.</p>

                <!-- Decorative Divider -->
                <div class="w-12 h-1 bg-gold-400/30 rounded-full mx-auto mt-6 group-hover:w-20 transition-all duration-500"></div>
            </div>


            <!-- Card 1: القيم (Values) -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-brand-100 text-center hover:shadow-xl hover:border-gold-400/30 transition-all duration-500 reveal group">
                <!-- Icon Container -->
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gold-400/10 flex items-center justify-center mb-6 group-hover:bg-gold-400 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                    <i data-lucide="shield-check" class="w-10 h-10 text-gold-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <!-- Title -->
                <h3 class="text-2xl font-bold text-brand-900 mb-6">نقاط التميز الطبي</h3>

                <!-- List of Values -->
                <ul class="space-y-4 text-right">
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i>
                        </span>
                        <span class="text-gray-600 leading-relaxed">الإنسانية في التعامل</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i>
                        </span>
                        <span class="text-gray-600 leading-relaxed">الأمانة والشفافية</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i>
                        </span>
                        <span class="text-gray-600 leading-relaxed">الاستدامة في الخدمة</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i>
                        </span>
                        <span class="text-gray-600 leading-relaxed">الابتكار والتطوير المستمر</span>
                    </li>
                </ul>

                <!-- Decorative Divider -->
                <div class="w-12 h-1 bg-gold-400/30 rounded-full mx-auto mt-6 group-hover:w-20 transition-all duration-500"></div>
            </div>

        </div>
    </div>
</section>

@include('includes.tobooking')
@include('includes.doctors')

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        const prevBtn = document.getElementById('prevSlide');
        const nextBtn = document.getElementById('nextSlide');

        if (prevBtn && nextBtn) {
            console.log("Slider initialized");
        }
    });
</script>
