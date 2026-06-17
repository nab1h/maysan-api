<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('إضافة سؤال جديد') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
                <form action="{{ route('admin.faqs.store') }}" method="POST">
                    @csrf

                    <div class="mb-8 border-b border-gray-200 pb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">تفاصيل السؤال</h3>
                        <p class="text-gray-600 text-sm">أدخل السؤال والإجابة واختر القسم المرتبط به.</p>
                    </div>

                    <!-- اختيار القسم -->
                    <div class="mb-6">
                        <label for="department_id" class="block text-gray-700 text-sm font-semibold mb-2">القسم <span class="text-red-500">*</span></label>
                        <select name="department_id" id="department_id" required
                            class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition">
                            <option value="">-- اختاري القسم --</option>
                            @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- السؤال بالعربي -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">السؤال <span class="text-red-500">*</span></label>
                        <input type="text" name="question_ar" required
                            placeholder="مثال: ما هي ساعات العمل؟"
                            class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition" dir="rtl">
                    </div>

                    <!-- الإجابة بالعربي -->
                    <div class="mb-8">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">الإجابة <span class="text-red-500">*</span></label>
                        <textarea name="answer_ar" rows="5" required
                            class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition resize-y" dir="rtl"></textarea>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mb-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">إعدادات العرض</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">الترتيب (Order)</label>
                                <input type="number" name="order_column" value="1"
                                    class="w-full bg-white border border-gray-300 rounded-lg px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition">
                                <p class="text-xs text-gray-500 mt-1">رقم لترتيب ظهور السؤال في الموقع</p>
                            </div>

                            <div class="flex items-center mt-6 pt-2 md:pt-0">
                                <input type="checkbox" name="is_active" value="1" checked
                                    class="w-5 h-5 accent-[#135158] rounded border-gray-300">
                                <label class="text-gray-700 ml-3 text-sm">نشط (يظهر في الموقع)</label>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" class="bg-[#135158] hover:bg-[#0a3a40] text-white font-bold py-3 px-8 rounded-lg transition shadow-sm flex items-center gap-2 focus:outline-none focus:ring-2 focus:ring-[#135158] focus:ring-offset-2 focus:ring-offset-white">
                            <i class="fas fa-save"></i> حفظ السؤال
                        </button>
                        <a href="{{ route('admin.faqs.index') }}" class="text-gray-600 hover:text-gray-900 transition font-medium">
                            إلغاء
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
