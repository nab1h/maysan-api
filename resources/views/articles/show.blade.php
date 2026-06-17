@include('includes.header')
    <!-- Article Hero -->
    <section class="relative h-[50vh] min-h-[400px] overflow-hidden" style="margin-top: 130px;">
        @if($article->image)
        <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
        @else
        <div class="w-full h-full bg-brand-800"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-brand-900/90 via-brand-900/50 to-transparent"></div>

        <div class="absolute bottom-0 right-0 left-0 p-8 lg:p-16">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center gap-3 mb-4">
                    @if($article->department)
                    <span class="text-xs font-bold text-gold-400 bg-gold-400/20 backdrop-blur-sm px-4 py-1.5 rounded-full border border-gold-400/30">{{ $article->department->name }}</span>
                    @endif
                    <span class="text-white/70 text-sm">{{ $article->created_at->format('d M Y') }}</span>
                </div>
                <h1 class="text-3xl lg:text-5xl font-black text-white leading-tight">{{ $article->title }}</h1>
            </div>
        </div>
    </section>

    <!-- Content & Sidebar -->
    <section class="py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-12">

                <!-- المحتوى الرئيسي -->
                <div class="lg:col-span-2">

                    <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-brand-800 flex items-center justify-center text-gold-400 font-bold"><img src="{{ asset('storage/' . $setting->logo) }}" alt="لوجو العياده"></div>
                            <div>
                                <div class="font-bold text-brand-800 text-sm">فريق عيادات ميثان </div>
                                <div class="text-xs text-gray-400">خبراء التجميل والعناية</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 text-gray-400 text-sm">
                            <i data-lucide="eye" class="w-4 h-4"></i> {{ $article->views }} مشاهدة
                        </div>
                    </div>

                    <!-- نص المقال -->
                    <div class="article-content">
                        {!! $article->content !!}
                    </div>

                    <!-- أزرار المشاركة -->
                    <div class="mt-10 pt-6 border-t border-gray-200">
                        <h4 class="font-bold text-brand-800 mb-4">شاركي المقال</h4>
                        <div class="flex items-center gap-3">
                            <a href="https://twitter.com/intent/tweet?url={{ request()->url() }}" target="_blank" class="w-10 h-10 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center hover:bg-blue-500 hover:text-white transition">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ $article->title }} {{ request()->url() }}" target="_blank" class="w-10 h-10 rounded-lg bg-green-50 text-green-600 flex items-center justify-center hover:bg-green-600 hover:text-white transition">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}" target="_blank" class="w-10 h-10 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center hover:bg-blue-700 hover:text-white transition">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- السايدبار -->
                <aside class="lg:col-span-1 space-y-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-brand-800 mb-5 flex items-center gap-2">
                            <i data-lucide="newspaper" class="w-5 h-5 text-gold-400"></i> آخر المقالات
                        </h3>
                        <div class="space-y-4">
                            @foreach($latestArticles as $latest)
                            <a href="{{ route('articles.show', $latest->slug) }}" class="flex items-start gap-3 group">
                                @if($latest->image)
                                <img src="{{ Storage::url($latest->image) }}" class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
                                @else
                                <div class="w-16 h-16 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-newspaper text-gray-300"></i>
                                </div>
                                @endif
                                <div>
                                    <h4 class="font-semibold text-sm text-brand-800 line-clamp-2 group-hover:text-gold-500 transition">{{ $latest->title }}</h4>
                                    <span class="text-xs text-gray-400 mt-1">{{ $latest->created_at->format('Y/m/d') }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>

            <!-- مقالات لها صلة -->
            @if($relatedArticles->count() > 0)
            <div class="mt-16 pt-10 border-t border-gray-200">
                <h3 class="text-2xl font-bold text-brand-800 mb-8 flex items-center gap-2">
                    <i data-lucide="sparkles" class="w-6 h-6 text-gold-400"></i> مقالات ذات صلة
                </h3>
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $related)
                    <article class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition border border-gray-100">
                        <a href="{{ route('articles.show', $related->slug) }}" class="block overflow-hidden">
                            @if($related->image)
                            <img src="{{ Storage::url($related->image) }}" class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif
                        </a>
                        <div class="p-5">
                            <h4 class="font-bold text-brand-800 line-clamp-2 group-hover:text-gold-500 transition">
                                <a href="{{ route('articles.show', $related->slug) }}">{{ $related->title }}</a>
                            </h4>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </section>
@include('includes.footer')
