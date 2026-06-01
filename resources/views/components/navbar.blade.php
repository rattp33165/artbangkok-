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
            <a href="/login" class="text-sm text-gray-800 hover:text-black font-['agenda-one']">Login</a>
            <a href="/register"
               class="bg-black text-white text-sm px-5 py-2 rounded-full hover:bg-gray-800 transition font-['agenda-one'] tracking-wide">
                Become a Member
            </a>
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
