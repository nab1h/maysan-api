<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('إدارة الأسئلة الشائعة') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 text-sm flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('status') }}
            </div>
            @endif

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">قائمة الأسئلة الشائعة</h3>
                    <p class="text-gray-500 text-sm mt-1">إدارة الأسئلة والإجابات المتعلقة بالعيادة.</p>
                </div>

                <a href="{{ route('admin.faqs.create') }}">
                    <button class="px-5 py-2.5 bg-[#135158] hover:bg-[#0a3a40] text-white rounded-lg transition flex items-center gap-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#135158] focus:ring-offset-2 focus:ring-offset-white">
                        <i class="fas fa-plus"></i> إضافة سؤال
                    </button>
                </a>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-start">#ID</th>
                                <th class="px-6 py-4 text-start">القسم</th>
                                <th class="px-6 py-4 text-start">السؤال</th>
                                <th class="px-6 py-4 text-start">الحالة</th>
                                <th class="px-6 py-4 text-center">الترتيب</th>
                                <th class="px-6 py-4 text-center">إجراءات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($faqs as $faq)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition duration-200">

                                <td class="px-6 py-4 font-mono text-xs text-gray-400">#{{ $faq->id }}</td>

                                <!-- القسم -->
                                <td class="px-6 py-4">
                                    @if($faq->department)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#135158]/10 text-[#135158] border border-[#135158]/20">
                                        {{ $faq->department->name }}
                                    </span>
                                    @else
                                    <span class="text-xs text-gray-400">غير محدد</span>
                                    @endif
                                </td>

                                <!-- السؤال -->
                                <td class="px-6 py-4">
                                    <span class="text-gray-900 font-medium">{{ Str::limit($faq->question_ar, 60) }}</span>
                                </td>

                                <!-- الحالة -->
                                <td class="px-6 py-4">
                                    @if($faq->is_active)
                                    <span class="px-3 py-1 text-xs rounded-full border border-green-200 bg-green-50 text-green-700">
                                        نشط
                                    </span>
                                    @else
                                    <span class="px-3 py-1 text-xs rounded-full border border-red-200 bg-red-50 text-red-700">
                                        مخفي
                                    </span>
                                    @endif
                                </td>

                                <!-- الترتيب -->
                                <td class="px-6 py-4 text-center">
                                    <span class="bg-gray-100 px-2 py-1 rounded text-xs text-gray-600">
                                        {{ $faq->order_column }}
                                    </span>
                                </td>

                                <!-- الإجراءات -->
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-3 items-center">

                                        <a href="{{ route('admin.faqs.edit', $faq) }}"
                                            class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition border border-blue-100">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>

                                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center text-red-600 hover:bg-red-600 hover:text-white transition border border-red-100"
                                                onclick="return confirm('هل أنت متأكد من حذف هذا السؤال؟')">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-gray-500">
                                    لا توجد أسئلة حالياً.
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
