{{-- Sticky Ticket Bar --}}
<div x-data="{ show: false, height: 0 }"
     x-init="height = $refs.bar.offsetHeight; setTimeout(() => show = true, 300)"
     @resize.window="height = $refs.bar.offsetHeight">

    {{-- Spacer so the fixed bar never covers the footer --}}
    <div class="bg-black" :style="`height: ${height}px`"></div>

    <div x-ref="bar"
         :class="show ? 'translate-y-0' : 'translate-y-full'"
         class="fixed bottom-0 inset-x-0 z-40 bg-[#F4F1EC]/95 backdrop-blur-sm border-t border-black/10 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] text-black transition-transform duration-500 ease-out"
         style="padding-bottom: env(safe-area-inset-bottom);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 md:py-4 flex items-center justify-between gap-4">

            {{-- Left: Logo & Dates --}}
            <div class="min-w-0">
                <img src="{{ asset('images/Logo-art_bangkok-b.png') }}"
                     alt="Art Bangkok"
                     class="h-5 md:h-6 w-auto object-contain">
                <p class="text-[10px] md:text-xs uppercase tracking-[0.08em] md:tracking-[0.2em] font-light text-gray-600 leading-snug mt-1.5">
                    7 Oct 26 &mdash; Invitation
                </p>
                <p class="text-[10px] md:text-xs uppercase tracking-[0.08em] md:tracking-[0.2em] font-light text-gray-600 leading-snug">
                    8 &ndash; 11 Oct 26 &mdash; Public (Ticket Required)
                </p>
            </div>

            {{-- Right: CTA --}}
            <a href="https://www.zipeventapp.com/e/art-bangkok-2026"
               target="_blank" rel="noopener noreferrer"
               class="group shrink-0 inline-flex items-center gap-2 bg-black text-white text-xs md:text-sm font-medium uppercase tracking-wide px-5 md:px-7 py-2.5 md:py-3 rounded-full hover:bg-gray-800 transition">
                Get Tickets
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="transition-transform group-hover:translate-x-1">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 6l6 6-6 6"/>
                </svg>
            </a>

        </div>
    </div>
</div>
