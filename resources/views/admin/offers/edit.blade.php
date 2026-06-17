<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.offers.index') }}" class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">تعديل العرض</h2>
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
                <form action="{{ route('admin.offers.update', $offer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <!-- عنوان العرض -->
                    <div class="mb-5">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">عنوان العرض <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $offer->title) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition">
                    </div>

                    <!-- ✅ الفرع -->
                    <div class="mb-5">
                        <label for="branch_id" class="block text-sm font-semibold text-gray-700 mb-2">الفرع</label>
                        <select name="branch_id" id="branch_id" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition bg-white">
                            <option value="">جميع الفروع</option>
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('branch_id', $offer->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        <p class="mt-2 text-xs text-gray-400">اختاري فرع معين أو اتركيه "جميع الفروع" لعرضه في كل الفروع</p>
                    </div>

                    <!-- الأسعار -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">السعر بعد الخصم (ر.س) <span class="text-red-500">*</span></label>
                            <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price', $offer->price) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition">
                        </div>
                        <div>
                            <label for="old_price" class="block text-sm font-semibold text-gray-700 mb-2">السعر قبل الخصم (ر.س)</label>
                            <input type="number" name="old_price" id="old_price" step="0.01" min="0" value="{{ old('old_price', $offer->old_price) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition">
                        </div>
                    </div>

                    <!-- التواريخ -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">تاريخ البداية <span class="text-red-500">*</span></label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $offer->start_date->format('Y-m-d')) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">تاريخ النهاية <span class="text-red-500">*</span></label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $offer->end_date->format('Y-m-d')) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition">
                        </div>
                    </div>

                    <!-- الصورة -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">صورة العرض</label>
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                @if($offer->img)
                                <img id="imagePreview" src="{{ Storage::url($offer->img) }}" class="w-24 h-16 rounded-xl object-cover border border-gray-200">
                                @else
                                <div id="noImagePlaceholder" class="w-24 h-16 rounded-xl bg-gray-100 flex items-center justify-center">
                                    <i class="fa-solid fa-image text-gray-300 text-xl"></i>
                                </div>
                                <img id="imagePreview" src="" class="w-24 h-16 rounded-xl object-cover border-2 border-dashed border-gray-300 hidden">
                                @endif
                            </div>
                            <div class="flex-1">
                                <input type="file" name="img" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#135158]/10 file:text-[#135158] hover:file:bg-[#135158]/20 transition cursor-pointer">
                                <p class="mt-2 text-xs text-gray-400">اتركيه فارغاً إذا لا تريدين تغيير الصورة</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <button type="submit" class="inline-flex items-center gap-2 bg-[#135158] text-white px-6 py-3 rounded-lg hover:bg-[#0a3a40] transition font-semibold">
                            <i class="fa-solid fa-check text-sm"></i> تحديث العرض
                        </button>
                        <a href="{{ route('admin.offers.index') }}" class="inline-flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-3 rounded-lg hover:bg-gray-200 transition font-semibold">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('input[name="img"]').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('noImagePlaceholder');
            if (e.target.files.length > 0) {
                preview.src = URL.createObjectURL(e.target.files[0]);
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
