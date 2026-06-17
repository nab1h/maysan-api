<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">النتائج (قبل وبعد)</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 text-sm">
                {{ session('status') }}
            </div>
            @endif

            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold text-gray-900">إدارة النتائج</h3>
                <a href="{{ route('admin.before-afters.create') }}" class="bg-[#135158] text-white px-5 py-2.5 rounded-xl font-bold hover:bg-[#1a6b73] transition flex items-center gap-2">
                    <i class="fas fa-plus"></i> إضافة صورة
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-6">
                    @forelse ($results as $result)
                    <div class="border border-gray-200 rounded-xl overflow-hidden group relative">
                        <div class="h-80 overflow-hidden">
                            <img src="{{ asset('storage/' . $result->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            <form action="{{ route('admin.before-afters.destroy', $result->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white text-sm py-2 rounded-lg font-bold transition" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                    <i class="fas fa-trash-alt"></i> حذف
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-10 text-gray-500">لا توجد صور حالياً</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
