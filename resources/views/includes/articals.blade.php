<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- عنوان السيكشن -->
        <div class="text-center max-w-2xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 bg-[#135158]/10 rounded-full px-5 py-2 mb-4">
                <i class="fa-solid fa-newspaper text-[#135158] text-sm"></i>
                <span class="text-[#135158] font-semibold text-sm">مدونة الجمال</span>
            </div>
            <h2 class="text-3xl lg:text-4xl font-black text-[#135158] mb-4">أحدث <span class="text-[#d4a853]">المقالات</span> والنصائح</h2>
            <p class="text-gray-500 text-lg">اكتشفي أحدث المقالات والأسرار من خبرائنا للحفاظ على جمالكِ ونضارتكِ</p>
        </div>

        <!-- شبكة المقالات -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($latestArticles as $article)
            <article class="group bg-gray-50 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                <!-- صورة المقال -->
                <a href="{{ route('articles.show', $article->slug) }}" class="block overflow-hidden">
                    @if($article->image)
                    <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                    <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                        <i class="fa-solid fa-newspaper text-4xl text-gray-400"></i>
                    </div>
                    @endif
                </a>

                <div class="p-6">
                    <!-- القسم والتاريخ -->
                    <div class="flex items-center gap-3 mb-3">
                        @if($article->department)
                        <span class="text-xs font-bold text-[#d4a853] bg-[#d4a853]/10 px-3 py-1 rounded-full">{{ $article->department->name }}</span>
                        @endif
                        <span class="text-xs text-gray-400">{{ $article->created_at->format('Y/m/d') }}</span>
                    </div>

                    <!-- العنوان -->
                    <h3 class="text-xl font-bold text-[#135158] mb-3 line-clamp-2 group-hover:text-[#d4a853] transition leading-tight">
                        <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                    </h3>

                    <!-- الملخص -->
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-4">{{ $article->excerpt }}</p>

                    <!-- زر اقرأ المزيد -->
                    <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center gap-2 text-[#135158] font-semibold text-sm group-hover:text-[#d4a853] transition">
                        اقرئي المزيد
                        <i class="fa-solid fa-arrow-left text-xs group-hover:-translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-8 text-gray-400">
                <i class="fa-solid fa-newspaper text-3xl mb-2 block"></i>
                لا توجد مقالات حالياً
            </div>
            @endforelse
        </div>

        <!-- زر عرض كل المقالات -->
        @if($latestArticles->count() > 0)
        <div class="text-center mt-10">
            <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 bg-[#135158] text-white px-8 py-3.5 rounded-full font-bold hover:bg-[#0a3a40] transition shadow-lg shadow-[#135158]/25">
                تصفحي كل المقالات
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
        </div>
        @endif

    </div>
</section>
