<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            الهدايا
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach (['success' => 'green', 'error' => 'red', 'info' => 'blue'] as $flashKey => $flashColor)
                @if (session($flashKey))
                    <div class="mb-4 rounded-lg border px-4 py-3 text-sm font-medium
                        {{ $flashColor === 'green' ? 'border-green-200 bg-green-50 text-green-700' : '' }}
                        {{ $flashColor === 'red' ? 'border-red-200 bg-red-50 text-red-700' : '' }}
                        {{ $flashColor === 'blue' ? 'border-blue-200 bg-blue-50 text-blue-700' : '' }}">
                        {{ session($flashKey) }}
                    </div>
                @endif
            @endforeach

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-xs text-gray-500 font-medium">إجمالي الهدايا المدفوعة</p>
                    <h4 class="text-2xl font-black text-[#135158] mt-1">
                        {{ number_format($totalRevenue, 2) }}
                        <span class="text-sm font-bold">ر.س</span>
                    </h4>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-xs text-green-600 font-medium">مدفوعة</p>
                    <h4 class="text-2xl font-black text-gray-900 mt-1">{{ $paidCount }}</h4>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-xs text-yellow-600 font-medium">قيد الانتظار</p>
                    <h4 class="text-2xl font-black text-gray-900 mt-1">{{ $pendingCount }}</h4>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-xs text-red-600 font-medium">فشل الدفع</p>
                    <h4 class="text-2xl font-black text-gray-900 mt-1">{{ $failedCount }}</h4>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-xs text-blue-600 font-medium">تم الاستهلاك</p>
                    <h4 class="text-2xl font-black text-gray-900 mt-1">{{ $consumedCount }}</h4>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="p-4 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <h3 class="font-bold text-gray-800">كل الهدايا</h3>
                    <form action="{{ route('admin.gifts.index') }}" method="GET" class="flex flex-wrap gap-2 w-full md:w-auto">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="بحث بالاسم أو الجوال أو الهوية..."
                            class="flex-1 md:w-72 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#135158]">

                        <select name="status" onchange="this.form.submit()"
                            class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#135158]">
                            <option value="">كل الحالات</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>مدفوع</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>فشل الدفع</option>
                        </select>

                        <button type="submit"
                            class="bg-[#135158] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-[#0a3a40]">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-200">
                                <th class="p-4 font-medium w-20">#</th>
                                <th class="p-4 font-medium">المهدي</th>
                                <th class="p-4 font-medium">رقم الهوية</th>
                                <th class="p-4 font-medium">المهدى إليه</th>
                                <th class="p-4 font-medium">جوال المهدى إليه</th>
                                <th class="p-4 font-medium">الرسالة</th>
                                <th class="p-4 font-medium">المبلغ</th>
                                <th class="p-4 font-medium">رقم العملية</th>
                                <th class="p-4 font-medium">حالة الدفع</th>
                                <th class="p-4 font-medium">حالة الهدية</th>
                                <th class="p-4 font-medium">إجراء</th>
                                <th class="p-4 font-medium">التاريخ</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse ($gifts as $gift)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 text-gray-400 font-mono">{{ $gift->id }}</td>
                                    <td class="p-4">
                                        <div class="font-bold text-gray-900">{{ $gift->sender_name }}</div>
                                        <div class="text-xs text-gray-400" dir="ltr">{{ $gift->sender_phone ?: '-' }}</div>
                                    </td>
                                    <td class="p-4 text-gray-600 font-mono text-xs" dir="ltr">
                                        {{ $gift->sender_national_id ?: '-' }}
                                    </td>
                                    <td class="p-4 font-bold text-gray-900">{{ $gift->recipient_name }}</td>
                                    <td class="p-4 text-gray-600 font-mono" dir="ltr">{{ $gift->recipient_phone }}</td>
                                    <td class="p-4 text-gray-600 max-w-xs">
                                        <span class="line-clamp-2">{{ $gift->message ?: '-' }}</span>
                                    </td>
                                    <td class="p-4 font-bold text-[#135158]">
                                        {{ number_format($gift->amount, 2) }}
                                        <span class="text-xs">ر.س</span>
                                    </td>
                                    <td class="p-4 text-gray-500 font-mono text-xs" dir="ltr">
                                        {{ $gift->transaction_id ?: 'بانتظار الدفع' }}
                                    </td>
                                    <td class="p-4">
                                        @php
                                            $statusClasses = [
                                                'paid' => 'bg-green-50 text-green-700 border-green-200',
                                                'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                                'failed' => 'bg-red-50 text-red-700 border-red-200',
                                            ];
                                            $statusLabels = [
                                                'paid' => 'مدفوع',
                                                'pending' => 'قيد الانتظار',
                                                'failed' => 'فشل الدفع',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $statusClasses[$gift->status] ?? 'bg-gray-50 text-gray-700 border-gray-200' }}">
                                            {{ $statusLabels[$gift->status] ?? $gift->status }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        @if($gift->isConsumed())
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border bg-blue-50 text-blue-700 border-blue-200">
                                                تم الاستهلاك
                                            </span>
                                            <div class="mt-1 text-xs text-gray-400">
                                                {{ $gift->consumed_at?->format('Y-m-d H:i') }}
                                            </div>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border bg-gray-50 text-gray-700 border-gray-200">
                                                لم تستهلك
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        @if($gift->status === 'paid' && !$gift->isConsumed())
                                            <form action="{{ route('admin.gifts.consume', $gift) }}" method="POST"
                                                onsubmit="return confirm('هل تريد تأكيد استهلاك هذه الهدية؟');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-[#135158] text-white hover:bg-[#0a3a40]">
                                                    تأكيد الاستهلاك
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-gray-500 text-xs">
                                        {{ $gift->created_at?->format('Y-m-d H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="p-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center gap-3">
                                            <i class="fa-solid fa-gift text-3xl text-gray-300"></i>
                                            <p>لا توجد هدايا مطابقة</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-200 text-gray-600 text-sm flex justify-between items-center bg-gray-50/50">
                    <span>
                        عرض {{ $gifts->firstItem() ?? 0 }} إلى {{ $gifts->lastItem() ?? 0 }} من إجمالي {{ $gifts->total() }}
                    </span>
                    {{ $gifts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
