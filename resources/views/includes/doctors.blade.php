<!-- ===== DOCTORS SLIDER SECTION ===== -->
<section class="py-20 bg-brand-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-12 reveal">
            <div>
                <span class="text-gold-400 text-sm font-bold tracking-wider">فريقنا الطبي</span>

                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-2">
                    أطباؤنا الخبراء
                </h2>

                <p class="text-gray-500 mt-3 max-w-xl">
                    نخبة من أمهر الأطباء المتخصصين المعتمدين دولياً لضمان أفضل النتائج.
                </p>
            </div>
        </div>

        <!-- Swiper -->
        <div class="swiper doctor-swiper overflow-hidden">

            <div class="swiper-wrapper">

                @foreach($doctors as $doctor)

                <div class="swiper-slide">

                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group overflow-hidden">

                        <!-- Image -->
                        <div class="relative h-72 md:h-80 overflow-hidden">

                            @if($doctor->image)

                            <img src="{{ asset('storage/' . $doctor->image) }}"
                                alt="{{ $doctor->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                            @else

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&background=135158&color=fff&size=400"
                                alt="{{ $doctor->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                            @endif

                            <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-white to-transparent"></div>

                        </div>

                        <!-- Content -->
                        <div class="p-5 text-center -mt-8 relative z-10">

                            <span class="inline-block px-3 py-1 bg-gold-400/10 text-gold-500 text-xs font-bold rounded-full mb-2">
                                {{ $doctor->department->name ?? 'طبيب' }}
                            </span>

                            <h3 class="text-xl font-bold text-brand-900 mb-2">
                                {{ $doctor->name }}
                            </h3>

                            <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-5 h-10">
                                {{ $doctor->description ?? 'خبرة واسعة في تقديم أفضل الحلول الطبية والتجميلية.' }}
                            </p>

                            <a href="{{ route('booking.index', ['doctor_id' => $doctor->id]) }}"
                                class="inline-flex items-center justify-center gap-2 w-full bg-[#135158] text-white font-bold py-3 rounded-xl hover:bg-[#1a6b73] transition-all duration-300 shadow-md hover:shadow-lg group/btn">

                                <i data-lucide="calendar-check" class="w-5 h-5 group-hover/btn:animate-bounce"></i>

                                احجزي مع د. {{ explode(' ', trim($doctor->name))[0] }}

                            </a>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </div>
</section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        new Swiper('.doctor-swiper', {

            slidesPerView: 1.2,
            spaceBetween: 24,
            loop: true,
            speed: 4000,

            autoplay: {
                delay: 0,
                disableOnInteraction: false,
                pauseOnMouseEnter: false,
            },

            breakpoints: {

                640: {
                    slidesPerView: 2,
                    spaceBetween: 24,
                },

                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                }

            }

        });

    });
</script>
