<!-- ===== BRANCHES SECTION ===== -->
@isset($branches)
<div x-data="{ showMap: false, mapUrl: '' }">

    <section id="branches" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="text-center mb-16 reveal">
                <span class="text-gold-400 text-sm font-bold tracking-wider">فروعنا</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-2">زورينا في أقرب فرع</h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">نستقبلكم في فروعنا المجهزة بأعلى المعايير لتوفير تجربة جمالية استثنائية ومريحة.</p>
            </div>

            <!-- Branches Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($branches as $branch)

                <!-- كارت الفرع -->
                <div class="bg-brand-50/50 rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl hover:border-gold-400/30 transition-all duration-500 group hover:-translate-y-2 reveal">

                    <!-- صورة الفرع -->
                    <div class="relative h-64 overflow-hidden">
                        @if($branch->image)
                        <img src="{{ asset('storage/' . $branch->image) }}"
                            alt="{{ $branch->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                        <img src="https://images.unsplash.com/photo-1629909615184-74f495363b67?q=80&w=800&auto=format&fit=crop"
                            alt="{{ $branch->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @endif

                        @if($branch->instagram ?? '')
                        <a href="{{ $branch->instagram }}" target="_blank"
                            class="absolute top-4 left-4 w-10 h-10 rounded-full bg-brand-900/60 backdrop-blur-sm border border-white/20 flex items-center justify-center text-white hover:bg-pink-500 transition-colors z-10">
                            <i class="fab fa-instagram text-lg"></i>
                        </a>
                        @endif

                        @if($branch->location)
                        <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-1.5 rounded-full text-brand-900 text-xs font-bold shadow-md z-10">
                            {{ $branch->location->name }}
                        </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <a href="{{ route('branch.show', $branch->id) }}" class="text-xl font-bold text-brand-900 mb-2 block hover:text-gold-500 transition-colors">ميسان {{ $branch->name }}</a>


                        <p class="text-gray-500 text-sm flex items-start gap-2 mb-6">
                            <i data-lucide="map-pin" class="w-4 h-4 text-gold-400 mt-0.5 flex-shrink-0"></i>
                            {{ $branch->address ?? 'الرياض، حي العليا' }}
                        </p>

                        <div class="flex items-center gap-3 mb-5">
                            @if($branch->google_map_url ?? '')
                            <button @click="mapUrl = '{{ $branch->map_url ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d463878.2174996858!2d46.54271704999999!3d24.725195199999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2z2KfZhNix2YrYp9i2!5e0!3m2!1sar!2ssa!4v1690456789100!5m2!1sar!2ssa' }}'; showMap = true"
                                class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-brand-900 hover:text-white hover:border-brand-900 transition-all shadow-sm"
                                title="الموقع على الخريطة">
                                <i data-lucide="map" class="w-5 h-5"></i>
                            </button>
                            @endif

                            <a href="{{ $branch->instagram_url }}" target="_blank"
                                class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-pink-500 hover:text-white hover:border-pink-500 transition-all shadow-sm"
                                title="Instagram">
                                <i class="fab fa-instagram text-lg"></i>
                            </a>

                            <!-- زر الواتساب -->
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $branch->phone ?? '966500000000') }}" target="_blank"
                                class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-green-500 hover:text-white hover:border-green-500 transition-all shadow-sm"
                                title="واتساب">
                                <i class="fab fa-whatsapp text-lg"></i>
                            </a>

                            <!-- زر الاتصال -->
                            <a href="tel:{{ $branch->phone ?? '966500000000' }}"
                                class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition-all shadow-sm"
                                title="اتصال">
                                <i data-lucide="phone" class="w-5 h-5"></i>
                            </a>
                        </div>

                        <!-- زر الحجز (يحمل الـ ID للفرع) -->
                        <a href="{{ route('booking.index', ['branch_id' => $branch->id]) }}"
                            class="w-full flex items-center justify-center gap-2 bg-[#135158] text-white font-bold py-3 rounded-xl hover:bg-[#1a6b73] transition-all duration-300 shadow-md hover:shadow-lg group/btn">
                            <i data-lucide="calendar-check" class="w-5 h-5 group-hover/btn:animate-bounce"></i>
                            احجزي في هذا الفرع
                        </a>

                        <a href="{{ route('branch.show', $branch->id) }}"
                            class="w-full flex items-center mt-5 justify-center gap-2 bg-[#135158] text-white font-bold py-3 rounded-xl hover:bg-[#1a6b73] transition-all duration-300 shadow-md hover:shadow-lg group/btn">
                            <i data-lucide="calendar-check" class="w-5 h-5 group-hover/btn:animate-bounce"></i>
                            تفاصيل الفرع
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ===== MAP MODAL (النافذة المنبثقة للخريطة) ===== -->
    <div x-show="showMap"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-brand-900/60 backdrop-blur-sm z-50"
        @click="showMap = false" style="display: none;"></div>

    <div x-show="showMap"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 md:inset-10 lg:inset-20 z-50 flex items-center justify-center p-4" style="display: none;">

        <div class="bg-white rounded-3xl shadow-2xl w-full h-full overflow-hidden relative">
            <button @click="showMap = false"
                class="absolute top-4 left-4 z-20 w-10 h-10 rounded-full bg-brand-900 text-white hover:bg-red-500 transition-colors flex items-center justify-center shadow-lg">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>

            <iframe :src="mapUrl"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

</div>
@endisset
