<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('إضافة إحصائية جديدة') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm p-8">
                <form action="{{ route('admin.statistics.store') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg p-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">الرقم (مثال: 500+)</label>
                        <input type="text" name="number" value="{{ old('number') }}"
                            class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#E60914] focus:border-[#E60914] transition"
                            placeholder="أدخل الرقم أو القيمة" required autofocus>
                        @error('number') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">العنوان بالعربية</label>
                        <input type="text" name="title_ar" value="{{ old('title_ar') }}"
                            class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#E60914] focus:border-[#E60914] transition"
                            dir="rtl" placeholder="مثال: سنة خبرة" required>
                        @error('title_ar') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">العنوان بالإنجليزية</label>
                        <input type="text" name="title_en" value="{{ old('title_en') }}"
                            class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#E60914] focus:border-[#E60914] transition"
                            dir="ltr" placeholder="Example: Years of Experience" required>
                        @error('title_en') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-gray-700 text-sm font-medium mb-2">الترتيب (للعرض)</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                            class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#E60914] focus:border-[#E60914] transition">
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.statistics.index') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2 transition font-medium">
                            إلغاء
                        </a>
                        <button type="submit" class="bg-[#E60914] hover:bg-[#C50812] text-white font-bold py-3 px-8 rounded-lg transition shadow-sm focus:outline-none focus:ring-2 focus:ring-[#E60914] focus:ring-offset-2 focus:ring-offset-white">
                            حفظ الإحصائية
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
