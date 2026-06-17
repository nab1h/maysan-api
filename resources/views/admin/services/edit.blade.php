<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.services.index') }}" class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">تعديل الخدمة</h2>
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
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <!-- اختيار القسم -->
                    <div class="mb-5">
                        <label for="department_id" class="block text-sm font-semibold text-gray-700 mb-2">القسم <span class="text-red-500">*</span></label>
                        <select name="department_id" id="department_id" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition bg-white">
                            <option value="">-- اختاري القسم --</option>
                            @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ old('department_id', $service->department_id) == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- اسم الخدمة -->
                    <div class="mb-5">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">اسم الخدمة <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition">
                    </div>

                    <!-- السعر -->
                    <div class="mb-5">
                        <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">السعر (ر.س) <span class="text-red-500">*</span></label>
                        <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price', $service->price) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition">
                    </div>

                    <!-- الوصف -->
                    <div class="mb-5">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">وصف الخدمة</label>
                        <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition resize-none">{{ old('description', $service->description) }}</textarea>
                    </div>

                    <!-- الصورة -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">صورة الخدمة</label>
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                @if($service->image)
                                <img id="imagePreview" src="{{ Storage::url($service->image) }}" class="w-20 h-20 rounded-xl object-cover border border-gray-200">
                                @else
                                <div id="noImagePlaceholder" class="w-20 h-20 rounded-xl bg-gray-100 flex items-center justify-center">
                                    <i class="fa-solid fa-image text-gray-300 text-xl"></i>
                                </div>
                                <img id="imagePreview" src="" class="w-20 h-20 rounded-xl object-cover border-2 border-dashed border-gray-300 hidden">
                                @endif
                            </div>
                            <div class="flex-1">
                                <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#135158]/10 file:text-[#135158] hover:file:bg-[#135158]/20 transition cursor-pointer">
                                <p class="mt-2 text-xs text-gray-400">اتركيه فارغاً إذا لا تريدين تغيير الصورة</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <button type="submit" class="inline-flex items-center gap-2 bg-[#135158] text-white px-6 py-3 rounded-lg hover:bg-[#0a3a40] transition font-semibold">
                            <i class="fa-solid fa-check text-sm"></i> تحديث الخدمة
                        </button>
                        <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-3 rounded-lg hover:bg-gray-200 transition font-semibold">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('input[name="image"]').addEventListener('change', function(e) {
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
