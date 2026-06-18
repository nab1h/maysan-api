<div class="min-h-screen bg-gray-50 flex items-center justify-center py-10 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-6xl mx-auto bg-white rounded-3xl shadow-2xl shadow-[#135158]/10 flex flex-col lg:flex-row overflow-hidden border border-gray-100">

        <!-- النصف الأيمن: الصورة والديكور -->
        <div class="hidden lg:block lg:w-1/2 relative bg-cover bg-center" style="background-image: url('/booking.jpg');">
            <div class="absolute inset-0 bg-gradient-to-t from-[#135158] via-[#135158]/80 to-[#135158]/40"></div>

            <!-- معلومات تظهر على الصورة -->
            <div class="absolute bottom-10 right-10 left-10 text-white z-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center">
                        <i data-lucide="sparkles" class="w-6 h-6 text-[#d4a853]"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">عيادة ميثان</h3>
                        <p class="text-white/60 text-xs">MAYSAN CLINIC</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-white/80 text-sm">
                        <i data-lucide="shield-check" class="w-5 h-5 text-[#d4a853]"></i>
                        <span>دفع آمن ومشفّر 100%</span>
                    </div>
                    <div class="flex items-center gap-3 text-white/80 text-sm">
                        <i data-lucide="credit-card" class="w-5 h-5 text-[#d4a853]"></i>
                        <span>مدى • Apple Pay • Visa • Mastercard</span>
                    </div>
                    <div class="flex items-center gap-3 text-white/80 text-sm">
                        <i data-lucide="lock" class="w-5 h-5 text-[#d4a853]"></i>
                        <span>معتمدة من البنك المركزي السعودي</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- النصف الأيسر: الفورم -->
        <div class="w-full lg:w-1/2 p-8 md:p-12 relative overflow-y-auto max-h-[90vh]">

            <!-- هيدر الموبايل -->
            <div class="lg:hidden text-center mb-8">
                <h2 class="text-3xl font-bold text-[#135158]">احجز موعدك الآن</h2>
                <p class="text-gray-500 text-sm mt-2">اختاري الوقت المناسب لك ودعي العناية تبدأ</p>
            </div>

            <!-- حاوية الفورم -->
            <div id="formWrapper">
                <form id="reservationForm" action="{{ route('reservations.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- ===== القسم 1: تفاصيل الموعد ===== -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-7 h-7 rounded-full bg-[#135158] text-white flex items-center justify-center text-xs">1</span>
                            تفاصيل الموعد
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            <!-- المدينة -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">المدينة</label>
                                <select name="location_id" id="locationSelect" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm">
                                    <option value="">اختاري المدينة</option>
                                    @foreach($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- الفرع (ديناميكي حسب المدينة) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">الفرع</label>
                                <select required name="branch_id" id="branchSelect" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm">
                                    <option value="">اختاري المدينة أولاً</option>
                                    @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" data-location="{{ $branch->location_id }}" class="branch-option">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- القسم (ديناميكي حسب الفرع) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">القسم</label>
                                <select name="department_id" id="departmentSelect" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm">
                                    <option value="">اختاري الفرع أولاً</option>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}" data-branches="{{ $department->branches->pluck('id')->implode(',') }}" class="department-option">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- الخدمة (ديناميكي حسب القسم) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">الخدمة</label>
                                <select name="service_id" id="serviceSelect" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm">
                                    <option value="">اختاري القسم أولاً</option>
                                    @foreach($services as $service)
                                    <option value="{{ $service->id }}" data-department="{{ $service->department_id }}" data-price="{{ $service->price }}" class="service-option">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- هل لديك طبيب مفضل؟ -->
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">هل لديك طبيب مفضل؟</label>
                                <div class="flex items-center gap-3">
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="has_preferred_doctor" value="yes" class="peer absolute opacity-0">
                                        <div class="border-2 border-gray-200 peer-checked:border-[#135158] peer-checked:bg-[#135158]/5 rounded-xl px-5 py-2 transition-all duration-300 text-center">
                                            <span class="text-sm font-bold text-gray-700">نعم</span>
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="has_preferred_doctor" value="no" class="peer absolute opacity-0" checked>
                                        <div class="border-2 border-gray-200 peer-checked:border-[#135158] peer-checked:bg-[#135158]/5 rounded-xl px-5 py-2 transition-all duration-300 text-center">
                                            <span class="text-sm font-bold text-gray-700">لا</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- الطبيب (يظهر فقط عند اختيار نعم) -->
                            <div id="doctorSelectWrapper" class="sm:col-span-2 hidden transition-all duration-300">
                                <label class="block text-sm font-medium text-gray-700 mb-1">الطبيب المفضل</label>
                                <select name="doctor_id" id="doctorSelect" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm">
                                    <option value="">اختاري الطبيب</option>
                                    @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" data-branch="{{ $doctor->branch_id }}" class="doctor-option">{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- العرض (ديناميكي حسب الفرع) -->
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-2">
                                    <i data-lucide="gift" class="w-4 h-4 text-[#d4a853]"></i>
                                    العرض (اختياري)
                                </label>
                                <select name="offer_id" id="offerSelect" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm">
                                    <option value="">اختاري الفرع أولاً</option>
                                    @foreach($offers as $offer)
                                    @php
    $discount = $offer->old_price > 0 ? round((($offer->old_price - $offer->price) / $offer->old_price) * 100) : 0;
    $isActive = now()->gte($offer->start_date) && now()->lte($offer->end_date);
                                    @endphp
                                    <option value="{{ $offer->id }}"
                                        data-branch="{{ $offer->branch_id }}"
                                        data-price="{{ $offer->price }}"
                                        data-old-price="{{ $offer->old_price }}"
                                        data-discount="{{ $discount }}"
                                        data-title="{{ $offer->title }}"
                                        data-active="{{ $isActive ? '1' : '0' }}"
                                        data-img="{{ asset('storage/' . $offer->img) }}"
                                        class="offer-option">
                                        {{ $offer->title }} — {{ $offer->price }} ر.س @if($discount > 0) (خصم {{ $discount }}%) @endif
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- بطاقة تفاصيل العرض -->
                            <div id="offerDetailsCard" class="sm:col-span-2 hidden bg-gradient-to-br from-[#135158]/5 to-[#d4a853]/5 rounded-2xl border border-[#135158]/10 overflow-hidden transition-all duration-500">
                                <div class="flex items-start gap-4 p-4">
                                    <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0">
                                        <img id="offerImg" src="" alt="" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 id="offerTitle" class="font-bold text-[#135158] text-sm mb-1 line-clamp-1"></h4>
                                        <div class="flex items-center gap-2 mb-2">
                                            <span id="offerPrice" class="text-xl font-black text-[#135158]"></span>
                                            <span id="offerOldPrice" class="text-sm text-gray-400 line-through"></span>
                                            <span id="offerDiscountBadge" class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full"></span>
                                        </div>
                                        <div id="offerActiveBadge" class="hidden inline-flex items-center gap-1 bg-[#d4a853]/10 text-[#d4a853] text-xs font-bold px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 bg-[#d4a853] rounded-full animate-pulse"></span>
                                            عرض ساري
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- التاريخ والوقت -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">التاريخ المفضل</label>
                                <input required type="date" name="reservation_date" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">الوقت المفضل</label>
                                <input required type="time" name="reservation_time" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- ===== القسم 2: البيانات الشخصية ===== -->
                    <div class="space-y-4 pt-4 border-t border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-7 h-7 rounded-full bg-[#135158] text-white flex items-center justify-center text-xs">2</span>
                            بياناتك الشخصية
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">الاسم بالكامل</label>
                                <input required type="text" name="name" placeholder="مثال: فاطمة أحمد" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">رقم الجوال</label>
                                <input required type="tel" name="phone" placeholder="05xxxxxxxx" dir="ltr" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm text-left">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">رقم الهوية / الإقامة</label>
                                <input required type="text" name="national_id" inputmode="numeric" pattern="[0-9]*" maxlength="10"
                                    placeholder="10xxxxxxxx" dir="ltr"
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm text-left">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني (اختياري)</label>
                                <input type="email" name="email" placeholder="email@example.com" dir="ltr" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm text-left">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">رسالتك (اختياري)</label>
                                <textarea name="message" rows="3" placeholder="اكتب رسالتك أو استفسارك هنا..." class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 pt-4 border-t border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-7 h-7 rounded-full bg-[#135158] text-white flex items-center justify-center text-xs">3</span>
                            طريقة الدفع
                        </h3>

                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="payment_method_type" value="cash" class="peer absolute opacity-0" checked>
                                <div class="border-2 border-gray-200 peer-checked:border-[#135158] peer-checked:bg-[#135158]/5 rounded-xl p-3 transition-all duration-300 text-center">
                                    <span class="text-xs font-bold text-gray-700 block">حجز بدون دفع</span>
                                    <span class="text-[10px] text-gray-400">الدفع في العيادة</span>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="payment_method_type" value="online" id="onlinePaymentRadio" class="peer absolute opacity-0">
                                <div class="border-2 border-gray-200 peer-checked:border-[#d4a853] peer-checked:bg-[#d4a853]/5 rounded-xl p-3 transition-all duration-300 text-center">
                                    <span class="text-xs font-bold text-gray-700 block">دفع إلكتروني</span>
                                    <span class="text-[10px] text-gray-400">تحويل لبوابة الدفع</span>
                                </div>
                            </label>
                        </div>

                        <div id="paymentAmountWrapper" class="hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-1">مبلغ الدفع</label>
                            <div class="relative">
                                <input type="text" id="paymentAmountInput" placeholder="اختاري الخدمة أو العرض أولاً" disabled readonly
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-2.5 pl-14 focus:outline-none focus:ring-2 focus:ring-[#135158] transition text-sm text-left">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400">ر.س</span>
                            </div>
                        </div>
                    </div>

                    <!-- Error Message -->
                    <div id="formErrorMessage" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm transition-opacity duration-300">
                        <ul id="errorList" class="list-disc list-inside"></ul>
                    </div>

                    <!-- ===== أزرار الإرسال ===== -->
                    <div class="pt-2 space-y-3">
                        <button type="submit" id="submitBtn" class="w-full bg-[#135158] text-white font-bold py-3.5 rounded-xl hover:bg-[#1a6b73] transition-all duration-300 transform hover:scale-[1.02] shadow-lg shadow-[#135158]/30 text-lg flex items-center justify-center gap-2">
                            <span id="submitText">تأكيد الحجز</span>
                            <svg id="submitSpinner" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>

                        <button type="button" id="onlinePayBtn" class="hidden w-full bg-gradient-to-r from-[#d4a853] to-[#c9952e] text-white font-bold py-3.5 rounded-xl hover:from-[#c9952e] hover:to-[#b8841f] transition-all duration-300 transform hover:scale-[1.02] shadow-lg shadow-[#d4a853]/30 text-lg flex items-center justify-center gap-2">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                            <span>ادفعي إلكترونياً — <span id="payAmount"></span> ر.س</span>
                        </button>

                        <div id="securePayNote" class="hidden flex items-center justify-center gap-2 text-xs text-gray-400">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                            <span>دفع آمن عبر Tap • مدى • Apple Pay • Visa</span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- حاوية رسالة النجاح -->
            <div id="successWrapper" class="hidden flex flex-col items-center justify-center h-full text-center py-10">
                <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-green-100">
                    <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">تم الحجز بنجاح!</h3>
                <p class="text-gray-500 mb-8">هل تريد حجز موعد آخر؟</p>

                <div id="successActions" class="flex flex-col sm:flex-row justify-center gap-3 w-full max-w-sm">
                    <button id="btnAnotherBooking" class="bg-[#135158] text-white font-bold py-3 px-6 rounded-xl hover:bg-[#1a6b73] transition-all duration-300 shadow-lg shadow-[#135158]/20 flex items-center justify-center gap-2">
                        <i class="fas fa-plus"></i> نعم، حجز آخر
                    </button>
                    <button id="btnNoThanks" class="bg-gray-100 text-gray-700 font-bold py-3 px-6 rounded-xl hover:bg-gray-200 transition-all duration-300 border border-gray-200">
                        لا، شكراً
                    </button>
                </div>

                <div id="thankYouMsg" class="hidden mt-8 text-[#135158] font-semibold text-lg">
                    <p>شكراً لتواصلك معنا! سنتواصل معك قريباً لتأكيد الموعد.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== العناصر الأساسية =====
        const form = document.getElementById('reservationForm');
        const formWrapper = document.getElementById('formWrapper');
        const successWrapper = document.getElementById('successWrapper');
        const errorBox = document.getElementById('formErrorMessage');
        const errorList = document.getElementById('errorList');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitSpinner = document.getElementById('submitSpinner');
        const btnAnotherBooking = document.getElementById('btnAnotherBooking');
        const btnNoThanks = document.getElementById('btnNoThanks');
        const successActions = document.getElementById('successActions');
        const thankYouMsg = document.getElementById('thankYouMsg');

        // ===== عناصر القوائم =====
        const locationSelect = document.getElementById('locationSelect');
        const branchSelect = document.getElementById('branchSelect');
        const departmentSelect = document.getElementById('departmentSelect');
        const serviceSelect = document.getElementById('serviceSelect');
        const doctorSelect = document.getElementById('doctorSelect');
        const doctorSelectWrapper = document.getElementById('doctorSelectWrapper');
        const offerSelect = document.getElementById('offerSelect');

        // ===== عناصر العرض والدفع =====
        const offerDetailsCard = document.getElementById('offerDetailsCard');
        const offerImg = document.getElementById('offerImg');
        const offerTitle = document.getElementById('offerTitle');
        const offerPrice = document.getElementById('offerPrice');
        const offerOldPrice = document.getElementById('offerOldPrice');
        const offerDiscountBadge = document.getElementById('offerDiscountBadge');
        const offerActiveBadge = document.getElementById('offerActiveBadge');
        const onlinePayBtn = document.getElementById('onlinePayBtn');
        const payAmount = document.getElementById('payAmount');
        const securePayNote = document.getElementById('securePayNote');
        const paymentAmountWrapper = document.getElementById('paymentAmountWrapper');
        const paymentAmountInput = document.getElementById('paymentAmountInput');

        let selectedOfferData = null;

        // ===================================================
        // ✅ تخزين الخيارات في مصفوفات
        // ===================================================
        const allBranches = Array.from(document.querySelectorAll('.branch-option'));
        const allDepartments = Array.from(document.querySelectorAll('.department-option'));
        const allServices = Array.from(document.querySelectorAll('.service-option'));
        const allDoctors = Array.from(document.querySelectorAll('.doctor-option'));
        const allOffers = Array.from(document.querySelectorAll('.offer-option'));

        // دالة عامة لفلترة وإعادة بناء القائمة المنسدلة
        function populateSelect(selectEl, items, dataAttr, value, defaultText) {
            selectEl.innerHTML = `<option value="">${defaultText}</option>`;
            items.forEach(function(opt) {
                if (opt.dataset[dataAttr] === value) {
                    selectEl.appendChild(opt.cloneNode(true));
                }
            });
        }

        // ===================================================
        // ✅ تفريغ القوائم الديناميكية فور تحميل الصفحة
        // ===================================================
        departmentSelect.innerHTML = '<option value="">اختاري الفرع أولاً</option>';
        serviceSelect.innerHTML = '<option value="">اختاري القسم أولاً</option>';
        doctorSelect.innerHTML = '<option value="">اختاري الفرع أولاً</option>';
        offerSelect.innerHTML = '<option value="">اختاري الفرع أولاً</option>';

        // ===== تغيير المدينة → فلترة الفروع =====
        locationSelect.addEventListener('change', function() {
            const val = this.value;
            const defaultText = val ? 'اختاري الفرع' : 'اختاري المدينة أولاً';
            populateSelect(branchSelect, allBranches, 'location', val, defaultText);

            departmentSelect.innerHTML = '<option value="">اختاري الفرع أولاً</option>';
            serviceSelect.innerHTML = '<option value="">اختاري القسم أولاً</option>';
            doctorSelect.innerHTML = '<option value="">اختاري الفرع أولاً</option>';
            offerSelect.innerHTML = '<option value="">اختاري الفرع أولاً</option>';
            hideOfferCard();
        });

        // ===== تغيير الفرع → فلترة الأقسام والأطباء والعروض =====
        branchSelect.addEventListener('change', function() {
            const branchId = this.value;

            if (branchId) {
                // 1. فلترة الأقسام (بناءً على الـ data-branches)
                departmentSelect.innerHTML = '<option value="">اختاري القسم</option>';
                allDepartments.forEach(function(opt) {
                    const branchesAttr = opt.getAttribute('data-branches');
                    if (branchesAttr) {
                        // تحويل النص لمصفوفة وإزالة المسافات إن وجدت
                        const branchIds = branchesAttr.split(',').map(id => id.trim());
                        // التأكد من أن رقم الفرع الحالي موجود داخل المصفوفة
                        if (branchIds.includes(String(branchId))) {
                            departmentSelect.appendChild(opt.cloneNode(true));
                        }
                    }
                });

                // 2. فلترة الأطباء
                const doctorDefaultText = 'اختاري الطبيب';
                populateSelect(doctorSelect, allDoctors, 'branch', branchId, doctorDefaultText);

                // 3. فلترة العروض
                const offerDefaultText = 'بدون عرض — حجز عادي';
                populateSelect(offerSelect, allOffers, 'branch', branchId, offerDefaultText);

            } else {
                departmentSelect.innerHTML = '<option value="">اختاري الفرع أولاً</option>';
                doctorSelect.innerHTML = '<option value="">اختاري الفرع أولاً</option>';
                offerSelect.innerHTML = '<option value="">اختاري الفرع أولاً</option>';
            }

            serviceSelect.innerHTML = '<option value="">اختاري القسم أولاً</option>';
            hideOfferCard();
        });

        // ===== تغيير القسم → فلترة الخدمات =====
        departmentSelect.addEventListener('change', function() {
            const val = this.value;
            const defaultText = val ? 'اختاري الخدمة' : 'اختاري القسم أولاً';
            populateSelect(serviceSelect, allServices, 'department', val, defaultText);
            setPaymentAmount();
        });

        // ===================================================
        // ✅ هل لديك طبيب مفضل؟ (إظهار/إخفاء)
        // ===================================================
        const doctorRadios = document.querySelectorAll('input[name="has_preferred_doctor"]');
        doctorRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'yes') {
                    doctorSelectWrapper.classList.remove('hidden');
                    doctorSelect.setAttribute('required', 'required');
                } else {
                    doctorSelectWrapper.classList.add('hidden');
                    doctorSelect.removeAttribute('required');
                    doctorSelect.value = '';
                }
            });
        });

        // إخفاء الأخطاء عند التفاعل مع الفورم
        form.addEventListener('input', () => errorBox.classList.add('hidden'));

        // ===== اختيار العرض =====
        offerSelect.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];

            if (this.value && selected.dataset.price) {
                selectedOfferData = {
                    id: this.value,
                    price: selected.dataset.price,
                    oldPrice: selected.dataset.oldPrice,
                    discount: selected.dataset.discount,
                    title: selected.dataset.title,
                    active: selected.dataset.active,
                    img: selected.dataset.img,
                };

                offerImg.src = selectedOfferData.img;
                offerTitle.textContent = selectedOfferData.title;
                offerPrice.textContent = selectedOfferData.price + ' ر.س';

                offerOldPrice.textContent = selectedOfferData.oldPrice > 0 ? selectedOfferData.oldPrice + ' ر.س' : '';
                offerOldPrice.classList.toggle('hidden', !selectedOfferData.oldPrice || selectedOfferData.oldPrice <= 0);

                offerDiscountBadge.textContent = 'خصم ' + selectedOfferData.discount + '%';
                offerDiscountBadge.classList.toggle('hidden', selectedOfferData.discount <= 0);

                offerActiveBadge.classList.toggle('hidden', selectedOfferData.active !== '1');
                offerDetailsCard.classList.remove('hidden');
                setPaymentAmount();
                updateSubmitButton();
            } else {
                hideOfferCard();
            }
        });

        function hideOfferCard() {
            selectedOfferData = null;
            offerDetailsCard.classList.add('hidden');
            setPaymentAmount();
            updateSubmitButton();
        }

        serviceSelect.addEventListener('change', function() {
            if (selectedOfferData) {
                offerSelect.value = '';
                hideOfferCard();
            }

            setPaymentAmount();
        });

        // ===== تغيير طريقة الدفع =====
        document.querySelectorAll('input[name="payment_method_type"]').forEach(radio => {
            radio.addEventListener('change', updateSubmitButton);
        });

        function getPaymentAmount() {
            if (selectedOfferData?.price) {
                return selectedOfferData.price;
            }

            const selectedService = serviceSelect.options[serviceSelect.selectedIndex];
            return selectedService?.dataset?.price || '';
        }

        function setPaymentAmount() {
            paymentAmountInput.value = getPaymentAmount();
            updateSubmitButton();
        }

        function updateSubmitButton() {
            const isOnline = document.querySelector('input[name="payment_method_type"]:checked')?.value === 'online';
            const amount = getPaymentAmount();

            paymentAmountWrapper.classList.toggle('hidden', !isOnline);
            paymentAmountInput.disabled = !isOnline;
            paymentAmountInput.value = amount;
            const currentPayAmount = document.getElementById('payAmount');
            if (currentPayAmount) {
                currentPayAmount.textContent = amount || '0';
            }

            if (isOnline) {
                submitBtn.classList.add('hidden');
                onlinePayBtn.classList.remove('hidden');
                securePayNote.classList.remove('hidden');
            } else {
                submitBtn.classList.remove('hidden');
                onlinePayBtn.classList.add('hidden');
                securePayNote.classList.add('hidden');
                submitText.textContent = selectedOfferData ? 'تأكيد حجز العرض' : 'تأكيد الحجز';
            }
        }

        // ===== الدفع الإلكتروني =====
        onlinePayBtn.addEventListener('click', handleOnlinePayment);

        function handleOnlinePayment() {
            const name = form.querySelector('[name="name"]').value.trim();
            const phone = form.querySelector('[name="phone"]').value.trim();
            const email = form.querySelector('[name="email"]').value.trim();
            const branchId = branchSelect.value;
            const reservationDate = form.querySelector('[name="reservation_date"]').value;
            const reservationTime = form.querySelector('[name="reservation_time"]').value;
            const amount = getPaymentAmount();

            let errors = [];
            if (!name) errors.push('الاسم بالكامل مطلوب');
            if (!phone) errors.push('رقم الجوال مطلوب');
            if (!email) errors.push('البريد الإلكتروني مطلوب للدفع الإلكتروني');
            if (!branchId) errors.push('يرجى اختيار الفرع');
            if (!reservationDate) errors.push('يرجى اختيار التاريخ المفضل');
            if (!reservationTime) errors.push('يرجى اختيار الوقت المفضل');
            if (!amount || Number(amount) < 1) errors.push('يرجى اختيار خدمة أو عرض له سعر صحيح');

            if (errors.length > 0) {
                showError(errors);
                return;
            }

            errorBox.classList.add('hidden');
            toggleLoading(onlinePayBtn, true, 'جاري التحويل لبوابة الدفع...');

            fetch('{{ route("payment.process") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        offer_id: selectedOfferData?.id || null,
                        description: selectedOfferData?.title || null,
                        customer_name: name,
                        customer_email: email,
                        customer_phone: phone,
                        national_id: form.querySelector('[name="national_id"]').value || null,
                        location_id: locationSelect.value || null,
                        branch_id: branchId,
                        department_id: departmentSelect.value || null,
                        service_id: serviceSelect.value || null,
                        doctor_id: doctorSelect.value || null,
                        reservation_date: reservationDate,
                        reservation_time: reservationTime,
                        message: form.querySelector('[name="message"]').value || null,
                    })
                })
                .then(response => response.ok ? response.json() : response.json().then(err => Promise.reject(err)))
                .then(data => {
                    if (data.success && data.url) {
                        window.location.href = data.url;
                    } else {
                        throw new Error(data.message || 'حدث خطأ');
                    }
                })
                .catch(error => {
                    toggleLoading(onlinePayBtn, false);
                    showError([error.message || 'حدث خطأ أثناء الاتصال ببوابة الدفع']);
                });
        }

        // ===== إرسال الفورم العادي =====
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const hasPreferredDoctor = document.querySelector('input[name="has_preferred_doctor"]:checked').value;
            if (hasPreferredDoctor === 'no') {
                doctorSelect.value = '';
            }

            if (document.querySelector('input[name="payment_method_type"]:checked')?.value === 'online') {
                handleOnlinePayment();
                return;
            }

            errorBox.classList.add('hidden');
            toggleLoading(submitBtn, true, 'جاري الإرسال...', submitSpinner, submitText);

            fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.ok ? response.json() : response.json().then(err => Promise.reject(err)))
                .then(() => {
                    formWrapper.classList.add('hidden');
                    successWrapper.classList.remove('hidden');
                    resetForm();
                })
                .catch(error => {
                    toggleLoading(submitBtn, false, 'تأكيد الحجز', submitSpinner, submitText);
                    if (error.errors) {
                        let errs = [];
                        for (let key in error.errors) error.errors[key].forEach(msg => errs.push(msg));
                        showError(errs);
                    } else {
                        showError(['حدث خطأ غير متوقع، يرجى المحاولة لاحقاً.']);
                    }
                });
        });

        // ===== دوال مساعدة =====
        function showError(messages) {
            errorList.innerHTML = messages.map(e => `<li>${e}</li>`).join('');
            errorBox.classList.remove('hidden');
        }

        function toggleLoading(btn, isLoading, text, spinner, textEl) {
            btn.disabled = isLoading;
            if (spinner) spinner.classList.toggle('hidden', !isLoading);
            if (textEl) textEl.textContent = text;

            if (!spinner && btn === onlinePayBtn) {
                const amount = getPaymentAmount() || '0';
                btn.innerHTML = isLoading ?
                    `<svg class="animate-spin h-5 w-5 text-white inline-block ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> ${text}` :
                    `<i data-lucide="lock" class="w-5 h-5"></i><span>ادفعي إلكترونياً — <span id="payAmount">${amount}</span> ر.س</span>`;
                if (!isLoading) lucide.createIcons();
            }
        }

        function resetForm() {
            form.reset();
            hideOfferCard();
            doctorSelectWrapper.classList.add('hidden');
            successActions.classList.remove('hidden');
            thankYouMsg.classList.add('hidden');
            toggleLoading(submitBtn, false, 'تأكيد الحجز', submitSpinner, submitText);
            updateSubmitButton();
        }

        btnAnotherBooking.addEventListener('click', () => {
            successWrapper.classList.add('hidden');
            formWrapper.classList.remove('hidden');
        });

        btnNoThanks.addEventListener('click', () => {
            successActions.classList.add('hidden');
            thankYouMsg.classList.remove('hidden');
        });

        // ===================================================
        // ✅ اختيار تلقائي للفرع من URL (?branch_id=5)
        // ===================================================
        const urlParams = new URLSearchParams(window.location.search);
        const preselectedBranch = urlParams.get('branch_id') || '{{ $selectedBranch ?? "" }}';

        if (preselectedBranch) {
            const branchOpt = allBranches.find(opt => opt.value === preselectedBranch);
            if (branchOpt && branchOpt.dataset.location) {
                locationSelect.value = branchOpt.dataset.location;
                locationSelect.dispatchEvent(new Event('change'));

                branchSelect.value = preselectedBranch;
                branchSelect.dispatchEvent(new Event('change'));
            }
        }
    });
</script>

@include('includes.payment-way')
