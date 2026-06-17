<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">شركاء النجاح</h2>
            <a href="{{ route('admin.partners.create') }}" class="inline-flex items-center gap-2 bg-[#135158] text-white px-5 py-2.5 rounded-lg hover:bg-[#0a3a40] transition text-sm font-semibold">
                <i class="fa-solid fa-plus text-xs"></i> إضافة شريك جديد
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 text-center flex items-center justify-center gap-2">
                <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
            </div>
            @endif

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @forelse($partners as $partner)
                <div class="group bg-white rounded-2xl border border-gray-200 p-4 flex flex-col items-center gap-3 hover:shadow-lg transition relative">

                    <!-- اللوجو -->
                    <div class="w-full h-24 flex items-center justify-center p-2 bg-gray-50 rounded-xl">
                        <img src="{{ Storage::url($partner->image) }}" alt="{{ $partner->name ?? 'شريك' }}" class="max-w-full max-h-full object-contain">
                    </div>

                    <!-- الاسم -->
                    <div class="text-center">
                        <h3 class="text-sm font-bold text-gray-800 truncate w-full">{{ $partner->name ?? 'بدون اسم' }}</h3>
                    </div>

                    <!-- الحالة -->
                    @if(!$partner->is_active)
                    <span class="absolute top-2 left-2 px-2 py-0.5 text-[10px] rounded-full bg-red-50 text-red-500 border border-red-200">مخفي</span>
                    @endif

                    <!-- أزرار التحكم -->
                    <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition mt-auto">
                        <a href="{{ route('admin.partners.edit', $partner->id) }}" class="p-1.5 rounded-lg bg-gray-100 text-blue-500 hover:text-white hover:bg-blue-600 transition" title="تعديل">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                        </a>
                        <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 rounded-lg bg-gray-100 text-red-500 hover:text-white hover:bg-red-600 transition" title="حذف">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    لا يوجد شركاء بعد، أضيفي أول شريك الآن.
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
