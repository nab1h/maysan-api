<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Reservations Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 text-sm flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('status') }}
            </div>
            @endif

            <!-- Title & Actions -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">سجل الحجوزات</h3>
                    <p class="text-gray-500 text-sm mt-1">إدارة حجوزات العيادة بسهولة وكفاءة.</p>
                </div>

                <div class="flex gap-3">
                    <form action="{{ route('reservations.index') }}" method="GET" class="flex flex-wrap gap-2">
                        <div class="relative group">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400 group-focus-within:text-[#135158] transition"></i>
                            </div>
                            <input type="number" name="search_id" value="{{ request('search_id') }}" placeholder="بحث برقم ID"
                                class="bg-white border border-gray-300 text-gray-900 rounded-lg pl-3 pr-10 py-2.5 focus:outline-none focus:ring-1 focus:ring-[#135158] focus:border-[#135158] w-40 transition text-sm placeholder-gray-400">
                        </div>
                        <select name="status" onchange="this.form.submit()"
                            class="bg-white border border-gray-300 text-gray-900 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-1 focus:ring-[#135158] focus:border-[#135158] cursor-pointer text-sm">
                            <option value="">كل الحالات</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>مؤكد</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مكتمل</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                        </select>
                        <!-- ✅ فلتر حالة الدفع -->
                        <select name="payment_status" onchange="this.form.submit()"
                            class="bg-white border border-gray-300 text-gray-900 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-1 focus:ring-[#135158] focus:border-[#135158] cursor-pointer text-sm">
                            <option value="">كل حالات الدفع</option>
                            <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>غير مدفوع</option>
                            <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>بانتظار الدفع</option>
                            <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>مدفوع</option>
                            <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>فشل الدفع</option>
                        </select>
                        <!-- ✅ فلتر طريقة الدفع -->
                        <select name="payment_method" onchange="this.form.submit()"
                            class="bg-white border border-gray-300 text-gray-900 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-1 focus:ring-[#135158] focus:border-[#135158] cursor-pointer text-sm">
                            <option value="">كل طرق الدفع</option>
                            <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>كاش (العيادة)</option>
                            <option value="online" {{ request('payment_method') == 'online' ? 'selected' : '' }}>إلكتروني</option>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-7 gap-4 mb-8">
                <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <p class="text-gray-500 text-xs">إجمالي الحجوزات</p>
                    <h4 class="text-xl text-gray-900 font-bold mt-1">{{ $totalReservations }}</h4>
                </div>
                <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <p class="text-yellow-600 text-xs font-medium">قيد الانتظار</p>
                    <h4 class="text-xl text-gray-900 font-bold mt-1">{{ $pending }}</h4>
                </div>
                <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <p class="text-blue-600 text-xs font-medium">مؤكد</p>
                    <h4 class="text-xl text-gray-900 font-bold mt-1">{{ $confirmed }}</h4>
                </div>
                <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <p class="text-green-600 text-xs font-medium">مكتمل</p>
                    <h4 class="text-xl text-gray-900 font-bold mt-1">{{ $completed }}</h4>
                </div>
                <!-- ✅ إحصائيات الدفع الجديدة -->
                <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <p class="text-emerald-600 text-xs font-medium">مدفوع إلكترونياً</p>
                    <h4 class="text-xl text-gray-900 font-bold mt-1">{{ $paidCount ?? 0 }}</h4>
                </div>
                <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <p class="text-purple-600 text-xs font-medium">دفع إلكتروني</p>
                    <h4 class="text-xl text-gray-900 font-bold mt-1">{{ $onlineCount ?? 0 }}</h4>
                </div>
                <a href="{{ route('reservations.archive') }}" class="hover:bg-gray-50 transition">
                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm h-full">
                        <p class="text-indigo-600 text-xs font-medium">أرشيف</p>
                        <h4 class="text-xl text-gray-900 font-bold mt-1">{{ $archive }}</h4>
                    </div>
                </a>
            </div>

            <!-- Table -->
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">

                @if(request()->has('status') && request('status') != '')
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200 flex justify-between items-center text-sm">
                    <span class="text-gray-600">
                        جاري عرض الحجوزات ذات الحالة: <span class="text-gray-900 font-bold uppercase">{{ request('status') }}</span>
                    </span>
                    <a href="{{ route('reservations.index') }}" class="text-[#135158] hover:underline font-medium">إزالة الفلتر</a>
                </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-4 text-start">#ID</th>
                                <th class="px-4 py-4 text-start">العرض</th>
                                <th class="px-4 py-4 text-start">القسم</th>
                                <th class="px-4 py-4 text-start">الخدمة</th>
                                <th class="px-4 py-4 text-start">المدينة</th>
                                <th class="px-4 py-4 text-start">الفرع</th>
                                <th class="px-4 py-4 text-start">الطبيب</th>
                                <th class="px-4 py-4 text-start">الاسم بالكامل</th>
                                <th class="px-4 py-4 text-start">الجوال</th>
                                <th class="px-4 py-4 text-start">البريد</th>
                                <th class="px-4 py-4 text-start">التاريخ</th>
                                <th class="px-4 py-4 text-start">الوقت</th>
                                <th class="px-4 py-4 text-start">الرسالة</th>
                                <th class="px-4 py-4 text-start">حالة الحجز</th>
                                <th class="px-4 py-4 text-start">طريقة الدفع</th>
                                <th class="px-4 py-4 text-start">حالة الدفع</th>
                                <th class="px-4 py-4 text-center">إجراءات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($reservations as $reservation)
                            <tr class="border-b border-gray-100 hover:bg-gray-50/50 transition duration-200">
                                <td class="px-4 py-4 font-mono text-xs text-gray-400">#{{ $reservation->id }}</td>

                                <!-- ✅ عمود العرض -->
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if($reservation->offer)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#d4a853]/10 text-[#b8841f] text-xs font-bold">
                                        <i class="fas fa-gift text-[10px]"></i>
                                        {{ Str::limit($reservation->offer->title, 20) }}
                                    </span>
                                    @else
                                    <span class="text-gray-300 text-xs">—</span>
                                    @endif
                                </td>

                                <td class="px-4 py-4 text-gray-600 whitespace-nowrap">{{ $reservation->department->name ?? '-' }}</td>
                                <td class="px-4 py-4 text-gray-600 whitespace-nowrap">{{ $reservation->service->name ?? '-' }}</td>
                                <td class="px-4 py-4 text-gray-600 whitespace-nowrap">{{ $reservation->location->name ?? '-' }}</td>
                                <td class="px-4 py-4 text-gray-600 whitespace-nowrap">{{ $reservation->branch->name ?? '-' }}</td>
                                <td class="px-4 py-4 text-gray-900 font-medium whitespace-nowrap">{{ $reservation->doctor->name ?? '-' }}</td>

                                <td class="px-4 py-4 text-gray-900 font-medium whitespace-nowrap">{{ $reservation->name }}</td>
                                <td class="px-4 py-4 text-gray-600 whitespace-nowrap" dir="ltr">{{ $reservation->phone }}</td>
                                <td class="px-4 py-4 text-gray-600 text-xs">{{ $reservation->email ?? '-' }}</td>

                                <td class="px-4 py-4 text-gray-600 whitespace-nowrap">{{ $reservation->reservation_date }}</td>
                                <td class="px-4 py-4 text-gray-600" dir="ltr">{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</td>

                                <td class="px-4 py-4 text-gray-600 text-xs max-w-[200px] truncate" title="{{ $reservation->message ?? '' }}">
                                    {{ $reservation->message ?? '-' }}
                                </td>

                                <!-- حالة الحجز -->
                                <td class="px-4 py-4">
                                    @php
                                    $statusClasses = [
                                    'pending' => 'bg-yellow-50 text-yellow-700 border border-yellow-200',
                                    'confirmed' => 'bg-blue-50 text-blue-700 border border-blue-200',
                                    'cancelled' => 'bg-red-50 text-red-700 border border-red-200',
                                    'completed' => 'bg-green-50 text-green-700 border border-green-200',
                                    ];
                                    $statusLabels = [
                                    'pending' => 'قيد الانتظار',
                                    'confirmed' => 'مؤكد',
                                    'cancelled' => 'ملغي',
                                    'completed' => 'مكتمل',
                                    ];
                                    @endphp
                                    <span class="px-3 py-1 text-xs rounded-full {{ $statusClasses[$reservation->status] ?? 'bg-gray-50 text-gray-700 border border-gray-200' }}">
                                        {{ $statusLabels[$reservation->status] ?? $reservation->status }}
                                    </span>
                                </td>

                                <!-- ✅ طريقة الدفع -->
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if($reservation->payment_method === 'online')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-purple-50 text-purple-700 border border-purple-200 text-xs font-medium">
                                        <i class="fas fa-credit-card text-[10px]"></i>
                                        إلكتروني
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-gray-50 text-gray-500 border border-gray-200 text-xs font-medium">
                                        <i class="fas fa-money-bill-wave text-[10px]"></i>
                                        كاش
                                    </span>
                                    @endif
                                </td>

                                <!-- ✅ حالة الدفع -->
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @php
                                    $paymentStatusClasses = [
                                    'unpaid' => 'bg-gray-50 text-gray-500 border border-gray-200',
                                    'pending' => 'bg-amber-50 text-amber-700 border border-amber-200',
                                    'paid' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                                    'failed' => 'bg-red-50 text-red-600 border border-red-200',
                                    ];
                                    $paymentStatusLabels = [
                                    'unpaid' => 'غير مدفوع',
                                    'pending' => 'بانتظار الدفع',
                                    'paid' => 'مدفوع ✓',
                                    'failed' => 'فشل الدفع',
                                    ];
                                    @endphp
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium {{ $paymentStatusClasses[$reservation->payment_status] ?? 'bg-gray-50 text-gray-500 border border-gray-200' }}">
                                        @if($reservation->payment_status === 'paid')
                                        <i class="fas fa-check-circle text-[10px]"></i>
                                        @elseif($reservation->payment_status === 'pending')
                                        <i class="fas fa-clock text-[10px] animate-pulse"></i>
                                        @elseif($reservation->payment_status === 'failed')
                                        <i class="fas fa-times-circle text-[10px]"></i>
                                        @endif
                                        {{ $paymentStatusLabels[$reservation->payment_status] ?? $reservation->payment_status }}
                                    </span>
                                </td>

                                <td class="px-4 py-4 text-center">
                                    <div class="flex justify-center gap-2 items-center flex-wrap">

                                        @if($reservation->status == 'pending')
                                        <form action="{{ route('reservations.confirm', $reservation->id) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition" title="تأكيد الحجز">
                                                <i class="fas fa-check text-xs"></i>
                                            </button>
                                        </form>
                                        @endif

                                        @if($reservation->status == 'confirmed')
                                        <form action="{{ route('reservations.complete', $reservation->id) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-green-600 hover:bg-green-600 hover:text-white transition" title="تم الحضور / مكتمل">
                                                <i class="fas fa-check-double text-xs"></i>
                                            </button>
                                        </form>
                                        @endif

                                        @php
                                        $cleanPhone = preg_replace('/[^0-9]/', '', $reservation->phone);
                                        $cleanPhone = ltrim($cleanPhone, '0');
                                        @endphp

                                        <a href="https://wa.me/{{ $cleanPhone }}?text={{ rawurlencode(
                                            'مرحباً ' . $reservation->name . '، نتشرف بتواصلك معنا بخصوص حجزك لعيادة ' . ($reservation->department->name ?? '') .
                                            ' مع د. ' . ($reservation->doctor->name ?? '') .
                                            ' بتاريخ ' . $reservation->reservation_date .
                                            ' الساعة ' . \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') .
                                            ($reservation->offer ? '\nالعرض: ' . $reservation->offer->title : '') .
                                            ($reservation->payment_status === 'paid' ? '\n✅ تم الدفع إلكترونياً' : '') .
                                            ($reservation->message ? '\nرسالتك: ' . $reservation->message : '') .
                                            '. هل تريد التعديل أو التأكيد؟'
                                        ) }}" target="_blank"
                                            class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-green-600 hover:bg-green-600 hover:text-white transition" title="تواصل عبر واتساب">
                                            <i class="fab fa-whatsapp text-xs"></i>
                                        </a>

                                        <form action="{{ route('reservations.moveToArchive', $reservation->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="w-8 h-8 rounded-full bg-yellow-50 flex items-center justify-center text-yellow-600 hover:bg-yellow-500 hover:text-white transition" title="أرشفة">
                                                <i class="fas fa-archive text-xs"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button class="w-8 h-8 rounded-full bg-[#135158]/10 flex items-center justify-center text-[#135158] hover:bg-[#135158] hover:text-white transition" title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذا الحجز؟')">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="17" class="text-center py-10 text-gray-500">
                                    لا توجد حجوزات بهذه الحالة
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-4 border-t border-gray-200 text-gray-600 text-sm flex justify-between items-center bg-gray-50/50">
                    <span>
                        عرض {{ $reservations->firstItem() ?? 0 }} إلى {{ $reservations->lastItem() ?? 0 }} من إجمالي {{ $reservations->total() }}
                    </span>
                    {{ $reservations->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
