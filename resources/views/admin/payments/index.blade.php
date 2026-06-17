<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            سجل المدفوعات الإلكترونية
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- إحصائيات سريعة -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-xs text-gray-500 font-medium">إجمالي الإيرادات (المدفوع)</p>
                    <h4 class="text-2xl font-black text-[#135158] mt-1">{{ number_format($totalRevenue, 2) }} <span
                            class="text-sm font-bold">ر.س</span></h4>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-xs text-green-600 font-medium">عمليات ناجحة</p>
                    <h4 class="text-2xl font-black text-gray-900 mt-1">{{ $paidCount }}</h4>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-xs text-yellow-600 font-medium">عمليات قيد الانتظار / فاشلة</p>
                    <h4 class="text-2xl font-black text-gray-900 mt-1">{{ $pendingCount }}</h4>
                </div>
            </div>

            <!-- جدول المدفوعات -->
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">

                <!-- أدوات الفلترة -->
                <div class="p-4 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <h3 class="font-bold text-gray-800">كل العمليات</h3>
                    <form action="{{ route('admin.payments.index') }}" method="GET"
                        class="flex flex-wrap gap-2 w-full md:w-auto">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="بحث برقم الجوال أو الهوية..."
                            class="flex-1 md:w-64 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#135158]">

                        <select name="status" onchange="this.form.submit()"
                            class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#135158]">
                            <option value="">كل الحالات</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>مدفوع ✓</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار
                            </option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>فشل الدفع
                            </option>
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
                                <th class="p-4 font-medium">العميل</th>
                                <th class="p-4 font-medium">رقم الهوية</th>
                                <th class="p-4 font-medium">الجوال</th>
                                <th class="p-4 font-medium">الفرع</th>
                                <th class="p-4 font-medium">الخدمة</th>
                                <th class="p-4 font-medium">المبلغ</th>
                                <th class="p-4 font-medium">رقم العملية</th>
                                <th class="p-4 font-medium">الحالة</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse ($payments as $payment)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 text-gray-400 font-mono">{{ $payment->id }}</td>

                                    <td class="p-4">
                                        <div class="font-bold text-gray-900">{{ $payment->name }}</div>
                                        <div class="text-xs text-gray-400">{{ $payment->email ?: '-' }}</div>
                                    </td>

                                    <td class="p-4 text-gray-600 font-mono text-xs" dir="ltr">
                                        {{ $payment->national_id ?: '-' }}</td>

                                    <td class="p-4 text-gray-600 font-mono" dir="ltr">{{ $payment->phone }}</td>

                                    <td class="p-4">
                                        @if($payment->branch)
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                                {{ $payment->branch->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>

                                    <td class="p-4 text-gray-600">{{ $payment->service->name ?? '-' }}</td>

                                    <td class="p-4 font-bold text-[#135158]">{{ number_format($payment->amount, 2) }} <span
                                            class="text-xs">ر.س</span></td>

                                    <td class="p-4 text-gray-500 font-mono text-xs" dir="ltr">
                                        {{ $payment->transaction_id ?: 'بانتظار الدفع' }}</td>

                                    <td class="p-4">
                                        @php
                                            $statusClasses = [
                                                'paid' => 'bg-green-50 text-green-700 border-green-200',
                                                'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                                'failed' => 'bg-red-50 text-red-700 border-red-200',
                                            ];
                                            $statusLabels = [
                                                'paid' => 'مدفوع ✓',
                                                'pending' => 'قيد الانتظار',
                                                'failed' => 'فشل الدفع',
                                            ];
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $statusClasses[$payment->status] ?? 'bg-gray-50 text-gray-700 border-gray-200' }}">
                                            {{ $statusLabels[$payment->status] ?? $payment->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="p-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center gap-3">
                                            <i class="fa-solid fa-credit-card text-3xl text-gray-300"></i>
                                            <p>لا توجد عمليات دفع مطابقة</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- الترقيم -->
                <div
                    class="p-4 border-t border-gray-200 text-gray-600 text-sm flex justify-between items-center bg-gray-50/50">
                    <span>عرض {{ $payments->firstItem() ?? 0 }} إلى {{ $payments->lastItem() ?? 0 }} من إجمالي
                        {{ $payments->total() }}</span>
                    {{ $payments->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
