<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('profile.index') }}">
                        <img src="{{ asset('avora.png') }}" class="h-20 w-auto" alt="Logo" />
                    </a>
                </div>

                <!-- Navigation Links -->

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('/')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>


                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('profile.index')" :active="request()->routeIs('profile.index')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>


                @if(auth()->user()->role === 'admin')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                        {{ __('Users') }}
                    </x-nav-link>
                </div>
                @endif

                @if(auth()->user()->role === 'admin')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('admin.home-contents.index')" :active="request()->routeIs('admin.home-contents.index')">
                        {{ __('Contents') }}
                    </x-nav-link>
                </div>
                @endif


                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'sales')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                        {{ __('Reservations') }}
                    </x-nav-link>
                </div>
                @endif

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'sales')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('admin.reels.index')" :active="request()->routeIs('admin.reels.index')">
                        {{ __('Reels') }}
                    </x-nav-link>
                </div>
                @endif

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'sales')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('admin.articles.index')" :active="request()->routeIs('admin.articles.index')">
                        {{ __('Articles') }}
                    </x-nav-link>
                </div>
                @endif


                @if(auth()->user()->role === 'admin')
                <div class="hidden sm:flex sm:items-center sm:ms-10 relative group">

                    <!-- Button -->
                    <button
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition duration-200 focus:outline-none">

                        Admin Panel

                        <svg class="ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div
                        class="absolute top-full left-0 mt-0 w-56 rounded-xl border border-gray-200 bg-white shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200 z-50 overflow-hidden">

                        <div class="py-2">

                            <a href="{{ route('admin.testimonials.index') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                Testimonials
                            </a>

                            <a href="{{ route('admin.statistics.index') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                Statistics
                            </a>

                            <a href="{{ route('admin.media.index') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                Media
                            </a>

                            <!-- <a href="{{ route('admin.faqs.index') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                FAQs
                            </a> -->

                            <a href="{{ route('admin.locations.index') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                Locations
                            </a>

                            <a href="{{ route('admin.departments.index') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                Departments
                            </a>

                            <a href="{{ route('admin.services.index') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                Services
                            </a>

                            <a href="{{ route('admin.branches.index') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                Branches
                            </a>

                            <a href="{{ route('admin.offers.index') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                Offers
                            </a>

                            <a href="{{ route('admin.partners.index') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                Partners
                            </a>
                            <a href="{{ route('admin.doctors.index') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                doctors
                            </a>

                            <a href="{{ route('admin.before-afters.index') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                before-afters
                            </a>
                        </div>
                    </div>

                </div>
                @endif

                @if(auth()->user()->role === 'admin')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('settings.index')" :active="request()->routeIs('settings.index')">
                        {{ __('Settings') }}
                    </x-nav-link>
                </div>
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-gray-200 text-sm leading-4 font-medium rounded-lg text-gray-700 bg-white hover:bg-[#E60914]/10 hover:text-[#E60914] hover:border-[#E60914] focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-900 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-200 shadow-sm">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.index')" :active="request()->routeIs('profile.index')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-900">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
