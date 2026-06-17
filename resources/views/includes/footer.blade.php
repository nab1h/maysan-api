<!-- ===== PARTNERS SLIDER SECTION ===== -->

@isset($partner)
<section class="bg-brand-50 py-12 border-t border-brand-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-10 reveal">
        <span class="text-gold-400 text-sm font-bold tracking-wider">شركاؤنا</span>
        <h2 class="text-3xl font-bold text-brand-900 mt-2">نفتخر بثقة نخبة من الشركاء</h2>
    </div>


    <div class="relative overflow-hidden" dir="ltr">
        <div class="absolute left-0 top-0 h-full w-24 bg-gradient-to-r from-brand-50 to-transparent z-10 pointer-events-none"></div>
        <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-brand-50 to-transparent z-10 pointer-events-none"></div>

        <!-- Marquee Track -->
        <div class="flex items-center animate-marquee gap-2 px-6">
            <!-- العناصر الأصلية -->
            @foreach($partner as $p)
            <div class="flex-shrink-0 w-40 h-20 flex items-center justify-center grayscale hover:grayscale-0 opacity-50 hover:opacity-100 transition-all duration-300 cursor-pointer">
                <img src="{{ asset('storage/' . $p->image) }}"
                    alt=" {{ $p->name ?? 'شريك' }}"
                    class="max-w-full max-h-full object-contain">
            </div>
            @endforeach

            <!-- نسخة مكررة لضمان انسيابية التمرير اللانهائي -->
            @foreach($partner as $p)
            <div class="flex-shrink-0 w-40 h-20 flex items-center justify-center grayscale hover:grayscale-0 opacity-50 hover:opacity-100 transition-all duration-300 cursor-pointer">
                <img src="{{ asset('storage/' . $p->image) }}"
                    alt="{{ $p->name ?? 'شريك' }}"
                    class="max-w-full max-h-full object-contain">
            </div>
            @endforeach
        </div>
    </div>
</section>
@endisset

<div class="h-1.5 bg-gradient-to-r from-brand-900 via-gold-400 to-brand-900"></div>

