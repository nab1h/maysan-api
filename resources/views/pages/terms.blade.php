@extends('layouts.maysantwo')

@section('title', 'الشروط والأحكام - عيادات ميسان')

@section('contentpage')

<!-- ===== HERO SECTION ===== -->
<section class="py-20 lg:py-28 bg-brand-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <div class="inline-flex items-center gap-2 bg-brand-800/10 rounded-full px-5 py-2 mb-4">
            <i data-lucide="scroll-text" class="w-4 h-4 text-brand-800"></i>
            <span class="text-brand-800 font-semibold text-sm">الشروط والأحكام</span>
        </div>
        <h2 class="text-3xl lg:text-5xl font-black text-brand-800 mb-6 leading-tight">شروط وأحكام <span class="text-gold-500">عروض عيادات ميسان</span></h2>
        <p class="text-gray-500 text-lg leading-relaxed max-w-2xl mx-auto">يرجى قراءة الشروط والأحكام التالية بعناية قبل الاستفادة من عروضنا وباقاتنا الطبية والجمالية لضمان تجربة مثالية.</p>
    </div>
</section>

<!-- ===== TERMS CARDS SECTION ===== -->
<section id="terms-cards" class="pb-20 bg-brand-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Card 1: شروط الدفع والاستخدام العام -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-brand-100 hover:shadow-xl hover:border-gold-400/30 transition-all duration-500 reveal group">
                <!-- Icon Container -->
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gold-400/10 flex items-center justify-center mb-6 group-hover:bg-gold-400 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                    <i data-lucide="wallet-cards" class="w-10 h-10 text-gold-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <!-- Title -->
                <h3 class="text-2xl font-bold text-brand-900 mb-6 text-center">شروط الدفع والاستخدام</h3>

                <!-- List of Terms -->
                <ul class="space-y-4 text-right">
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">المبلغ المدفوع غير مسترد ويمكن استبدال الخدمة المدفوعة بخدمات أخرى.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">يمكن لنفس العميل الدفع لعرض وشراء عدة جلسات، ولكن يجب استخدامها جميعاً خلال ستة أشهر من تاريخ الفوترة.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">يمكن تقسيط جميع العروض من خلال شركة تسهيل للتمويل.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">أسعار العروض غير شاملة قيمة الضريبة المضافة لغير السعوديين.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">مدة الاستفادة من الخدمة 6 أشهر من تاريخ شراء العرض. لا يمكن عمل أي خصم إضافي على العروض.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">التأمين والخصومات غير مشمولة على العروض.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">يمكن استخدام فاتورة العروض الخاصة بالباقات لشخصين بحد أقصى (توزيع عدد الجلسات على ملفين).</span>
                    </li>
                </ul>

                <!-- Decorative Divider -->
                <div class="w-12 h-1 bg-gold-400/30 rounded-full mx-auto mt-6 group-hover:w-20 transition-all duration-500"></div>
            </div>

            <!-- Card 2: شروط عروض الليزر والاكزليس -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-brand-100 hover:shadow-xl hover:border-gold-400/30 transition-all duration-500 reveal group lg:-mt-4 lg:mb-4">
                <!-- Icon Container -->
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gold-400/10 flex items-center justify-center mb-6 group-hover:bg-gold-400 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                    <i data-lucide="zap" class="w-10 h-10 text-gold-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <!-- Title -->
                <h3 class="text-2xl font-bold text-brand-900 mb-6 text-center">عروض الليزر والاكزليس</h3>

                <!-- List of Terms -->
                <ul class="space-y-4 text-right">
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">في حال وجود عروض على باقات جلسات الاكزليس لعدد خمس جلسات، تكون لمنطقة واحدة بالجسم وليس لأكثر من منطقة.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">عروض الليزر لكامل الجسم تشمل الوجه، بشرط استخدام نفس الجهاز المستخدم للجسم.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">عروض الليزر للمناطق تشمل: (بكيني - اندر آرم - وجه) أو سيتم تفصيله بالعرض نفسه، والثلاث مناطق تكون خلال جلسة واحدة.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">عروض الليزر لكامل الجسم لا تشمل الرجال. ويتم توضيح عروض الليزر في حال كانت خاصة بالرجال.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">في حال دفع العميل كامل القيمة لباقة (مثل الليزر وغيرها) واستخدم جزءاً من الجلسات في فرع، يحق له التحويل لفرع آخر لإكمال الجلسات مع دفع قيمة الكشفية للعرض.</span>
                    </li>
                </ul>

                <!-- Decorative Divider -->
                <div class="w-12 h-1 bg-gold-400/30 rounded-full mx-auto mt-6 group-hover:w-20 transition-all duration-500"></div>
            </div>

            <!-- Card 3: شروط عروض الأسنان والسياسات العامة -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-brand-100 hover:shadow-xl hover:border-gold-400/30 transition-all duration-500 reveal group">
                <!-- Icon Container -->
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gold-400/10 flex items-center justify-center mb-6 group-hover:bg-gold-400 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                    <i data-lucide="shield-check" class="w-10 h-10 text-gold-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <!-- Title -->
                <h3 class="text-2xl font-bold text-brand-900 mb-6 text-center">عروض الأسنان والسياسات</h3>

                <!-- List of Terms -->
                <ul class="space-y-4 text-right">
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">يسري العرض لدى أطباء الأسنان العامين المرخصين ولا يسري لدى الأخصائيين.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">من حق أي طبيب أخصائي العمل بالعرض أو عدم الالتزام به بحسب تشخيص الحالة.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">عرض تقويم الأسنان "الكاش" يكون للحالات البسيطة التي مدة علاجها من 6 أشهر إلى سنة.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">عروض تقويم الأسنان غير شاملة المثبتات بعد التقويم بكل أنواعها.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">عرض تنظيف الأسنان يكون تنظيفاً من الجير للحالات البسيطة فقط، ويختلف السعر في حال كانت الحالة خلاف ذلك.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">يحق للعميل الذي تمت الفوترة باسمه الاستفادة من الخدمة أو تحويلها لشخص آخر، ولكن يشترط وجودهما معاً وقت التحويل.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">عند تزويد عيادات ميسان ببيانات العميل عبر الموقع، يحق للعيادات استخدام هذه المعلومات مستقبلاً لإرسال العروض والحملات الخاصة.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">في حال وجود أي نقطة خلاف ما ذكر أعلاه، فسيتم الأخذ بالشروط والأحكام العامة للخدمات المقدمة في مجموعة عيادات ميسان.</span>
                    </li>
                </ul>

                <!-- Decorative Divider -->
                <div class="w-12 h-1 bg-gold-400/30 rounded-full mx-auto mt-6 group-hover:w-20 transition-all duration-500"></div>
            </div>

        </div>
    </div>
</section>

@include('includes.tobooking')

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        // Reveal on scroll (if you have this function in your main layout)
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, {
            threshold: 0.1
        });

        reveals.forEach(reveal => observer.observe(reveal));
    });
</script>
