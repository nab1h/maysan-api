@extends('layouts.maysantwo')
@section('title', $department->name . ' - خدماتنا')


@section('contentpage')
    <section class="py-16 md:py-24 bg-brand-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="text-center mb-16 reveal">
                <span class="text-gold-400 text-sm font-bold tracking-wider">قسم</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-2">{{ $department->name }}</h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">اكتشفي مجموعة الخدمات المتخصصة التي يقدمها قسم {{ $department->name }} بأحدث التقنيات.</p>
            </div>

            <!-- Services Grid -->
            @if($department->services->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($department->services as $service)

                        <!-- تم إضافة overflow-hidden للكرت لمنع صورة الـ Zoom من الخروج خارج الحواف المستديرة -->
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-gold-400/30 transition-all duration-300 reveal group overflow-hidden">

                            <!-- حاوية الصورة -->
                            @if($service->image)
                            <div class="h-52 w-full overflow-hidden">
                                <img src="{{ asset('storage/' . $service->image) }}"
                                    alt="{{ $service->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            @else
                            <!-- صورة افتراضية في حال عدم وجود صورة للخدمة -->
                            <div class="h-52 w-full overflow-hidden bg-brand-50 flex items-center justify-center">
                                <i data-lucide="image-off" class="w-16 h-16 text-brand-100"></i>
                            </div>
                            @endif

                            <!-- محتوى الخدمة (تم إضافة padding هنا بدلاً من الكرت بالكامل) -->
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-xl font-bold text-brand-900">
                                        {{ $service->name }}
                                    </h3>

                                    <span class="text-lg font-bold text-[#C9A227]">
                                        {{ number_format($service->price, 0) }} ر.س
                                    </span>
                                </div>
                                <p class="text-gray-500 text-sm leading-relaxed mb-5 line-clamp-3">{{ $service->description ?? 'نقدم هذه الخدمة بأعلى معايير الجودة والآمان لتحقيق أفضل النتائج.' }}</p>

                                <!-- زر الحجز -->
                                <a href="{{ route('booking.index', ['service_id' => $service->id]) }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#135158] hover:text-gold-400 transition-colors group/link">
                                    احجزي الآن
                                    <i data-lucide="arrow-left" class="w-4 h-4 group-hover/link:-translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
            <div class="text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                <i data-lucide="folder-x" class="w-12 h-12 text-gray-300 mx-auto mb-4"></i>
                <h3 class="text-lg font-bold text-gray-400">لا توجد خدمات حالياً</h3>
                <p class="text-gray-400 text-sm mt-1">لم يتم إضافة خدمات لهذا القسم بعد.</p>
            </div>
            @endif

        </div>
    </section>

    @include('includes.tobooking')
    @include('includes.doctors')
    @include('includes.articals')
@endsection
