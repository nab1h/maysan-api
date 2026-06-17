<!-- ===== WORKING HOURS SECTION ===== -->
<section class="py-24 relative bg-cover bg-center bg-no-repeat" style="background-image: url('booking.png');">

    <!-- طبقة التدرج اللوني فوق الصورة (Overlay) لتمييز النص -->
    <!-- <div class="absolute inset-0 bg-gradient-to-br from-brand-900/90 via-brand-800/80 to-brand-900/90"></div> -->

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">

        <!-- الكارت الزجاجي (Glassmorphism) -->
        <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl shadow-brand-900/20 border border-white/20 p-8 md:p-10 w-full max-w-xl relative overflow-hidden reveal">

            <!-- Decorative Top Accent -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-brand-800 via-gold-400 to-brand-800"></div>

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto rounded-full bg-brand-50 flex items-center justify-center mb-4 border border-brand-100">
                    <i data-lucide="clock" class="w-8 h-8 text-gold-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-brand-900">أوقات العمل</h3>
                <p class="text-gray-500 text-sm mt-1">نستقبلكم في الأوقات التالية</p>
            </div>

            <!-- Schedule Grid -->
            <div class="space-y-4">

                <!-- الفترتان (الصباحية والمسائية) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex flex-col items-center justify-center p-4 bg-brand-50/60 rounded-xl border border-brand-100/50">
                        <span class="text-brand-800 font-bold text-sm mb-1">الفترة الصباحية</span>
                        <span class="text-gray-600 font-semibold" dir="ltr">10:00 AM - 02:00 PM</span>
                    </div>
                    <div class="flex flex-col items-center justify-center p-4 bg-brand-50/60 rounded-xl border border-brand-100/50">
                        <span class="text-brand-800 font-bold text-sm mb-1">الفترة المسائية</span>
                        <span class="text-gray-600 font-semibold" dir="ltr">05:00 PM - 10:00 PM</span>
                    </div>
                </div>

                <!-- أيام العمل -->
                <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar-check" class="w-5 h-5 text-green-500"></i>
                        <span class="font-bold text-brand-900">السبت - الخميس</span>
                    </div>
                    <span class="text-green-600 font-bold text-sm bg-green-50 px-3 py-1 rounded-full">مفتوح</span>
                </div>

                <!-- يوم الجمعة -->
                <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar-x" class="w-5 h-5 text-red-400"></i>
                        <span class="font-bold text-brand-900">الجمعة</span>
                    </div>
                    <span class="text-red-500 font-bold text-sm bg-red-50 px-3 py-1 rounded-full">مغلق</span>
                </div>

            </div>

            <!-- Emergency Note -->
            <div class="mt-6 flex items-center justify-center gap-2 text-xs text-gray-400">
                <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                <span>لحالات الطوارئ، التوفر على مدار الساعة عبر الهاتف</span>
            </div>

        </div>
    </div>
</section>
