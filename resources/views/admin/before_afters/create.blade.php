<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">إضافة صورة (قبل وبعد)</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
                <form action="{{ route('admin.before-afters.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">صورة (قبل وبعد معاً)</label>
                        <input type="file" name="image" required class="w-full border border-gray-300 rounded-xl p-2 focus:ring-[#135158] focus:border-[#135158]">
                        <p class="text-gray-400 text-xs mt-2">يفضل أن تكون الصورة مربعة أو مستطيلة تعرض النتيجة بشكل واضح.</p>
                    </div>

                    <div class="mt-8 flex justify-end gap-4">
                        <a href="{{ route('admin.before-afters.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition">إلغاء</a>
                        <button type="submit" class="px-6 py-2.5 bg-[#135158] text-white rounded-xl font-bold hover:bg-[#1a6b73] transition">حفظ الصورة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
