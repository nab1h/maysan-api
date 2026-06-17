<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('إدارة أراء العملاء') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 text-center">
                {{ session('status') }}
            </div>
            @endif

            <!-- حاوية الجدول -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">

                <!-- لجعل الجدول متجاوب مع الموبايل -->
                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-200">
                                <th class="p-4 font-medium w-20">#</th>
                                <th class="p-4 font-medium">اسم العميل</th>
                                <th class="p-4 font-medium">التقييم</th>
                                <th class="p-4 font-medium">الرسالة</th>
                                <th class="p-4 font-medium">الحالة</th>
                                <th class="p-4 font-medium text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($testimonials as $item)
                            <tr class="hover:bg-gray-50 transition duration-200 group">

                                <!-- رقم التعريف -->
                                <td class="p-4 text-gray-400 font-mono">
                                    {{ $item->id }}
                                </td>

                                <!-- اسم العميل -->
                                <td class="p-4">
                                    <div class="font-bold text-gray-900">{{ $item->name }}</div>
                                    @if($item->role)
                                    <div class="text-xs text-gray-500">{{ $item->role }}</div>
                                    @endif
                                </td>

                                <!-- النجوم -->
                                <td class="p-4 text-yellow-500 text-xs">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <=$item->rating)
                                        <i class="fa-solid fa-star"></i>
                                        @else
                                        <i class="fa-regular fa-star text-gray-300"></i>
                                        @endif
                                        @endfor
                                </td>

                                <!-- الرسالة (مع قص النص الطويل) -->
                                <td class="p-4 text-gray-600 max-w-xs">
                                    <p class="truncate" title="{{ $item->message }}">
                                        {{ $item->message }}
                                    </p>
                                </td>

                                <!-- الحالة (Active / Pending) -->
                                <td class="p-4">
                                    @if($item->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span>
                                        منشور
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-yellow-500 rounded-full"></span>
                                        معلق
                                    </span>
                                    @endif
                                </td>

                                <!-- أزرار التحكم -->
                                <td class="p-4">
                                    <div class="flex items-center justify-center gap-2 opacity-100 lg:opacity-0 group-hover:opacity-100 transition">

                                        <!-- زر تغيير الحالة -->
                                        <form action="{{ route('admin.testimonials.update-status', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="p-2 rounded-lg bg-gray-100 text-gray-500 hover:text-white hover:bg-[#E60914] transition" title="{{ $item->is_active ? 'إخفاء' : 'نشر' }}">
                                                <i class="fa-solid {{ $item->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                            </button>
                                        </form>

                                        <!-- زر الحذف -->
                                        <form action="{{ route('admin.testimonials.destroy', $item->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg bg-gray-100 text-red-500 hover:text-white hover:bg-red-600 transition" title="حذف">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-gray-500 border-0">
                                    لا توجد بيانات للعرض
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
