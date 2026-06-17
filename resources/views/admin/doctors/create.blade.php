<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.doctors.index') }}" class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">إضافة طبيب جديد</h2>
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
                <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- القسم والفرع -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">القسم <span class="text-red-500">*</span></label>
                            <select name="department_id" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition bg-white">
                                <option value="">-- اختاري القسم --</option>
                                @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">الفرع <span class="text-red-500">*</span></label>
                            <select name="branch_id" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition bg-white">
                                <option value="">-- اختاري الفرع --</option>
                                @foreach($branches as $br)
                                <option value="{{ $br->id }}" {{ old('branch_id') == $br->id ? 'selected' : '' }}>{{ $br->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- اسم الطبيب والصورة -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">اسم الطبيب <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition" placeholder="د. أحمد محمد">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">الصورة الشخصية</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#135158]/10 file:text-[#135158] hover:file:bg-[#135158]/20 transition cursor-pointer">
                        </div>
                    </div>

                    <!-- الوصف -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">الوصف / نبذة تعريفية</label>
                        <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition resize-none" placeholder="نبذة مختصرة عن الطبيب وخبراته...">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <button type="submit" class="inline-flex items-center gap-2 bg-[#135158] text-white px-6 py-3 rounded-lg hover:bg-[#0a3a40] transition font-semibold">
                            <i class="fa-solid fa-check text-sm"></i> حفظ الطبيب
                        </button>
                        <a href="{{ route('admin.doctors.index') }}" class="inline-flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-3 rounded-lg hover:bg-gray-200 transition font-semibold">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>