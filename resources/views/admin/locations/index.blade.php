<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                {{ __('إدارة الأماكن') }}
            </h2>
            <a href="{{ route('admin.locations.create') }}"
                class="inline-flex items-center gap-2 bg-[#135158] text-white px-5 py-2.5 rounded-lg hover:bg-[#0a3a40] transition text-sm font-semibold">
                <i class="fa-solid fa-plus text-xs"></i>
                إضافة مكان جديد
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 text-center flex items-center justify-center gap-2">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('status') }}
            </div>
            @endif

            @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 text-center flex items-center justify-center gap-2">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">

                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-200">
                                <th class="p-4 font-medium w-20">#</th>
                                <th class="p-4 font-medium">اسم المكان</th>
                                <th class="p-4 font-medium">عدد الفروع</th>
                                <th class="p-4 font-medium">تاريخ الإضافة</th>
                                <th class="p-4 font-medium text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($locations as $item)
                            <tr class="hover:bg-gray-50 transition duration-200 group">

                                <td class="p-4 text-gray-400 font-mono">
                                    {{ $item->id }}
                                </td>

                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-[#135158]/10 flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid fa-location-dot text-[#135158]"></i>
                                        </div>
                                        <div class="font-bold text-gray-900">{{ $item->name }}</div>
                                    </div>
                                </td>

                                <td class="p-4">
                                    @php($branchCount = $item->branches()->count())
                                    @if($branchCount > 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                        <i class="fa-solid fa-building text-[10px] ml-1"></i>
                                        {{ $branchCount }} فرع
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-50 text-gray-500 border border-gray-200">
                                        لا توجد فروع
                                    </span>
                                    @endif
                                </td>

                                <td class="p-4 text-gray-500">
                                    {{ $item->created_at->format('Y/m/d') }}
                                </td>

                                <td class="p-4">
                                    <div class="flex items-center justify-center gap-2 opacity-100 lg:opacity-0 group-hover:opacity-100 transition">

                                        <a href="{{ route('admin.locations.edit', $item->id) }}"
                                            class="p-2 rounded-lg bg-gray-100 text-blue-500 hover:text-white hover:bg-blue-600 transition"
                                            title="تعديل">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <form action="{{ route('admin.locations.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('هل أنت متأكد من حذف هذا المكان؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 rounded-lg bg-gray-100 text-red-500 hover:text-white hover:bg-red-600 transition"
                                                title="حذف">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center border-0">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="fa-solid fa-location-dot text-2xl text-gray-300"></i>
                                        </div>
                                        <p class="text-gray-500 font-medium">لا توجد أماكن بعد</p>
                                        <a href="{{ route('admin.locations.create') }}"
                                            class="text-[#135158] font-semibold text-sm hover:underline">
                                            أضيفي أول مكان الآن
                                        </a>
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
