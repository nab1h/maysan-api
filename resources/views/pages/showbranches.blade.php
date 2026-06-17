@extends('layouts.maysantwo')

@section('title', 'فرع ميسان ' . $branch->name)

@section('contentpage')

<!-- Hero Header للصفحة -->
<div class="bg-gradient-to-b from-brand-50/50 to-white pt-8 pb-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-1.5 bg-gold-400/10 text-gold-500 text-xs font-bold rounded-full mb-4 tracking-wider">مرحباً بكِ في</span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-brand-900">ميسان {{ $branch->name }}</h1>
        @if($branch->address)
        <p class="text-gray-500 mt-3 flex items-center justify-center gap-2 text-sm">
            <i data-lucide="map-pin" class="w-4 h-4 text-gold-400"></i>
            {{ $branch->address }}
        </p>
        @endif
    </div>
</div>

<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-20">

        <!-- قسم التواصل والخريطة -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-stretch">
            <!-- كارت التواصل -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-8 shadow-xl shadow-brand-800/5 border border-gray-100 flex flex-col justify-center relative overflow-hidden group">

                <!-- ديكور خلفي -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>

                <div class="relative z-10">
                    <h3 class="text-2xl font-bold text-brand-900 mb-8 flex items-center gap-2">
                        <i data-lucide="message-circle" class="w-6 h-6 text-gold-400"></i>
                        تواصلي معنا
                    </h3>

                    @if($branch->phone)
                    <a href="tel:{{ $branch->phone }}" class="flex items-center gap-4 mb-6 group/item">
                        <div class="w-14 h-14 rounded-2xl bg-brand-50 flex items-center justify-center text-brand-800 group-hover/item:bg-brand-800 group-hover/item:text-white transition-all duration-300 shadow-sm">
                            <i class="fa-solid fa-phone text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">اتصال مباشر</p>
                            <p class="font-bold text-gray-900 text-lg" dir="ltr">{{ $branch->phone }}</p>
                        </div>
                    </a>
                    @endif

                    @if($branch->phone)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $branch->phone) }}" target="_blank" class="flex items-center gap-4 mb-6 group/item">
                        <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-green-600 group-hover/item:bg-green-500 group-hover/item:text-white transition-all duration-300 shadow-sm">
                            <i class="fa-brands fa-whatsapp text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">واتساب</p>
                            <p class="font-bold text-gray-900 text-lg" dir="ltr">{{ $branch->phone }}</p>
                        </div>
                    </a>
                    @endif

                    @if($branch->instagram_url ?? '')
                    <a href="{{ $branch->instagram_url }}" target="_blank" class="flex items-center gap-4 group/item">
                        <div class="w-14 h-14 rounded-2xl bg-pink-50 flex items-center justify-center text-pink-500 group-hover/item:bg-gradient-to-br group-hover/item:from-purple-500 group-hover/item:to-pink-500 group-hover/item:text-white transition-all duration-300 shadow-sm">
                            <i class="fa-brands fa-instagram text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">انستجرام</p>
                            <p class="font-bold text-gray-900 text-lg">تابعينا الآن</p>
                        </div>
                    </a>
                    @endif
                </div>
            </div>

            <!-- كارت الخريطة -->
            <div class="lg:col-span-3 bg-white rounded-3xl overflow-hidden shadow-xl shadow-brand-800/5 border border-gray-100 relative" style="min-height: 450px;">
                @if($branch->google_map_url ?? '')
                <iframe src="{{ $branch->google_map_url }}"
                    width="100%"
                    height="450"
                    style="border:0; filter: grayscale(100%);"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    class="hover:filter-none transition-all duration-700"></iframe>
                @else
                <div class="w-full h-full absolute inset-0 flex items-center justify-center bg-gray-50 text-gray-400">
                    <div class="text-center">
                        <i data-lucide="map-off" class="w-12 h-12 mx-auto mb-3 text-gray-300"></i>
                        <p>الخريطة غير متاحة حالياً</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- قسم الدكاترة -->
        <div>
            <div class="text-center mb-12">
                <span class="text-gold-400 text-sm font-bold tracking-wider">نخبة المتخصصين</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-2">أطباء فرع {{ $branch->name }}</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($branch->doctors as $doctor)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 group overflow-hidden hover:-translate-y-2">
                    <div class="relative h-72 overflow-hidden">
                        @if($doctor->image)
                        <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&background=135158&color=fff&size=400" alt="{{ $doctor->name }}" class="w-full h-full object-cover">
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 h-28 bg-gradient-to-t from-white via-white/50 to-transparent"></div>
                    </div>
                    <div class="p-6 text-center -mt-12 relative z-10">
                        <span class="inline-block px-4 py-1.5 bg-gold-400/10 text-gold-500 text-xs font-bold rounded-full mb-3 border border-gold-400/20">
                            {{ $doctor->department->name ?? 'طبيب' }}
                        </span>
                        <h3 class="text-xl font-bold text-brand-900 mb-4">{{ $doctor->name }}</h3>
                        <a href="{{ route('booking.index', ['doctor_id' => $doctor->id, 'branch_id' => $branch->id]) }}" class="inline-flex items-center justify-center gap-2 w-full bg-[#135158] text-white font-bold py-3 rounded-xl hover:bg-gold-400 hover:text-brand-900 transition-all duration-300 shadow-md hover:shadow-lg group/btn">
                            <i data-lucide="calendar-check" class="w-5 h-5 group-hover/btn:animate-bounce"></i>
                            احجزي الآن
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-16 bg-brand-50/30 rounded-3xl border border-dashed border-brand-100">
                    <i data-lucide="user-x" class="w-12 h-12 mx-auto text-gray-300 mb-3"></i>
                    <p class="text-gray-400 font-medium">لا يوجد أطباء في هذا الفرع حالياً</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- قسم الريلز (فيديوهات الانستجرام) -->
        <div>
            <div class="text-center mb-12">
                <span class="text-gold-400 text-sm font-bold tracking-wider">لحظات حقيقية</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-2">فيديوهات فرع {{ $branch->name }}</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($branch->reels as $reel)
                @php
                $cleanUrl = explode('?', $reel->url)[0];
                $cleanUrl = rtrim($cleanUrl, '/');
                $embedUrl = $cleanUrl . '/embed/';
                @endphp

                <!-- فريم الموبايل للفيديو -->
                <div class="bg-gray-900 rounded-[2rem] p-2 shadow-2xl shadow-gray-900/20 hover:-translate-y-2 transition-all duration-500 group">
                    <div class="bg-black rounded-[1.5rem] overflow-hidden relative">
                        <!-- النوتش (Notch) بتاع الموبايل ديكور -->
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-24 h-5 bg-gray-900 rounded-b-2xl z-20"></div>

                        <iframe src="{{ $embedUrl }}"
                            width="100%"
                            style="min-height: 550px;"
                            frameborder="0"
                            scrolling="no"
                            allowtransparency="true"
                            allow="encrypted-media"
                            class="group-hover:opacity-100 opacity-90 transition-opacity duration-300">
                        </iframe>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-16 bg-brand-50/30 rounded-3xl border border-dashed border-brand-100">
                    <i data-lucide="video-off" class="w-12 h-12 mx-auto text-gray-300 mb-3"></i>
                    <p class="text-gray-400 font-medium">لا توجد فيديوهات في هذا الفرع حالياً</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

@include('includes.create')

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

@endsection()