<footer class="bg-gradient-to-b from-brand-900 to-brand-800 text-white relative overflow-hidden">
    <!-- Decorative Blurs -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-gold-400/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-brand-800/50 rounded-full blur-3xl translate-x-1/3 translate-y-1/3"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 mb-16">

            <!-- Brand & Newsletter -->
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-20 backdrop-blur-sm flex items-center justify-center ">
                        @isset($setting)
                        <img src="{{ asset('storage/' .$setting->logo) }}" alt="{{ $setting->site_name ?? 'العيادة' }}" class="h-full w-auto object-contain" />
                        @endisset
                    </div>
                </div>
                <p class="text-white/60 leading-relaxed mb-8 max-w-sm">{{ $content->about_desc_ar ?? 'وجهتك الأولى للجمال والأناقة. نقدم أحدث تقنيات التجميل بأيدي خبراء معتمدين دولياً في بيئة تجمع بين الراحة والفخامة.' }}</p>

                <!-- Social Links (Dynamic) -->
                <div class="flex items-center gap-3 flex-wrap">
                    @isset($setting)
                    @if($setting->facebook)
                    <a href="{{ $setting->facebook }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-blue-600 transition-all group">
                        <i class="fab fa-facebook-f text-white group-hover:text-white transition-colors"></i>
                    </a>
                    @endif
                    @if($setting->instagram)
                    <a href="{{ $setting->instagram }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-pink-500 transition-all group">
                        <i class="fab fa-instagram text-white group-hover:text-white transition-colors"></i>
                    </a>
                    @endif
                    @if($setting->twitter)
                    <a href="{{ $setting->twitter }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-black transition-all group">
                        <i class="fab fa-x-twitter text-white group-hover:text-white transition-colors"></i>
                    </a>
                    @endif
                    @if($setting->snapchat)
                    <a href="{{ $setting->snapchat }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-yellow-400 transition-all group">
                        <i class="fab fa-snapchat-ghost text-white group-hover:text-brand-900 transition-colors"></i>
                    </a>
                    @endif
                    @if($setting->tiktok)
                    <a href="{{ $setting->tiktok }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-gray-900 transition-all group">
                        <i class="fab fa-tiktok text-white group-hover:text-white transition-colors"></i>
                    </a>
                    @endif
                    @if($setting->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-green-500 transition-all group">
                        <i class="fab fa-whatsapp text-white group-hover:text-white transition-colors"></i>
                    </a>
                    @endif
                    @endisset
                </div>
            </div>

            <!-- الأقسام (Dynamic) -->
            <div>
                <h4 class="font-bold text-lg mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 bg-gold-400 rounded-full"></span>
                    أقسامنا
                </h4>
                <ul class="space-y-3">
                    @isset($departments)
                    @foreach($departments as $dept)
                    <li>
                        <a href="{{ route('departments.services', $dept->id) }}" class="group text-white/60 hover:text-white transition-colors text-sm flex items-center gap-2">
                            <i data-lucide="chevron-left" class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity text-gold-400"></i>
                            <span class="group-hover:translate-x-1 transition-transform">{{ $dept->name }}</span>
                        </a>
                    </li>
                    @endforeach
                    @endisset
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 bg-gold-400 rounded-full"></span>
                    خدماتنا
                </h4>
                <ul class="space-y-3">
                    @isset($services)
                    @foreach($services->take(7) as $service)
                    <li>
                        <a href="{{ route('booking.index', ['service_id' => $service->id]) }}" class="group text-white/60 hover:text-white transition-colors text-sm flex items-center gap-2">
                            <i data-lucide="chevron-left" class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity text-gold-400"></i>
                            <span class="group-hover:translate-x-1 transition-transform">{{ $service->name }}</span>
                        </a>
                    </li>
                    @endforeach
                    @endisset
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 bg-gold-400 rounded-full"></span>
                    روابط سريعة
                </h4>
                <ul class="space-y-3 mb-8">
                    @isset($pages)
                    @foreach($pages as $page)
                    <li>
                        <a href="{{ $page->url ?? '#' }}" class="group text-white/60 hover:text-white transition-colors text-sm flex items-center gap-2">
                            <i data-lucide="chevron-left" class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity text-gold-400"></i>
                            <span class="group-hover:translate-x-1 transition-transform">{{ $page->title }}</span>
                        </a>
                    </li>
                    @endforeach
                    @else
                    <li><a href="#home" class="group text-white/60 hover:text-white transition-colors text-sm flex items-center gap-2"><i data-lucide="chevron-left" class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity text-gold-400"></i><span class="group-hover:translate-x-1 transition-transform">الرئيسية</span></a></li>
                    <li><a href="#about" class="group text-white/60 hover:text-white transition-colors text-sm flex items-center gap-2"><i data-lucide="chevron-left" class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity text-gold-400"></i><span class="group-hover:translate-x-1 transition-transform">من نحن</span></a></li>
                    <li><a href="#results" class="group text-white/60 hover:text-white transition-colors text-sm flex items-center gap-2"><i data-lucide="chevron-left" class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity text-gold-400"></i><span class="group-hover:translate-x-1 transition-transform">النتائج</span></a></li>
                    <li><a href="#booking" class="group text-white/60 hover:text-white transition-colors text-sm flex items-center gap-2"><i data-lucide="chevron-left" class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity text-gold-400"></i><span class="group-hover:translate-x-1 transition-transform">احجز الآن</span></a></li>
                    <li><a href="{{ route('articles.index') ?? '#' }}" class="group text-white/60 hover:text-white transition-colors text-sm flex items-center gap-2"><i data-lucide="chevron-left" class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity text-gold-400"></i><span class="group-hover:translate-x-1 transition-transform">المقالات</span></a></li>
                    @endisset
                </ul>

                <!-- Contact Info (Dynamic) -->
                @isset($setting)
                <h4 class="font-bold text-lg mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 bg-gold-400 rounded-full"></span>
                    تواصلي معنا
                </h4>
                <ul class="space-y-3">
                    @if($setting->address_ar)
                    <li class="flex items-start gap-2 text-white/60 text-sm">
                        <i data-lucide="map-pin" class="w-4 h-4 flex-shrink-0 text-gold-400 mt-0.5"></i>
                        {{ $setting->address_ar }}
                    </li>
                    @endif
                    @if($setting->hours_ar)
                    <li class="flex items-start gap-2 text-white/60 text-sm">
                        <i data-lucide="clock" class="w-4 h-4 flex-shrink-0 text-gold-400 mt-0.5"></i>
                        {{ $setting->hours_ar }}
                    </li>
                    @endif
                    @if($setting->mobile)
                    <li class="flex items-center gap-2 text-white/60 text-sm" dir="ltr">
                        <i data-lucide="phone" class="w-4 h-4 flex-shrink-0 text-gold-400"></i>
                        {{ $setting->mobile }}
                    </li>
                    @endif
                    @if($setting->email)
                    <li class="flex items-center gap-2 text-white/60 text-sm">
                        <i data-lucide="mail" class="w-4 h-4 flex-shrink-0 text-gold-400"></i>
                        {{ $setting->email }}
                    </li>
                    @endif
                </ul>
                @endisset
            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-white/10 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="text-white/40 text-sm">© {{ date('Y') }} {{ $setting->site_name ?? 'جلو كلينك' }}. جميع الحقوق محفوظة</p>
            <div class="flex gap-6">
                <a href="{{ route('privcy') }}" class="text-white/40 hover:text-white/70 text-sm transition-colors">سياسة الخصوصية</a>
                <a href="{{ route('terms') }}" class="text-white/40 hover:text-white/70 text-sm transition-colors">الشروط والأحكام</a>
            </div>
        </div>
    </div>
</footer>

<!-- ===== WHATSAPP FLOATING BUTTON ===== -->
<a href="tel:{{ preg_replace('/[^0-9]/', '', $setting->mobile) }}"
    target="_blank"
    class="fixed bottom-24 left-6 z-50 w-14 h-14 bg-brand-800 rounded-full flex items-center justify-center shadow-xl shadow-brand-800/30 hover:bg-brand-900 hover:scale-110 transition-all duration-300 pulse-ring"
    aria-label="Call">

    <svg xmlns="http://www.w3.org/2000/svg"
        class="w-6 h-6 text-white"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2">

        <path stroke-linecap="round"
            stroke-linejoin="round"
            d="M3 5a2 2 0 012-2h2.28a2 2 0 011.94 1.515l.516 2.064a2 2 0 01-.45 1.91l-1.27 1.27a16.001 16.001 0 006.586 6.586l1.27-1.27a2 2 0 011.91-.45l2.064.516A2 2 0 0121 16.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
    </svg>
</a>
<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}" target="_blank" class="fixed bottom-6 left-6 z-50 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-xl shadow-green-500/30 hover:bg-green-600 hover:scale-110 transition-all duration-300 pulse-ring">
    <svg xmlns="http://www.w3.org/2000/svg"
        class="w-5 h-5 text-brand-800 hover:text-white transition-colors"
        viewBox="0 0 24 24"
        fill="currentColor">

        <path d="M20.52 3.48A11.91 11.91 0 0 0 12.05 0C5.41 0 .02 5.39.02 12a11.9 11.9 0 0 0 1.64 6.03L0 24l6.21-1.63A11.9 11.9 0 0 0 12.05 24C18.69 24 24 18.61 24 12a11.86 11.86 0 0 0-3.48-8.52zM12.05 21.5a9.5 9.5 0 0 1-4.86-1.33l-.35-.2-3.69.97.99-3.59-.23-.37A9.5 9.5 0 1 1 21.55 12a9.47 9.47 0 0 1-9.5 9.5zm5.19-6.72c-.28-.14-1.65-.81-1.9-.9-.26-.09-.45-.14-.64.14-.19.28-.73.9-.9 1.09-.17.19-.33.21-.61.07-.28-.14-1.18-.43-2.24-1.37-.83-.74-1.39-1.65-1.56-1.93-.16-.28-.02-.43.12-.57.12-.12.28-.33.42-.49.14-.16.19-.28.28-.47.09-.19.05-.35-.02-.49-.07-.14-.64-1.54-.88-2.11-.23-.55-.47-.47-.64-.48h-.55c-.19 0-.49.07-.75.35-.26.28-1 .98-1 2.39s1.02 2.77 1.16 2.96c.14.19 2.02 3.08 4.9 4.32.68.29 1.21.46 1.62.59.68.22 1.3.19 1.79.12.55-.08 1.65-.67 1.88-1.32.23-.65.23-1.21.16-1.32-.07-.11-.26-.17-.54-.31z" />
    </svg>
