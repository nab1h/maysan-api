<!-- ===== OFFERS SECTION ===== -->
@isset($offers)
<section id="offers" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="text-center mb-16 reveal">
            <span class="text-gold-400 text-sm font-bold tracking-wider">عروض حصرية</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-2">لا تفوتي فرصتنا المذهلة</h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto">استفيدي من عروضنا المحدودة على أحدث التقنيات والخدمات التجميلية.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($offers as $offer)

            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group relative reveal">

                <!-- تم تعديل الارتفاع من h-64 إلى h-72 لجعل الصورة أطول -->
                <div class="relative h-90 overflow-hidden">
                    <img src="{{ asset('storage/' . $offer->img) }}"
                        alt="{{ $offer->title }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                    <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-white to-transparent"></div>

                    @php
                    $discount = 0;
                    if($offer->old_price > 0) {
                    $discount = round((($offer->old_price - $offer->price) / $offer->old_price) * 100);
                    }
                    @endphp

                    @if($discount > 0)
                    <div class="absolute top-4 left-4 bg-red-500 text-white text-sm font-extrabold px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1">
                        <i class="fas fa-fire text-yellow-300 text-xs"></i>
                        خصم {{ $discount }}%
                    </div>
                    @endif

                    @if(now()->gte($offer->start_date) && now()->lte($offer->end_date))
                    <div class="absolute top-4 right-4 bg-gold-400 text-brand-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-md flex items-center gap-1">
                        <span class="w-1.5 h-1.5 bg-brand-900 rounded-full animate-pulse"></span>
                        عرض ساري
                    </div>
                    @endif
                </div>

                <div class="p-6 relative -mt-4 z-10">
                    <!-- عنوان العرض -->
                    <h3 class="text-xl font-bold text-brand-900 mb-4 line-clamp-2 h-14">{{ $offer->title }}</h3>

                    <div class="flex items-end gap-3 mb-5">
                        <span class="text-3xl font-black text-[#135158]">{{ $offer->price }} <span class="text-sm font-bold">ر.س</span></span>
                        @if($offer->old_price)
                        <span class="text-lg text-gray-400 line-through decoration-red-400">{{ $offer->old_price }} ر.س</span>
                        @endif
                    </div>

                    <div class="flex items-center gap-2 text-gray-500 text-sm mb-6 bg-brand-50/50 p-3 rounded-xl">
                        <i data-lucide="clock" class="w-4 h-4 text-gold-500 flex-shrink-0"></i>
                        <span>ينتهي العرض في: {{ \Carbon\Carbon::parse($offer->end_date)->format('d M Y') }}</span>
                    </div>

                    <a href="{{ route('booking.index') }}"
                        class="w-full flex items-center justify-center gap-2 bg-gold-400 text-brand-900 font-bold py-3.5 rounded-xl hover:bg-gold-500 transition-all duration-300 shadow-md hover:shadow-lg group/btn">
                        <i data-lucide="calendar-check" class="w-5 h-5 group-hover/btn:animate-bounce"></i>
                        احجزي العرض الآن
                    </a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endisset
