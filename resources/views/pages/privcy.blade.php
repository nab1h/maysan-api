@extends('layouts.maysantwo')

@section('title', 'سياسة الخصوصية - عيادات ميسان')

@section('contentpage')

<!-- ===== HERO SECTION ===== -->
<section class="py-20 lg:py-28 bg-brand-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <div class="inline-flex items-center gap-2 bg-brand-800/10 rounded-full px-5 py-2 mb-4">
            <i data-lucide="fingerprint" class="w-4 h-4 text-brand-800"></i>
            <span class="text-brand-800 font-semibold text-sm">سياسة الخصوصية</span>
        </div>
        <h2 class="text-3xl lg:text-5xl font-black text-brand-800 mb-6 leading-tight">خصوصيتك <span class="text-gold-500">أمانة</span> في أعناقنا</h2>
        <p class="text-gray-500 text-lg leading-relaxed max-w-2xl mx-auto">في عيادات ميسان، نلتزم بأعلى معايير حماية بياناتك الشخصية والطبية. نوضح لك أدناه كيفية جمع واستخدام وحماية معلوماتك.</p>
    </div>
</section>

<!-- ===== PRIVACY CARDS SECTION ===== -->
<section id="privacy-cards" class="pb-20 bg-brand-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Card 1: جمع البيانات -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-brand-100 hover:shadow-xl hover:border-gold-400/30 transition-all duration-500 reveal group">
                <!-- Icon Container -->
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gold-400/10 flex items-center justify-center mb-6 group-hover:bg-gold-400 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                    <i data-lucide="database" class="w-10 h-10 text-gold-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <!-- Title -->
                <h3 class="text-2xl font-bold text-brand-900 mb-6 text-center">ماذا نجمع من بيانات؟</h3>

                <!-- List -->
                <ul class="space-y-4 text-right">
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed"><strong class="text-brand-800">البيانات الشخصية:</strong> الاسم الكامل، رقم الجوال، البريد الإلكتروني، والعمر.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed"><strong class="text-brand-800">البيانات الطبية:</strong> التاريخ المرضي، التقارير السريرية، وصور قبل وبعد الإجراءات (بموافقتك).</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed"><strong class="text-brand-800">البيانات المالية:</strong> بيانات الفوترة وطرق الدفع (لا نقوم بتخزين أرقام البطاقات البنكية في أنظمتنا).</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed"><strong class="text-brand-800">البيانات التقنية:</strong> عنوان IP، نوع المتصفح، وسجل التصفح داخل موقعنا (عبر ملفات تعريف الارتباط Cookies).</span>
                    </li>
                </ul>

                <!-- Decorative Divider -->
                <div class="w-12 h-1 bg-gold-400/30 rounded-full mx-auto mt-6 group-hover:w-20 transition-all duration-500"></div>
            </div>

            <!-- Card 2: الاستخدام والحماية -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-brand-100 hover:shadow-xl hover:border-gold-400/30 transition-all duration-500 reveal group lg:-mt-4 lg:mb-4">
                <!-- Icon Container -->
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gold-400/10 flex items-center justify-center mb-6 group-hover:bg-gold-400 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                    <i data-lucide="shield-check" class="w-10 h-10 text-gold-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <!-- Title -->
                <h3 class="text-2xl font-bold text-brand-900 mb-6 text-center">كيف نحمي بياناتك؟</h3>

                <!-- List -->
                <ul class="space-y-4 text-right">
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">نستخدم بياناتك لتقديم الخدمات الطبية، تأكيد المواعيد، وتحسين تجربتك في عيادات ميسان.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">يتم إرسال العروض والحملات التسويقية فقط للعملاء الذين وافقوا صراحةً على استقبالها.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">نعتمد على تقنيات التشفير المتقدمة (SSL) لحماية بيانات الدفع والتبادل المالي عبر الموقع.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed">تقييد صلاحية الوصول للسجلات الطبية والمالية على الكادر الطبي والإداري المصرح له فقط.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed"><strong class="text-red-500">لا نقوم ببيع أو تأجير أو مشاركة بياناتك الشخصية مع أطراف ثالثة لأغراض تجارية.</strong></span>
                    </li>
                </ul>

                <!-- Decorative Divider -->
                <div class="w-12 h-1 bg-gold-400/30 rounded-full mx-auto mt-6 group-hover:w-20 transition-all duration-500"></div>
            </div>

            <!-- Card 3: حقوقك ومشاركة البيانات -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-brand-100 hover:shadow-xl hover:border-gold-400/30 transition-all duration-500 reveal group">
                <!-- Icon Container -->
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gold-400/10 flex items-center justify-center mb-6 group-hover:bg-gold-400 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                    <i data-lucide="user-check" class="w-10 h-10 text-gold-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <!-- Title -->
                <h3 class="text-2xl font-bold text-brand-900 mb-6 text-center">حقوقك القانونية</h3>

                <!-- List -->
                <ul class="space-y-4 text-right">
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed"><strong class="text-brand-800">حق الوصول:</strong> يحق لك طلب نسخة من بياناتك الشخصية والطبية المخزنة لدينا.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed"><strong class="text-brand-800">حق التعديل:</strong> يحق لك تصحيح أي بيانات غير دقيقة أو تحديثها في أي وقت.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed"><strong class="text-brand-800">حق الإلغاء:</strong> يمكنك إلغاء اشتراكك في القوائم البريدية والرسائل التسويقية بضغطة زر.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed"><strong class="text-brand-800">مشاركة محدودة:</strong> قد نشارك بياناتك فقط مع جهات معتمدة (مثل بوابة الدفع الإلكتروني أو شركات التأمين بتفويض منك).</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0"><i data-lucide="check-circle-2" class="w-5 h-5 text-gold-500"></i></span>
                        <span class="text-gray-600 leading-relaxed"><strong class="text-brand-800">الامتثال القانوني:</strong> قد نكشف عن البيانات إذا اقتضى ذلك القانون أو الجهات الرسمية المختصة في المملكة العربية السعودية.</span>
                    </li>
                </ul>

                <!-- Decorative Divider -->
                <div class="w-12 h-1 bg-gold-400/30 rounded-full mx-auto mt-6 group-hover:w-20 transition-all duration-500"></div>
            </div>

        </div>

        <!-- Bottom Note -->
        <div class="mt-12 bg-white rounded-3xl p-8 border border-brand-100 shadow-sm text-center reveal">
            <div class="flex items-center justify-center gap-3 mb-4">
                <i data-lucide="info" class="w-6 h-6 text-brand-800"></i>
                <h4 class="text-xl font-bold text-brand-900">تحديث السياسة</h4>
            </div>
            <p class="text-gray-500 leading-relaxed max-w-3xl mx-auto">
                نحتفظ بحق تعديل سياسة الخصوصية هذه في أي وقت لتتوافق مع التشريعات والأنظمة المعمول بها في المملكة العربية السعودية. سيتم إعلامك بأي تغييرات جوهرية عبر الموقع الإلكتروني أو البريد الإلكتروني المسجل لدينا. للاستفسار عن بياناتك، يرجى التواصل معنا عبر صفحة <a href="{{ route('contact.index') }}" class="text-gold-500 font-semibold hover:underline">تواصل معنا</a>.
            </p>
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

        // Reveal on scroll
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