</a>

<!-- ===== SCRIPTS ===== -->

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    lucide.createIcons();
    // ===== NAVBAR SCROLL =====

    document.addEventListener('DOMContentLoaded', function() {

        const menuBtn = document.getElementById('menuBtn');
        const closeMenuBtn = document.getElementById('closeMenu');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuOverlay = document.getElementById('menuOverlay');

        const mobileServicesBtn = document.getElementById('mobileServicesBtn');
        const mobileServicesMenu = document.getElementById('mobileServicesMenu');
        const servicesChevron = document.getElementById('servicesChevron');

        if (menuBtn) {
            menuBtn.addEventListener('click', function() {
                mobileMenu.classList.add('open');
                menuOverlay.classList.remove('hidden');
                setTimeout(() => menuOverlay.classList.add('opacity-100'), 10);
                document.body.style.overflow = 'hidden'; // منع سكرول الصفحة
            });
        }

        function closeMobileMenu() {
            mobileMenu.classList.remove('open');
            menuOverlay.classList.remove('opacity-100');
            setTimeout(() => {
                menuOverlay.classList.add('hidden');
                document.body.style.overflow = ''; // إرجاع السكرول
            }, 300);
        }

        if (closeMenuBtn) {
            closeMenuBtn.addEventListener('click', closeMobileMenu);
        }
        if (menuOverlay) {
            menuOverlay.addEventListener('click', closeMobileMenu);
        }

        if (mobileServicesBtn) {
            mobileServicesBtn.addEventListener('click', function() {
                mobileServicesMenu.classList.toggle('hidden');
                mobileServicesMenu.classList.toggle('flex');

                if (servicesChevron) {
                    servicesChevron.classList.toggle('rotate-180');
                }
            });
        }

        // branches
        const mobileBranchesBtn = document.getElementById('mobileBranchesBtn');
        const mobileBranchesMenu = document.getElementById('mobileBranchesMenu');
        const branchesChevron = document.getElementById('branchesChevron');

        if (mobileBranchesBtn) {
            mobileBranchesBtn.addEventListener('click', () => {
                mobileBranchesMenu.classList.toggle('hidden');
                mobileBranchesMenu.classList.toggle('flex');
                branchesChevron.classList.toggle('rotate-180');
            });
        }
        // =================================
        const navbar = document.getElementById('navbar');
        const navInner = document.getElementById('navInner');
        const logo = document.getElementById('logo');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('nav-scrolled');
                navInner.style.height = '80px'; // تصغير الهيدر
                logo.style.height = '70px'; // تصغير الشعار
            } else {
                navbar.classList.remove('nav-scrolled');
                navInner.style.height = '160px'; // الحجم الأصلي
                logo.style.height = '160px'; // الحجم الأصلي
            }
        });

        // إعادة تشغيل أيقونات Lucide (مهم جداً للعناصر التي تظهر ديناميكياً)
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    });

    // ===== SMOOTH SCROLL (النسخة المصححة للموبايل) =====
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return; // تجاهل الروابط الفارغة

            const target = document.querySelector(targetId);
            if (target) {
                closeMenu();

                setTimeout(() => {
                    const offset = navbar ? navbar.offsetHeight : 80;
                    const top = target.getBoundingClientRect().top + window.scrollY - offset;
                    window.scrollTo({
                        top,
                        behavior: 'smooth'
                    });
                }, 100);
            }
        });
    });

    // ===== SCROLL REVEAL =====
    const revealElements = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, i * 100);
                revealObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    revealElements.forEach(el => revealObserver.observe(el));

    // ===== COUNTER ANIMATION =====
    const counters = document.querySelectorAll('[data-count]');
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.dataset.count);
                let current = 0;
                const increment = target / 60;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    if (target >= 1000) {
                        entry.target.textContent = Math.floor(current).toLocaleString('en') + '+';
                    } else {
                        entry.target.textContent = Math.floor(current) + (target === 98 ? '%' : '+');
                    }
                }, 30);
                counterObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.5
    });

    counters.forEach(counter => counterObserver.observe(counter));

    // ===== ACTIVE NAV LINK =====
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 120;
            if (window.scrollY >= sectionTop) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('text-brand-800', 'bg-brand-50', 'font-semibold');
            link.classList.add('text-gray-500', 'font-medium');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('text-brand-800', 'bg-brand-50', 'font-semibold');
                link.classList.remove('text-gray-500', 'font-medium');
            }
        });
    });

    // ===== BOOKING FORM =====
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            this.style.display = 'none';
            const successMsg = document.getElementById('successMsg');
            if (successMsg) successMsg.classList.remove('hidden');
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });
    }

    // ===== OFFER BOOK HANDLER =====
    function handleOfferBook(name) {
        const toast = document.getElementById('offerToast');
        if (toast) {
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');
            toastTitle.textContent = `جاري حجز: ${name}`;
            toastMessage.textContent = 'سيتم تحويلك لصفحة الحجز خلال لحظات...';
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3500);
        }

        setTimeout(() => {
            const bookingSection = document.getElementById('booking');
            if (bookingSection) {
                const navbar = document.getElementById('navbar');
                const offset = navbar ? navbar.offsetHeight : 80;
                const top = bookingSection.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({
                    top,
                    behavior: 'smooth'
                });
            }
        }, 1500);
    }
