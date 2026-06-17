<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.branches.index') }}" class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">إضافة فرع جديد</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg p-4">
                <div class="flex items-center gap-2 mb-2 font-semibold"><i class="fa-solid fa-circle-exclamation"></i> يرجى تصحيح الأخطاء:</div>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 sm:p-8">
                <form action="{{ route('admin.branches.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- اختيار المكان -->
                        <div>
                            <label for="location_id" class="block text-sm font-semibold text-gray-700 mb-2">المكان / المنطقة <span class="text-red-500">*</span></label>
                            <select name="location_id" id="location_id" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition bg-white">
                                <option value="">-- اختاري المكان --</option>
                                @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ old('location_id') == $loc->id ? 'selected' : '' }}>{{ $loc->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- اسم الفرع -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">اسم الفرع <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition" placeholder="مثال: فرع العليا">
                        </div>

                        <!-- رقم الهاتف -->
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">رقم الهاتف <span class="text-red-500">*</span></label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" dir="ltr" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-left focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition" placeholder="+966 5x xxx xxxx">
                        </div>

                        <!-- الصورة -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">صورة الفرع</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#135158]/10 file:text-[#135158] hover:file:bg-[#135158]/20 transition cursor-pointer">
                        </div>
                    </div>

                    <!-- ===== الأقسام المتاحة في الفرع ===== -->
                    <div class="mt-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fa-solid fa-layer-group ml-1 text-[#135158]"></i> الأقسام المتاحة في هذا الفرع
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mt-1 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            @foreach($departments as $department)
                            <label class="flex items-center gap-2 p-2 rounded-md hover:bg-gray-100 cursor-pointer transition">
                                <input type="checkbox" name="departments[]" value="{{ $department->id }}"
                                    class="w-4 h-4 text-[#135158] bg-gray-100 border-gray-300 rounded focus:ring-[#135158] focus:ring-2"
                                    {{ in_array($department->id, old('departments', [])) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $department->name }}</span>
                            </label>
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-400 mt-2">يمكنك اختيار قسم واحد أو أكثر متوفر في هذا الفرع.</p>
                    </div>
                    <!-- ===== نهاية الأقسام ===== -->

                    <!-- العنوان -->
                    <div class="mt-5">
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">العنوان التفصيلي <span class="text-red-500">*</span></label>
                        <textarea name="address" id="address" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition resize-none" placeholder="الرياض، حي العليا، شارع التحلية">{{ old('address') }}</textarea>
                    </div>

                    <!-- روابط -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2"><i class="fa-brands fa-instagram ml-1 text-pink-500"></i> رابط الانستجرام</label>
                            <input type="url" name="instagram_url" value="{{ old('instagram_url') }}" dir="ltr" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-left text-sm focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition" placeholder="https://instagram.com/...">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2"><i class="fa-solid fa-map-location-dot ml-1 text-green-500"></i> رابط جوجل ماب</label>
                            <input type="text" name="google_map_url" value="{{ old('google_map_url') }}" dir="ltr" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-left text-sm focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition" placeholder="https://maps.app.goo.gl/...">
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-6 mt-6 border-t border-gray-100">
                        <button type="submit" class="inline-flex items-center gap-2 bg-[#135158] text-white px-6 py-3 rounded-lg hover:bg-[#0a3a40] transition font-semibold">
                            <i class="fa-solid fa-check text-sm"></i> حفظ الفرع
                        </button>
                        <a href="{{ route('admin.branches.index') }}" class="inline-flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-3 rounded-lg hover:bg-gray-200 transition font-semibold">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
