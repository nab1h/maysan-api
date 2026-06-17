<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('إدارة المحتوى الرئيسي') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 text-center">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">

                <div class="flex border-b border-gray-200 bg-gray-50/50">
                    <button type="button" onclick="openTab(event, 'hero')" id="btn-hero" class="px-6 py-4 text-sm font-medium text-gray-900 border-b-2 border-[#E60914] focus:outline-none">
                        القسم العلوي (Hero Section)
                    </button>
                    <button type="button" onclick="openTab(event, 'about')" id="btn-about" class="px-6 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-[#E60914] focus:outline-none">
                        من نحن (About Section)
                    </button>
                </div>

                <form action="{{ route('admin.home-contents.update', $content->id) }}" method="POST" class="p-8">
                    @csrf
                    <div id="hero" class="tab-content block">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">نصوص البانر الرئيسي</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div hidden>
                                <label class="block text-gray-700 text-sm mb-2">العنوان الرئيسي (إنجليزي)</label>
                                <input type="text" name="hero_title_en" value="{{ old('hero_title_en', $content->hero_title_en) }}"
                                    class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#E60914] focus:border-[#E60914]">
                            </div>
                            <div hidden>
                                <label class="block text-gray-700 text-sm mb-2">العنوان الرئيسي (عربي)</label>
                                <input type="text" name="hero_title_ar" value="{{ old('hero_title_ar', $content->hero_title_ar) }}"
                                    class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#E60914] focus:border-[#E60914]" dir="rtl">
                            </div>

                            <div hidden>
                                <label class="block text-gray-700 text-sm mb-2">العنوان الفرعي / الوصف المختصر (إنجليزي)</label>
                                <input type="text" name="hero_subtitle_en" value="{{ old('hero_subtitle_en', $content->hero_subtitle_en) }}"
                                    class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#E60914] focus:border-[#E60914]">
                            </div>
                            <div hidden>
                                <label class="block text-gray-700 text-sm mb-2">العنوان الفرعي / الوصف المختصر (عربي)</label>
                                <input type="text" name="hero_subtitle_ar" value="{{ old('hero_subtitle_ar', $content->hero_subtitle_ar) }}"
                                    class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#E60914] focus:border-[#E60914]" dir="rtl">
                            </div>
                        </div>
                    </div>

                    <div id="about" class="tab-content hidden">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">قصة ميسان (About Us)</h3>

                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div hidden>
                                    <label class="block text-gray-700 text-sm mb-2">عنوان القسم (إنجليزي)</label>
                                    <input type="text" name="about_title_en" value="{{ old('about_title_en', $content->about_title_en) }}"
                                        class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#E60914] focus:border-[#E60914]">
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm mb-2">عنوان القسم (عربي)</label>
                                    <input type="text" name="about_title_ar" value="{{ old('about_title_ar', $content->about_title_ar) }}"
                                        class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#E60914] focus:border-[#E60914]" dir="rtl">
                                </div>
                            </div>

                            <div hidden>
                                <label class="block text-gray-700 text-sm mb-2">وصف القصة (إنجليزي)</label>
                                <textarea name="about_desc_en" rows="5"
                                    class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#E60914] focus:border-[#E60914]">{{ old('about_desc_en', $content->about_desc_en) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm mb-2">وصف القصة (عربي)</label>
                                <textarea name="about_desc_ar" rows="5"
                                    class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#E60914] focus:border-[#E60914]" dir="rtl">{{ old('about_desc_ar', $content->about_desc_ar) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                        <button type="submit" class="bg-[#E60914] hover:bg-[#C50812] text-white font-bold py-3 px-8 rounded-lg transition shadow-sm focus:outline-none focus:ring-2 focus:ring-[#E60914] focus:ring-offset-2 focus:ring-offset-white">
                            حفظ المحتوى
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
                tabcontent[i].classList.remove("block");
                tabcontent[i].classList.add("hidden");
            }

            tablinks = document.querySelectorAll("button[onclick^='openTab']");
            tablinks.forEach(function(btn) {
                // إزالة تنسيق الزر النشط (الوضع الفاتح)
                btn.classList.remove("border-[#E60914]", "text-gray-900");
                // إضافة تنسيق الزر غير النشط
                btn.classList.add("border-transparent", "text-gray-500");
            });

            document.getElementById(tabName).style.display = "block";
            document.getElementById(tabName).classList.remove("hidden");
            document.getElementById(tabName).classList.add("block");

            evt.currentTarget.classList.remove("border-transparent", "text-gray-500");
            evt.currentTarget.classList.add("border-[#E60914]", "text-gray-900");
        }

        document.getElementById("btn-hero").click();
    </script>
</x-app-layout>
