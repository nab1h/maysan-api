@extends('layouts.maysantwo')

@section('title', 'أكتبي رايك')

@section('contentpage')

<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
    <div class="max-w-xl w-full bg-white rounded-3xl shadow-xl shadow-[#135158]/10 overflow-hidden border border-gray-100">

        <!-- Header -->
        <div class="bg-[#135158] p-8 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 mx-auto rounded-full bg-white/10 flex items-center justify-center mb-4 backdrop-blur-sm border border-white/20">
                    <i class="fas fa-quote-right text-gold-400 text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-white">شاركينا رأيكِ</h2>
                <p class="text-white/70 mt-2 text-sm">تقييمكِ يلهمنا ويساعدنا على تقديم الأفضل دائماً</p>
            </div>
        </div>

        <!-- Error Message -->
        <div id="formErrorMessage" class="hidden mx-8 mt-8 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm">
            <ul id="errorList" class="list-disc list-inside"></ul>
        </div>

        <!-- 1. حاوية الفورم -->
        <div id="formWrapper">
            <form id="testimonialForm" action="{{ route('testimonials.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <!-- التقييم بالنجوم -->
                <div class="text-center">
                    <label class="block text-sm font-medium text-gray-700 mb-3">ما هو تقييمكِ لتجربتكِ؟</label>
                    <div class="flex justify-center gap-2" id="starRating">
                        <i class="fas fa-star text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors duration-200" data-value="1"></i>
                        <i class="fas fa-star text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors duration-200" data-value="2"></i>
                        <i class="fas fa-star text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors duration-200" data-value="3"></i>
                        <i class="fas fa-star text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors duration-200" data-value="4"></i>
                        <i class="fas fa-star text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors duration-200" data-value="5"></i>
                    </div>
                    <input type="hidden" name="rating" id="ratingValue" value="">
                    <p id="ratingError" class="text-red-500 text-xs mt-2 hidden">يرجى اختيار التقييم</p>
                </div>

                <!-- الاسم والمسمى الوظيفي -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">الاسم بالكامل <span class="text-red-500">*</span></label>
                        <input type="text" name="name" placeholder="مثال: فاطمة أحمد"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158] focus:border-transparent transition text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">المسمى الوظيفي (اختياري)</label>
                        <input type="text" name="role" placeholder="مثال: مهندسة، معلمة..."
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158] focus:border-transparent transition text-sm">
                    </div>
                </div>

                <!-- الرسالة -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">رسالتكِ وتجربتكِ <span class="text-red-500">*</span></label>
                    <textarea name="message" rows="4" placeholder="اكتبي تجربتكِ مع العيادة وكيف كانت النتائج..."
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158] focus:border-transparent transition text-sm resize-none"></textarea>
                </div>

                <!-- زر الإرسال -->
                <div class="pt-2">
                    <button type="submit" id="submitBtn" class="w-full bg-[#135158] text-white font-bold py-3.5 rounded-xl hover:bg-[#1a6b73] transition-all duration-300 transform hover:scale-[1.02] shadow-lg shadow-[#135158]/30 text-lg flex items-center justify-center gap-2">
                        <span id="submitText">إرسال التقييم</span>
                        <svg id="submitSpinner" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- 2. حاوية رسالة النجاح -->
        <div id="successWrapper" class="hidden p-12 text-center">
            <div class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-green-100">
                <i class="fas fa-heart text-green-500 text-4xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">شكراً لتقييمكِ!</h3>
            <p class="text-gray-500 mb-8">رأيكِ يهمنا ويسعدنا دائماً.</p>

            <div id="successActions" class="flex flex-col sm:flex-row justify-center gap-3">
                <button id="btnAnotherReview" class="bg-[#135158] text-white font-bold py-3 px-6 rounded-xl hover:bg-[#1a6b73] transition-all duration-300 shadow-lg shadow-[#135158]/20 flex items-center justify-center gap-2">
                    <i class="fas fa-plus"></i> إضافة تقييم آخر
                </button>
                <button id="btnNoThanks" class="bg-gray-100 text-gray-700 font-bold py-3 px-6 rounded-xl hover:bg-gray-200 transition-all duration-300 border border-gray-200">
                    العودة للرئيسية
                </button>
            </div>

            <div id="thankYouMsg" class="hidden mt-8 text-[#135158] font-semibold text-lg">
                <p>شكراً لثقتكِ بنا!</p>
            </div>
        </div>

    </div>
