<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.departments.index') }}"
                class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">تعديل القسم</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg p-4">
                <div class="flex items-center gap-2 mb-2 font-semibold">
                    <i class="fa-solid fa-circle-exclamation"></i> يرجى تصحيح الأخطاء التالية:
                </div>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 sm:p-8">
                <form action="{{ route('admin.departments.update', $department->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            اسم القسم <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $department->name) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition"
                            autofocus>
                    </div>

                    <div class="mb-6">
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">صورة القسم</label>
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                @if($department->image)
                                <img id="imagePreview" src="{{ Storage::url($department->image) }}" alt="{{ $department->name }}" class="w-20 h-20 rounded-xl object-cover border border-gray-200">
                                @else
                                <img id="imagePreview" src="" alt="" class="w-20 h-20 rounded-xl object-cover border-2 border-dashed border-gray-300 hidden">
                                <div id="noImagePlaceholder" class="w-20 h-20 rounded-xl bg-gray-100 flex items-center justify-center">
                                    <i class="fa-solid fa-image text-gray-300 text-xl"></i>
                                </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <input type="file" id="image" name="image" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#135158]/10 file:text-[#135158] hover:file:bg-[#135158]/20 transition cursor-pointer">
                                <p class="mt-2 text-xs text-gray-400">اتركيه فارغاً إذا لا تريدين تغيير الصورة</p>
                            </div>
                        </div>
                    </div>

                    @php($sCount = $department->services()->count())
                    @if($sCount > 0)
                    <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center gap-3">
                        <i class="fa-solid fa-circle-info text-blue-500"></i>
                        <span class="text-blue-700 text-sm">يوجد <strong>{{ $sCount }}</strong> خدمة مرتبطة بهذا القسم</span>
                    </div>
                    @endif

                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <button type="submit" class="inline-flex items-center gap-2 bg-[#135158] text-white px-6 py-3 rounded-lg hover:bg-[#0a3a40] transition font-semibold">
                            <i class="fa-solid fa-check text-sm"></i> تحديث القسم
                        </button>
                        <a href="{{ route('admin.departments.index') }}" class="inline-flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-3 rounded-lg hover:bg-gray-200 transition font-semibold">إلغاء</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(e) {
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
