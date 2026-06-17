<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">إدارة العروض</h2>
            <a href="{{ route('admin.offers.create') }}"
                class="inline-flex items-center gap-2 bg-[#135158] text-white px-5 py-2.5 rounded-lg hover:bg-[#0a3a40] transition text-sm font-semibold">
                <i class="fa-solid fa-plus text-xs"></i> إضافة عرض جديد
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

            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-200">
                                <th class="p-4 font-medium w-20">#</th>
                                <th class="p-4 font-medium">الصورة</th>
                                <th class="p-4 font-medium">العنوان</th>
                                <th class="p-4 font-medium">الفرع</th>
                                <th class="p-4 font-medium">الأسعار</th>
                                <th class="p-4 font-medium">مدة العرض</th>
                                <th class="p-4 font-medium">الحالة</th>
                                <th class="p-4 font-medium text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($offers as $item)
                            <tr class="hover:bg-gray-50 transition duration-200 group">
                                <td class="p-4 text-gray-400 font-mono">{{ $item->id }}</td>

                                <td class="p-4">
                                    @if($item->img)
                                    <img src="{{ Storage::url($item->img) }}" class="w-16 h-10 rounded-lg object-cover border border-gray-200">
                                    @else
                                    <div class="w-16 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                        <i class="fa-solid fa-percent text-gray-300"></i>
                                    </div>
                                    @endif
                                </td>

                                <td class="p-4 font-bold text-gray-900 max-w-xs truncate">{{ $item->title }}</td>

                                <!-- ✅ الفرع -->
                                <td class="p-4">
                                    @if($item->branch)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-[#135158]/10 text-[#135158] border border-[#135158]/20">
                                        <i class="fa-solid fa-location-dot text-[10px]"></i>
                                        {{ $item->branch->name }}
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500 border border-gray-200">
                                        <i class="fa-solid fa-globe text-[10px]"></i>
                                        جميع الفروع
                                    </span>
                                    @endif
                                </td>

                                <!-- الأسعار -->
                                <td class="p-4">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-[#135158]">{{ number_format($item->price, 2) }} <span class="text-xs font-normal">ر.س</span></span>
                                        @if($item->old_price)
                                        <span class="text-xs text-gray-400 line-through">{{ number_format($item->old_price, 2) }}</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- المدة -->
                                <td class="p-4 text-gray-500 text-xs">
                                    <div>{{ \Carbon\Carbon::parse($item->start_date)->format('Y/m/d') }}</div>
                                    <div class="text-gray-300">↓</div>
                                    <div>{{ \Carbon\Carbon::parse($item->end_date)->format('Y/m/d') }}</div>
                                </td>

                                <!-- الحالة -->
                                <td class="p-4">
                                    @php $now = \Carbon\Carbon::today(); @endphp
                                    @if($now->between($item->start_date, $item->end_date))
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                        <span class="w-1.5 h-1.5 ml-1.5 bg-green-500 rounded-full animate-pulse"></span> مفعل
                                    </span>
                                    @elseif($now->lt($item->start_date))
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                        قادم
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-500 border border-red-200">
                                        منتهي
                                    </span>
                                    @endif
                                </td>

                                <td class="p-4">
                                    <div class="flex items-center justify-center gap-2 opacity-100 lg:opacity-0 group-hover:opacity-100 transition">
                                        <a href="{{ route('admin.offers.edit', $item->id) }}" class="p-2 rounded-lg bg-gray-100 text-blue-500 hover:text-white hover:bg-blue-600 transition" title="تعديل">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.offers.destroy', $item->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا العرض؟');">
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
                                <td colspan="8" class="p-12 text-center border-0">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="fa-solid fa-tag text-2xl text-gray-300"></i>
                                        </div>
                                        <p class="text-gray-500 font-medium">لا توجد عروض بعد</p>
                                        <a href="{{ route('admin.offers.create') }}" class="text-[#135158] font-semibold text-sm hover:underline">أضيفي أول عرض الآن</a>
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
