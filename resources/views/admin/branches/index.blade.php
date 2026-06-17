<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">إدارة الفروع</h2>
            <a href="{{ route('admin.branches.create') }}"
                class="inline-flex items-center gap-2 bg-[#135158] text-white px-5 py-2.5 rounded-lg hover:bg-[#0a3a40] transition text-sm font-semibold">
                <i class="fa-solid fa-plus text-xs"></i> إضافة فرع جديد
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

            @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 text-center flex items-center justify-center gap-2">
                <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
            </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-200">
                                <th class="p-4 font-medium w-20">#</th>
                                <th class="p-4 font-medium">الصورة</th>
                                <th class="p-4 font-medium">اسم الفرع</th>
                                <th class="p-4 font-medium">المكان</th>
                                <th class="p-4 font-medium">الأقسام المتاحة</th> <!-- تمت إضافة هذا العمود -->
                                <th class="p-4 font-medium">الهاتف</th>
                                <th class="p-4 font-medium">العنوان</th>
                                <th class="p-4 font-medium text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($branches as $item)
                            <tr class="hover:bg-gray-50 transition duration-200 group">
                                <td class="p-4 text-gray-400 font-mono">{{ $item->id }}</td>

                                <td class="p-4">
                                    @if($item->image)
                                    <img src="{{ Storage::url($item->image) }}" class="w-12 h-12 rounded-lg object-cover border border-gray-200">
                                    @else
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                        <i class="fa-solid fa-building text-gray-300"></i>
                                    </div>
                                    @endif
                                </td>

                                <td class="p-4 font-bold text-gray-900">{{ $item->name }}</td>

                                <td class="p-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#135158]/10 text-[#135158] border border-[#135158]/20">
                                        {{ $item->location->name ?? 'غير محدد' }}
                                    </span>
                                </td>

                                <!-- عمود الأقسام الجديد -->
                                <td class="p-4">
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($item->departments as $dept)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-[#d4a853]/10 text-[#d4a853] border border-[#d4a853]/20">
                                            {{ $dept->name }}
                                        </span>
                                        @endforeach
                                        @if($item->departments->isEmpty())
                                        <span class="text-xs text-gray-400 italic">لا توجد أقسام</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="p-4 text-gray-600 font-mono text-xs" dir="ltr">{{ $item->phone }}</td>

                                <td class="p-4 text-gray-500 max-w-xs">
                                    <p class="truncate" title="{{ $item->address }}">{{ $item->address }}</p>
                                </td>

                                <td class="p-4">
                                    <div class="flex items-center justify-center gap-2 opacity-100 lg:opacity-0 group-hover:opacity-100 transition">
                                        <a href="{{ route('admin.branches.edit', $item->id) }}" class="p-2 rounded-lg bg-gray-100 text-blue-500 hover:text-white hover:bg-blue-600 transition" title="تعديل">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.branches.destroy', $item->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا الفرع؟');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg bg-gray-100 text-red-500 hover:text-white hover:bg-red-600 transition" title="حذف">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <!-- تم تغيير colspan إلى 8 لاستيعاب العمود الجديد -->
                                <td colspan="8" class="p-12 text-center border-0">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="fa-solid fa-building text-2xl text-gray-300"></i>
                                        </div>
                                        <p class="text-gray-500 font-medium">لا توجد فروع بعد</p>
                                        <a href="{{ route('admin.branches.create') }}" class="text-[#135158] font-semibold text-sm hover:underline">أضيفي أول فرع الآن</a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
