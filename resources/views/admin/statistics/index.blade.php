<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('إدارة الإحصائيات') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 text-center">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm p-6">

                <!-- زر إضافة جديد -->
                <div class="flex justify-end mb-6">
                    <a href="{{ route('admin.statistics.create') }}" class="inline-flex items-center bg-[#E60914] hover:bg-[#C50812] text-white px-6 py-2.5 rounded-lg text-sm font-bold transition focus:outline-none focus:ring-2 focus:ring-[#E60914] focus:ring-offset-2 focus:ring-offset-white">
                        <i class="fas fa-plus ml-2"></i> إضافة إحصائية
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse stats-table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-4 text-gray-500 text-sm uppercase tracking-wider text-center">#</th>
                                <th class="p-4 text-gray-500 text-sm uppercase tracking-wider">الرقم</th>
                                <th class="p-4 text-gray-500 text-sm uppercase tracking-wider">العنوان (عربي)</th>
                                <th class="p-4 text-gray-500 text-sm uppercase tracking-wider text-left">العنوان (إنجليزي)</th>
                                <th class="p-4 text-gray-500 text-sm uppercase tracking-wider text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($stats as $index => $item)
                            <tr class="hover:bg-gray-50 transition duration-200 group">
                                <!-- الترتيب -->
                                <td class="p-4 text-center text-gray-400 font-mono">
                                    {{ $index + 1 }}
                                </td>

                                <!-- الرقم -->
                                <td class="p-4 text-center border-l border-gray-100">
                                    <span class="text-2xl font-serif text-[#D4AF37] font-bold">
                                        {{ $item->number }}
                                    </span>
                                </td>

                                <!-- العنوان العربي -->
                                <td class="p-4">
                                    <span class="text-gray-900 font-medium text-lg">
                                        {{ $item->title_ar }}
                                    </span>
                                </td>

                                <!-- العنوان الإنجليزي -->
                                <td class="p-4 text-left dir-ltr" dir="ltr">
                                    <span class="text-gray-600 text-sm">
                                        {{ $item->title_en }}
                                    </span>
                                </td>

                                <!-- الأزرار -->
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center gap-3 opacity-100 lg:opacity-0 group-hover:opacity-100 transition">
                                        <a href="{{ route('admin.statistics.edit', $item->id) }}" class="text-gray-500 hover:text-[#D4AF37] transition" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.statistics.destroy', $item->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:text-red-600 transition" title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500 border-0">
                                    لا توجد إحصائيات مضافة حالياً.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .stats-table th {
            border-bottom: 1px solid #e5e7eb;
            /* رمادي فاتح بدل الداكن */
            padding-bottom: 15px;
        }

        .stats-table td {
            padding-top: 20px;
            padding-bottom: 20px;
            vertical-align: middle;
        }

        .dir-ltr {
            direction: ltr;
            text-align: left;
        }
    </style>
</x-app-layout>
