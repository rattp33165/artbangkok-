<nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-100" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">

        {{-- Logo --}}
        <a href="/" class="flex items-center flex-shrink-0">
            <img src="{{ asset('images/Logo-art_bangkok-b.png') }}"
                 alt="Art Bangkok"
                 class="h-6 w-auto">
        </a>

        <!-- {{-- Desktop Menu --}}
        <div class="hidden lg:flex items-center gap-6">
            <a href="#" class="text-xs text-gray-700 hover:text-black tracking-widest uppercase">About</a>
            <a href="#" class="text-xs text-gray-700 hover:text-black tracking-widest uppercase">Exhibition Preview</a>
            <a href="#" class="text-xs text-gray-700 hover:text-black tracking-widest uppercase">Visitor Information</a>
            <a href="#" class="text-xs text-gray-700 hover:text-black tracking-widest uppercase">Fair & Event</a>
            <a href="#" class="text-xs text-gray-700 hover:text-black tracking-widest uppercase">Gallery Application</a>
            <a href="#" class="text-xs text-gray-700 hover:text-black tracking-widest uppercase">Ticket</a>
        </div> -->

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
            <a href="#" class="px-3 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-xl uppercase tracking-widest">About</a>
            <a href="#" class="px-3 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-xl uppercase tracking-widest">Exhibition Preview</a>
            <a href="#" class="px-3 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-xl uppercase tracking-widest">Visitor Information</a>
            <a href="#" class="px-3 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-xl uppercase tracking-widest">Fair & Event</a>
            <a href="#" class="px-3 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-xl uppercase tracking-widest">Gallery Application</a>
            <a href="#" class="px-3 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-xl uppercase tracking-widest">Ticket</a>

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
