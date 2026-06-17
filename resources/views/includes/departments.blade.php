<!-- ===== DEPARTMENTS SECTION ===== -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="text-center mb-14 reveal">
            <span class="text-gold-400 text-sm font-bold tracking-wider">تشكيلة متكاملة</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-2">أقسامنا المتخصصة</h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto">اختاري القسم الذي يناسب احتياجاتكِ واكتشفي الخدمات المصممة خصيصاً لعنايتكِ وجمالكِ.</p>
        </div>

        <!-- Departments Grid -->
        @isset($departments)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

            @foreach($departments as $department)
            <a href="{{ route('departments.services', $department->id) }}" class="group block relative h-80 md:h-[420px] rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 reveal">

                @if($department->image)
                <img src="{{ asset('storage/' . $department->image) }}"
                    alt="{{ $department->name }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                @else
                <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?q=80&w=800&auto=format&fit=crop"
                    alt="{{ $department->name }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                @endif

                <div class="absolute inset-0 bg-gradient-to-t from-brand-900/90 via-brand-900/40 to-transparent z-10 group-hover:from-brand-900/95 transition-colors duration-500"></div>

                <div class="absolute bottom-0 left-0 right-0 p-8 z-20 flex flex-col items-start">


                    <h3 class="text-white text-2xl md:text-3xl font-extrabold drop-shadow-lg leading-tight">{{ $department->name }}</h3>

                    <div class="flex items-center gap-2 mt-3 text-gold-400 font-bold text-sm opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">
                        <span>اكتشفي الخدمات</span>
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    </div>
                </div>

            </a>
            @endforeach

        </div>
        @endisset

    </div>
</section>
