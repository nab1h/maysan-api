<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.partners.index') }}" class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">إضافة شريك جديد</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg p-4">
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 sm:p-8">
                <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- اللوجو -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">لوجو الشركة <span class="text-red-500">*</span></label>
                        <input type="file" name="image" accept="image/*" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#135158]/10 file:text-[#135158] hover:file:bg-[#135158]/20 transition cursor-pointer">
                        <p class="mt-2 text-xs text-gray-400">يفضل أن تكون الصورة بخلفية شفافة (PNG أو SVG)</p>
                    </div>

                    <!-- اسم الشركة -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">اسم الشركة (اختياري)</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition" placeholder="مثال: شركة كذا">
                    </div>

                    <!-- لينك الموقع -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">رابط الموقع (اختياري)</label>
                        <input type="url" name="link" value="{{ old('link') }}" dir="ltr" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-left focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition text-sm" placeholder="https://example.com">
                    </div>

                    <!-- إعدادات -->
                    <div class="grid grid-cols-2 gap-4 mb-6 bg-gray-50 p-4 rounded-xl">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الترتيب</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition">
                        </div>
                        <div class="flex items-end pb-1">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 accent-[#135158] rounded border-gray-300 ml-2">
                            <label class="text-sm text-gray-700">نشط</label>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <button type="submit" class="inline-flex items-center gap-2 bg-[#135158] text-white px-6 py-3 rounded-lg hover:bg-[#0a3a40] transition font-semibold">
                            <i class="fa-solid fa-check text-sm"></i> حفظ الشريك
                        </button>
                        <a href="{{ route('admin.partners.index') }}" class="inline-flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-3 rounded-lg hover:bg-gray-200 transition font-semibold">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
