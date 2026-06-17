@extends('layouts.maysantwo')
@section('title','اتصل بنا')


@section('contentpage')

@section('contentpage')
<!-- ===== CONTACT US SECTION ===== -->
<section class="py-16 md:py-24 bg-brand-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="text-center mb-16 reveal">
            <span class="text-gold-400 text-sm font-bold tracking-wider">تواصلي معنا</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-2">نسعد بتواصلكِ دائماً</h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto">لأي استفسار أو لحجز موعد، فريقنا جاهز لخدمتكِ من خلال أي من القنوات التالية.</p>
        </div>

        @isset($setting)
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">

            <!-- العمود الأيمن: المعلومات والخريطة -->
            <div class="lg:col-span-2 space-y-8">

                <!-- معلومات الاتصال -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 reveal">
                    <h3 class="text-xl font-bold text-brand-900 mb-6 flex items-center gap-2">
                        <i data-lucide="phone" class="w-5 h-5 text-gold-400"></i>
                        معلومات التواصل
                    </h3>

                    <div class="space-y-5">
                        <!-- الهاتف -->
                        @if($setting->mobile)
                        <a href="tel:{{ $setting->mobile }}" class="flex items-center gap-4 group">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 group-hover:bg-gold-400 group-hover:text-brand-900 transition-colors">
                                <i data-lucide="phone" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold">اتصال مباشر</p>
                                <p class="text-brand-900 font-semibold" dir="ltr">{{ $setting->mobile }}</p>
                            </div>
                        </a>
                        @endif

                        <!-- واتساب -->
                        @if($setting->whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}" target="_blank" class="flex items-center gap-4 group">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 group-hover:bg-green-500 group-hover:text-white transition-colors">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold">واتساب</p>
                                <p class="text-brand-900 font-semibold" dir="ltr">{{ $setting->whatsapp }}</p>
                            </div>
                        </a>
                        @endif

                        <!-- البريد الإلكتروني -->
                        @if($setting->email)
                        <a href="mailto:{{ $setting->email }}" class="flex items-center gap-4 group">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold">البريد الإلكتروني</p>
                                <p class="text-brand-900 font-semibold text-sm">{{ $setting->email }}</p>
                            </div>
                        </a>
                        @endif

                        <!-- العنوان -->
                        @if($setting->address_ar)
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 flex-shrink-0">
                                <i data-lucide="map-pin" class="w-5 h-5 text-gold-400"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold">العنوان</p>
                                <p class="text-brand-900 font-semibold">{{ $setting->address_ar }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- ساعات العمل -->
                        @if($setting->hours_ar)
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 flex-shrink-0">
                                <i data-lucide="clock" class="w-5 h-5 text-gold-400"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold">ساعات العمل</p>
                                <p class="text-brand-900 font-semibold">{{ $setting->hours_ar }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- روابط التواصل الاجتماعي -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 reveal">
                    <h3 class="text-xl font-bold text-brand-900 mb-6 flex items-center gap-2">
                        <i data-lucide="share-2" class="w-5 h-5 text-gold-400"></i>
                        تابعينا على
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        @if($setting->facebook)
                        <a href="{{ $setting->facebook }}" target="_blank" class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 hover:bg-blue-600 hover:text-white transition-colors shadow-sm">
                            <i class="fab fa-facebook-f text-lg"></i>
                        </a>
                        @endif
                        @if($setting->instagram)
                        <a href="{{ $setting->instagram }}" target="_blank" class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 hover:bg-pink-500 hover:text-white transition-colors shadow-sm">
                            <i class="fab fa-instagram text-lg"></i>
                        </a>
                        @endif
                        @if($setting->twitter)
                        <a href="{{ $setting->twitter }}" target="_blank" class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 hover:bg-black hover:text-white transition-colors shadow-sm">
                            <i class="fab fa-x-twitter text-lg"></i>
                        </a>
                        @endif
                        @if($setting->snapchat)
                        <a href="{{ $setting->snapchat }}" target="_blank" class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 hover:bg-yellow-400 hover:text-brand-900 transition-colors shadow-sm">
                            <i class="fab fa-snapchat-ghost text-lg"></i>
                        </a>
                        @endif
                        @if($setting->tiktok)
                        <a href="{{ $setting->tiktok }}" target="_blank" class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 hover:bg-gray-900 hover:text-white transition-colors shadow-sm">
                            <i class="fab fa-tiktok text-lg"></i>
                        </a>
                        @endif
                    </div>
                </div>

            </div>

            <div class="lg:col-span-3 space-y-8">

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 reveal">
                    <h3 class="text-xl font-bold text-brand-900 mb-6 flex items-center gap-2">
                        <i data-lucide="send" class="w-5 h-5 text-gold-400"></i>
                        أرسلي رسالتكِ
                    </h3>

                    @if (session('status'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                        <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 text-sm flex items-center gap-3 shadow-sm">
                            <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                            {{ session('status') }}
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">الاسم</label>
                                <input type="text" name="name" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                                <input type="email" name="email" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">رقم الجوال</label>
                            <input type="tel" name="phone" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">الموضوع</label>
                            <input type="text" name="subject" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">الرسالة</label>
                            <textarea name="message" rows="5" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm resize-none"></textarea>
                        </div>
                        <button type="submit" class="w-full md:w-auto bg-[#135158] text-white font-bold py-3 px-10 rounded-xl hover:bg-[#1a6b73] transition-all duration-300 shadow-md hover:shadow-lg">
                            إرسال الرسالة
                        </button>
                    </form>
                </div>

                @if($setting->map_link)
                <div class="bg-white p-2 rounded-3xl shadow-sm border border-gray-100 overflow-hidden reveal h-80">
                    <iframe src="{{ $setting->map_link }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                @endif

            </div>

        </div>
        @endisset

    </div>
</section>

@include('includes.articals')
@endsection
