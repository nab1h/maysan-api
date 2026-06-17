@extends('layouts.maysantwo')

@section('title', 'المقالات')

@section('contentpage')

<section class="bg-white border-b border-gray-100 sticky top-20 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 py-5 overflow-x-auto scrollbar-hide">

            <a href="{{ route('articles.index') }}"
                class="flex-shrink-0 px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 {{ !request()->has('department') ? 'bg-brand-800 text-white shadow-lg shadow-brand-800/25' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                <i class="fa-solid fa-layer-group ml-1.5 text-xs"></i>
                كل المقالات
            </a>

            <!-- فاصل -->
            <div class="w-px h-8 bg-gray-200 flex-shrink-0"></div>

            <form action="{{ route('articles.index') }}" method="GET" class="flex-shrink-0 relative">
                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="ابحثي في المقالات..."
                    class="w-44 md:w-56 bg-gray-100 rounded-full py-2.5 px-4 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-[#135158] focus:bg-white focus:border-[#135158] transition-all duration-300 border border-transparent">

                <!-- زر/أيقونة البحث -->
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#135158] transition-colors">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </button>
            </form>

            @foreach($departments as $dept)
            <a href="{{ route('articles.index', ['department' => $dept->id]) }}"
                class="flex-shrink-0 flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 {{ request()->department == $dept->id ? 'bg-brand-800 text-white shadow-lg shadow-brand-800/25' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                <span>{{ $dept->name }}</span>
                <span class="bg-white/20 text-xs px-2 py-0.5 rounded-full">{{ $dept->articles->count() }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

@php($activeDept = request()->has('department') ? $departments->where('id', request()->department)->first() : null)

@if($activeDept)
<section class="bg-brand-50/50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brand-800 flex items-center justify-center">
                    <i class="fa-solid fa-folder-open text-gold-400"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-brand-800">{{ $activeDept->name }}</h2>
                    <p class="text-xs text-gray-500">{{ $articles->total() }} مقال في هذا القسم</p>
                </div>
            </div>
            <a href="{{ route('articles.index') }}" class="flex items-center gap-2 text-brand-800 font-semibold text-sm hover:text-gold-500 transition">
                <i class="fa-solid fa-arrow-right text-xs"></i>
                كل الأقسام
            </a>
        </div>
    </div>
</section>
@endif

<!-- ===== شبكة المقالات ===== -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($articles->count() > 0)

        <!-- عدد النتائج -->
        <div class="flex items-center justify-between mb-8">
            <p class="text-gray-500 text-sm">
                عرض <span class="font-bold text-brand-800">{{ $articles->firstItem() }}</span>
                إلى <span class="font-bold text-brand-800">{{ $articles->lastItem() }}</span>
                من أصل <span class="font-bold text-brand-800">{{ $articles->total() }}</span> مقال
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <article class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-brand-800/20">

                <!-- صورة المقال -->
                <a href="{{ route('articles.show', $article->slug) }}" class="block overflow-hidden relative">
                    @if($article->image)
                    <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-60 object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                    <div class="w-full h-60 bg-gradient-to-br from-brand-50 to-brand-100 flex items-center justify-center">
                        <i class="fa-solid fa-newspaper text-5xl text-brand-800/20"></i>
                    </div>
                    @endif

                    <!-- القسم على الصورة -->
                    @if($article->department)
                    <div class="absolute top-4 right-4">
                        <span class="text-xs font-bold text-white bg-brand-800/80 backdrop-blur-sm px-3 py-1.5 rounded-full">
                            {{ $article->department->name }}
                        </span>
                    </div>
                    @endif
                </a>

                <div class="p-6">
                    <!-- التاريخ ووقت القراءة -->
                    <div class="flex items-center gap-4 mb-3 text-xs text-gray-400">
                        <span class="flex items-center gap-1.5">
                            <i class="fa-regular fa-calendar"></i>
                            {{ $article->created_at->format('d M Y') }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i class="fa-regular fa-eye"></i>
                            {{ $article->views }}
                        </span>
                    </div>

                    <!-- العنوان -->
                    <h3 class="text-xl font-bold text-brand-800 mb-3 line-clamp-2 group-hover:text-gold-500 transition leading-tight min-h-[3.5rem]">
                        <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                    </h3>

                    <!-- الملخص -->
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-5">
                        {{ $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}
                    </p>

                    <!-- زر اقرأ المزيد -->
                    <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center gap-2 text-brand-800 font-semibold text-sm group-hover:text-gold-500 transition">
                        اقرئي المقال كاملاً
                        <div class="w-6 h-6 rounded-full bg-brand-50 flex items-center justify-center group-hover:bg-gold-400/20 transition">
                            <i data-lucide="arrow-left" class="w-3 h-3 group-hover:-translate-x-0.5 transition-transform"></i>
                        </div>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
        <div class="mt-14 flex justify-center">
            <div class="flex items-center gap-2">
                {{ $articles->withQueryString()->links() }}
            </div>
        </div>
        @endif

        @else
        <!-- حالة عدم وجود مقالات -->
        <div class="text-center py-20">
            <div class="w-24 h-24 rounded-full bg-brand-50 flex items-center justify-center mx-auto mb-6">
                <i class="fa-solid fa-newspaper text-4xl text-brand-800/30"></i>
            </div>
            <h3 class="text-2xl font-bold text-brand-800 mb-2">لا توجد مقالات حالياً</h3>
            <p class="text-gray-500 mb-6">لم يتم نشر مقالات في هذا القسم بعد، تابعينا قريباً!</p>
            <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 bg-brand-800 text-white px-6 py-3 rounded-full font-semibold hover:bg-brand-700 transition">
                <i class="fa-solid fa-arrow-right text-sm"></i>
                تصفحي كل المقالات
            </a>
        </div>
        @endif

    </div>
</section>

<section class="py-16 bg-brand-800 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-80 h-80 bg-gold-400/10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-brand-900/50 rounded-full translate-x-1/3 translate-y-1/3"></div>

    <div class="relative max-w-3xl mx-auto px-4 text-center">
        <div class="w-16 h-16 rounded-2xl bg-gold-400 flex items-center justify-center mx-auto mb-6">
            <i class="fa-solid fa-envelope text-brand-900 text-2xl"></i>
        </div>
        <h2 class="text-3xl font-black text-white mb-4">لا تفوتي أي مقال جديد</h2>
        <p class="text-white/70 mb-8">اشتركي في نشرتنا البريدية وتوصلي بأحدث المقالات والعروض مباشرة</p>
        <div class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
            <input type="email" placeholder="بريدكِ الإلكتروني" class="flex-1 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-6 py-3.5 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-gold-400/50 transition">
            <button class="bg-gold-400 text-brand-900 px-8 py-3.5 rounded-full font-bold hover:bg-gold-500 transition shadow-lg shadow-gold-400/25">
                اشتركي الآن
            </button>
        </div>
    </div>
</section>

@endsection