</div>

<!-- كود الجافاسكريبت للنجوم والإرسال -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('testimonialForm');
        const formWrapper = document.getElementById('formWrapper');
        const successWrapper = document.getElementById('successWrapper');
        const errorBox = document.getElementById('formErrorMessage');
        const errorList = document.getElementById('errorList');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitSpinner = document.getElementById('submitSpinner');
        const ratingInput = document.getElementById('ratingValue');
        const ratingError = document.getElementById('ratingError');

        const btnAnotherReview = document.getElementById('btnAnotherReview');
        const btnNoThanks = document.getElementById('btnNoThanks');
        const successActions = document.getElementById('successActions');
        const thankYouMsg = document.getElementById('thankYouMsg');

        // ===== منطق النجوم التفاعلية =====
        const stars = document.querySelectorAll('#starRating i');
        let currentRating = 0;

        stars.forEach(star => {
            // عند الضغط على نجمة
            star.addEventListener('click', function() {
                currentRating = this.getAttribute('data-value');
                ratingInput.value = currentRating; // تعيين القيمة للـ input المخفي
                ratingError.classList.add('hidden'); // إخفاء رسالة الخطأ

                // تحديث ألوان النجوم
                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= currentRating) {
                        s.classList.remove('text-gray-300');
                        s.classList.add('text-yellow-400'); // أو text-gold-400
                    } else {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-300');
                    }
                });
            });

            // تأثير Hover (تعليق الماوس)
            star.addEventListener('mouseover', function() {
                const hoverValue = this.getAttribute('data-value');
                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= hoverValue) {
                        s.classList.add('text-yellow-300');
                    } else {
                        s.classList.remove('text-yellow-300');
                    }
                });
            });

            star.addEventListener('mouseout', function() {
                stars.forEach(s => {
                    s.classList.remove('text-yellow-300');
                    // إرجاع النجوم الثابتة بعد إزالة الماوس
                    if (s.getAttribute('data-value') <= currentRating) {
                        s.classList.add('text-yellow-400');
                    }
                });
            });
        });

        // ===== إرسال الفورم =====
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // التحقق من التقييم يدوياً قبل الإرسال
            if (currentRating === 0) {
                ratingError.classList.remove('hidden');
                return;
            }

            errorBox.classList.add('hidden');
            errorList.innerHTML = '';

            submitBtn.disabled = true;
            submitText.textContent = 'جاري الإرسال...';
            submitSpinner.classList.remove('hidden');

            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                    if (response.ok) return response.json();
                    return response.json().then(err => {
                        throw err;
                    });
                })
                .then(data => {
                    formWrapper.classList.add('hidden');
                    successWrapper.classList.remove('hidden');

                    submitBtn.disabled = false;
                    submitText.textContent = 'إرسال التقييم';
                    submitSpinner.classList.add('hidden');

                    // إعادة الفورم والنجوم لحالتهم الأصلية
                    form.reset();
                    currentRating = 0;
                    stars.forEach(s => {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-300');
                    });

                    successActions.classList.remove('hidden');
                    thankYouMsg.classList.add('hidden');
                })
                .catch(error => {
                    submitBtn.disabled = false;
                    submitText.textContent = 'إرسال التقييم';
                    submitSpinner.classList.add('hidden');

                    if (error.errors) {
                        let errorsHtml = '';
                        for (let key in error.errors) {
                            error.errors[key].forEach(msg => {
                                errorsHtml += `<li>${msg}</li>`;
                            });
                        }
                        errorList.innerHTML = errorsHtml;
                        errorBox.classList.remove('hidden');
                    } else {
                        errorList.innerHTML = '<li>حدث خطأ غير متوقع، يرجى المحاولة لاحقاً.</li>';
                        errorBox.classList.remove('hidden');
                    }
                });
        });

        // زر إضافة تقييم آخر
        btnAnotherReview.addEventListener('click', function() {
            successWrapper.classList.add('hidden');
            formWrapper.classList.remove('hidden');
        });

        // زر لا شكراً
        btnNoThanks.addEventListener('click', function() {
            successActions.classList.add('hidden');
            thankYouMsg.classList.remove('hidden');
        });
    });
</script>
@endsection()