</script>

<!-- ===== WELCOME ALERT ===== -->
<div x-data="{ show: false }"
    x-init="
        setTimeout(() => {
            show = true;
            setTimeout(() => { show = false; }, 8000);
        }, 1500);
     "
    x-show="show"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-y-8"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-8"
    class="fixed bottom-24 left-4 right-4 z-50 md:bottom-6 md:left-6 md:right-auto md:max-w-xs"
    style="display: none;">

    <div class="bg-[#135158] rounded-2xl shadow-2xl shadow-brand-900/30 border border-white/10 p-4 flex items-start gap-3 backdrop-blur-md relative overflow-hidden">

        <div class="absolute -top-4 -right-4 w-20 h-20 bg-gold-400/10 rounded-full blur-xl"></div>

        <div class="w-12 h-12 rounded-xl bg-gold-400/20 flex items-center justify-center flex-shrink-0 border border-gold-400/30">
            <i data-lucide="percent" class="w-6 h-6 text-gold-400"></i>
        </div>

        <div class="flex-1 relative z-10 pr-6">
            <h4 class="text-white font-bold text-sm">عروض حصرية تنتظركِ!</h4>
            <p class="text-white/70 text-xs mt-1 leading-relaxed">استمتعي بأحدث عروضنا التجميلية بخصومات تصل إلى 50%.</p>
            <a href="{{ route('offers.index') }}" @click="show = false" class="inline-block mt-3 bg-gold-400 text-brand-900 text-xs font-bold px-4 py-1.5 rounded-lg hover:bg-gold-500 transition-colors shadow-md">
                اكتشفي العروض
            </a>
        </div>

        <button @click="show = false" class="absolute top-2 right-2 w-7 h-7 rounded-full bg-white/10 flex items-center justify-center text-white/60 hover:bg-red-500 hover:text-white transition-colors z-20">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
</div>
<script>
    lucide.createIcons();
</script>
</body>

</html>
