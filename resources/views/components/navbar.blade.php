<nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-100" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center flex-shrink-0">
            <img src="{{ asset('images/Logo-art_bangkok-b.png') }}"
                 alt="Art Bangkok"
                 class="h-6 w-auto">
        </a>

        {{-- Desktop Menu --}}
        @php
            $navLink = 'text-xs tracking-widest uppercase transition';
            $active  = 'text-black font-semibold border-b border-black pb-0.5';
            $inactive = 'text-gray-700 hover:text-black';
        @endphp
        <div class="hidden lg:flex items-center gap-6">
            <a href="{{ route('about') }}"
               class="{{ $navLink }} {{ request()->routeIs('about') ? $active : $inactive }}">About</a>
            <a href="{{ route('exhibition-preview') }}"
               class="{{ $navLink }} {{ request()->routeIs('exhibition-preview') ? $active : $inactive }}">Exhibition Preview</a>
            <a href="{{ route('visitor-information') }}"
               class="{{ $navLink }} {{ request()->routeIs('visitor-information') ? $active : $inactive }}">Visitor Information</a>
            <a href="{{ route('fair-and-event') }}"
               class="{{ $navLink }} {{ request()->routeIs('fair-and-event') ? $active : $inactive }}">Zone & Activity</a>
            <a href="{{ route('exhibitors') }}"
               class="{{ $navLink }} {{ request()->routeIs('exhibitors') ? $active : $inactive }}">Exhibitors & Application</a>
            <a href="{{ route('ticket') }}"
               class="{{ $navLink }} {{ request()->routeIs('ticket') ? $active : $inactive }}">Ticket</a>
        </div>

        {{-- Right Side --}}
        <div class="flex items-center gap-3">

            {{-- Auth Buttons --}}
            @auth
                {{-- Avatar Dropdown --}}
                <div class="relative hidden lg:block" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false"
                            class="flex items-center gap-2 hover:opacity-80 transition">
                        <div class="w-9 h-9 rounded-full bg-black flex items-center justify-center overflow-hidden">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ Auth::user()->profile_photo }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-white text-sm font-semibold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                            @endif
                        </div>
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             :class="open ? 'rotate-180' : ''"
                             class="text-gray-500 transition-transform duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-lg border border-gray-100 py-2 z-50"
                         style="display:none;">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-black truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('dashboard') }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Gallery Application
                            </a>
                            <a href="{{ route('profile') }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Profile Settings
                            </a>
                        </div>
                        @if(Auth::user()->isAdmin())
                        <div class="border-t border-gray-100 py-1">
                            <p class="px-4 pt-2 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-widest">Admin Panel</p>
                            <a href="{{ route('admin.users') }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                User Management
                            </a>
                            <a href="{{ route('admin.applications') }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Applications
                            </a>
                        </div>
                        @endif
                        <div class="border-t border-gray-100 py-1">
                            <form method="POST" action="{{ route('sign-out') }}">
                                @csrf
                                <button type="submit"
                                        class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition w-full text-left">
                                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Mobile Avatar (no dropdown, just link) --}}
                <a href="{{ route('dashboard') }}" class="lg:hidden">
                    <div class="w-9 h-9 rounded-full bg-black flex items-center justify-center overflow-hidden">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ Auth::user()->profile_photo }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-white text-sm font-semibold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        @endif
                    </div>
                </a>

            @else
                {{-- Sign In / Sign Up --}}
                <a href="{{ route('sign-in') }}"
                   class="hidden lg:block text-xs px-5 py-2 rounded-full border border-gray-300 text-gray-700 hover:border-gray-500 hover:text-black transition tracking-wide">
                    Sign In
                </a>
                <a href="{{ route('sign-up') }}"
                   class="hidden lg:block bg-black text-white text-xs px-5 py-2 rounded-full hover:bg-gray-800 transition tracking-wide">
                    Sign Up
                </a>
            @endauth

            {{-- Hamburger --}}
            <button @click="mobileOpen = !mobileOpen"
                    class="lg:hidden flex flex-col gap-1.5 p-2 -mr-2">
                <span class="w-5 h-0.5 bg-black block transition-all" :class="mobileOpen ? 'rotate-45 translate-y-2' : ''"></span>
                <span class="w-5 h-0.5 bg-black block transition-all" :class="mobileOpen ? 'opacity-0' : ''"></span>
                <span class="w-5 h-0.5 bg-black block transition-all" :class="mobileOpen ? '-rotate-45 -translate-y-2' : ''"></span>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="lg:hidden bg-white border-t border-gray-100 px-4 py-4"
         style="display:none;">

        <div class="flex flex-col gap-1">
            @php $mobileLink = 'px-3 py-3 text-sm rounded-xl uppercase tracking-widest transition'; @endphp
            <a href="{{ route('about') }}" class="{{ $mobileLink }} {{ request()->routeIs('about') ? 'text-black font-semibold bg-gray-50' : 'text-gray-700 hover:bg-gray-50' }}">About</a>
            <a href="{{ route('exhibition-preview') }}" class="{{ $mobileLink }} {{ request()->routeIs('exhibition-preview') ? 'text-black font-semibold bg-gray-50' : 'text-gray-700 hover:bg-gray-50' }}">Exhibition Preview</a>
            <a href="{{ route('visitor-information') }}" class="{{ $mobileLink }} {{ request()->routeIs('visitor-information') ? 'text-black font-semibold bg-gray-50' : 'text-gray-700 hover:bg-gray-50' }}">Visitor Information</a>
            <a href="{{ route('fair-and-event') }}" class="{{ $mobileLink }} {{ request()->routeIs('fair-and-event') ? 'text-black font-semibold bg-gray-50' : 'text-gray-700 hover:bg-gray-50' }}">Zone & Activity</a>
            <a href="{{ route('exhibitors') }}" class="{{ $mobileLink }} {{ request()->routeIs('exhibitors') ? 'text-black font-semibold bg-gray-50' : 'text-gray-700 hover:bg-gray-50' }}">Exhibitors & Application</a>
            <a href="{{ route('ticket') }}" class="{{ $mobileLink }} {{ request()->routeIs('ticket') ? 'text-black font-semibold bg-gray-50' : 'text-gray-700 hover:bg-gray-50' }}">Ticket</a>
            <div class="border-t border-gray-100 mt-2 pt-2">
                @auth
                    <div class="px-3 py-2 mb-1">
                        <p class="text-sm font-semibold text-black">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="px-3 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-xl flex items-center gap-2">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Gallery Application
                    </a>
                    <a href="{{ route('profile') }}" class="px-3 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-xl flex items-center gap-2">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Profile Settings
                    </a>
                    @if(Auth::user()->isAdmin())
                    <p class="px-3 pt-3 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-widest">Admin Panel</p>
                    <a href="{{ route('admin.users') }}" class="px-3 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-xl flex items-center gap-2">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        User Management
                    </a>
                    <a href="{{ route('admin.applications') }}" class="px-3 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-xl flex items-center gap-2">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Applications
                    </a>
                    @endif
                    <form method="POST" action="{{ route('sign-out') }}">
                        @csrf
                        <button type="submit" class="w-full px-3 py-3 text-sm text-red-500 hover:bg-red-50 rounded-xl flex items-center gap-2">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Sign Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('sign-in') }}"
                       class="mx-3 border border-gray-300 text-gray-700 text-sm py-3 rounded-xl hover:border-gray-500 hover:text-black transition text-center block">
                        Sign In
                    </a>
                    <a href="{{ route('sign-up') }}"
                       class="mt-2 mx-3 bg-black text-white text-sm py-3 rounded-xl hover:bg-gray-800 transition text-center block">
                        Sign Up
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
