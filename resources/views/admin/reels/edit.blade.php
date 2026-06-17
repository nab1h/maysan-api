<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">تعديل الفيديو</h2>
            <a href="{{ route('admin.reels.index') }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-200 transition text-sm font-semibold">
                <i class="fa-solid fa-arrow-right text-xs"></i> العودة للقائمة
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-xl p-8 shadow-sm">
                <form action="{{ route('admin.reels.update', $reel) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">رابط الفيديو (Instagram Reel URL)</label>
                        <input type="url" name="url" value="{{ old('url', $reel->url) }}"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-[#135158] focus:border-transparent outline-none transition text-sm"
                            required>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">الفرع التابع له الفيديو</label>
                        <select name="branch_id" class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-[#135158] transition text-sm" required>
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('branch_id', $reel->branch_id) == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-[#135158] text-white px-8 py-2.5 rounded-lg hover:bg-[#0a3a40] transition font-semibold text-sm">
                            تحديث الفيديو
                        </button>
                        <a href="{{ route('admin.reels.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
