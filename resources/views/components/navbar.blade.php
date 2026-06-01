<nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        {{-- Logo --}}
        <a href="/" class="flex items-center">
            <img src="{{ asset('images/Logo-art_bangkok-b.png') }}"
                 alt="Art Bangkok"
                 class="h-8 w-auto">
        </a>

        {{-- Desktop Menu --}}
        <div class="hidden md:flex items-center gap-8">
            <a href="#" class="text-sm text-gray-800 hover:text-black tracking-wide uppercase font-['agenda-one']">About</a>
            <a href="#" class="text-sm text-gray-800 hover:text-black tracking-wide uppercase font-['agenda-one']">Exhibition Preview</a>
            <a href="#" class="text-sm text-gray-800 hover:text-black tracking-wide uppercase font-['agenda-one']">Visitor Information</a>
            <a href="#" class="text-sm text-gray-800 hover:text-black tracking-wide uppercase font-['agenda-one']">Fair & Event</a>
            <a href="#" class="text-sm text-gray-800 hover:text-black tracking-wide uppercase font-['agenda-one']">Gallery Application</a>
            <a href="#" class="text-sm text-gray-800 hover:text-black tracking-wide uppercase font-['agenda-one']">Ticket</a>
        </div>

        {{-- CTA Button --}}
        <div class="hidden md:flex items-center gap-4">
            @auth
                {{-- User Avatar Dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false"
                            class="flex items-center gap-2 hover:opacity-80 transition">

                        {{-- Avatar Circle --}}
                        <div class="w-9 h-9 rounded-full bg-black flex items-center justify-center overflow-hidden border-2 border-transparent hover:border-gray-300 transition">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ Auth::user()->profile_photo }}"
                                    class="w-full h-full object-cover">
                            @else
                                <span class="text-white text-sm font-semibold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                            @endif
                        </div>

                        {{-- Chevron --}}
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            :class="open ? 'rotate-180' : ''"
                            class="text-gray-500 transition-transform duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-lg border border-gray-100 py-2 z-50"
                        style="display: none;">

                        {{-- User Info --}}
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-black truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        {{-- Menu Items --}}
                        <div class="py-1">
                            <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black transition">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Gallery Application
                            </a>
                            <a href="#"
                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black transition">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile Settings
                            </a>
                        </div>

                        {{-- Sign Out --}}
                        <div class="border-t border-gray-100 py-1">
                            <form method="POST" action="{{ route('sign-out') }}">
                                @csrf
                                <button type="submit"
                                        class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition w-full text-left">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            @else
                <a href="{{ route('sign-in') }}" class="text-sm text-gray-800 hover:text-black">Sign In</a>
                <a href="{{ route('sign-up') }}"
                class="bg-black text-white text-sm px-5 py-2 rounded-full hover:bg-gray-800 transition">
                    Sign Up
                </a>
            @endauth
        </div>

        {{-- Mobile Hamburger --}}
        <button id="mobile-menu-btn" class="md:hidden flex flex-col gap-1.5 p-2">
            <span class="w-6 h-0.5 bg-black block"></span>
            <span class="w-6 h-0.5 bg-black block"></span>
            <span class="w-6 h-0.5 bg-black block"></span>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 px-6 py-4 flex flex-col gap-4">
        <a href="#" class="text-sm text-gray-800 uppercase tracking-wide">About</a>
        <a href="#" class="text-sm text-gray-800 uppercase tracking-wide">Exhibition Preview</a>
        <a href="#" class="text-sm text-gray-800 uppercase tracking-wide">Visitor Information</a>
        <a href="#" class="text-sm text-gray-800 uppercase tracking-wide">Fair & Event</a>
        <a href="#" class="text-sm text-gray-800 uppercase tracking-wide">Gallery Application</a>
        <a href="#" class="text-sm text-gray-800 uppercase tracking-wide">Ticket</a>
        <hr>
        <a href="/login" class="text-sm text-gray-800">Login</a>
        <a href="/register" class="bg-black text-white text-sm px-5 py-2 rounded-full text-center">Become a Member</a>
    </div>
</nav>

{{-- Mobile Menu Script --}}
<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
