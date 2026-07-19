<section class="max-w-7xl mx-auto px-4 sm:px-6 pt-8">
    <div wire:key="carousel-{{ $slides->count() }}-{{ $slides->pluck('id')->join('-') }}"
         class="rounded-3xl border border-gray-200 overflow-hidden shadow-sm bg-white relative h-[480px] md:h-[600px]"
         x-data="{
             current: 0,
             total: {{ max($slides->count(), 1) }},
             autoplay: null,
             start() { this.autoplay = setInterval(() => this.next(), 5000) },
             next() { this.current = (this.current + 1) % this.total },
             prev() { this.current = (this.current - 1 + this.total) % this.total },
             go(i)  { this.current = i }
         }"
         x-init="start()"
         @mouseenter="clearInterval(autoplay)"
         @mouseleave="start()">

        {{-- Slides --}}
        @forelse($slides as $i => $slide)
        <div class="absolute inset-0 transition-opacity duration-700"
             :class="{{ $i }} === current ? 'opacity-100 z-10' : 'opacity-0 z-0'">
            @if($slide->image_path)
                <img src="{{ Storage::url($slide->image_path) }}"
                     class="absolute inset-0 w-full h-full object-cover">
            @else
                <div class="absolute inset-0 bg-black"></div>
            @endif
            <div class="absolute inset-0 flex items-end justify-center text-center md:justify-start md:text-left p-6 md:p-16">
                <div class="relative z-10 w-full md:w-auto">
                    @if($slide->subtitle)
                        <p class="text-gray-500 tracking-[0.3em] uppercase text-xs mb-4">{{ $slide->subtitle }}</p>
                    @endif
                    @if($slide->title)
                        <h2 class="text-4xl md:text-7xl font-bold text-black font-['agenda-one'] leading-tight">
                            {!! nl2br(e($slide->title)) !!}
                        </h2>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="absolute inset-0 bg-black"></div>
        @endforelse

        {{-- Centered Logo & Event Info Overlay --}}
        <div class="absolute inset-0 z-20 flex flex-col items-center justify-center text-center px-4 pointer-events-none select-none">
            <img src="{{ asset('images/Logo-art_bangkok-w.png') }}"
                 alt="Art Bangkok"
                 class="h-20 md:h-28 w-auto mb-6 drop-shadow-lg">
            <p class="text-white text-xs md:text-sm tracking-[0.25em] uppercase font-light drop-shadow">
                7 Oct 26 &mdash; Invitation
            </p>
            <p class="text-white text-xs md:text-sm tracking-[0.25em] uppercase font-light drop-shadow mt-1.5">
                8 &ndash; 11 Oct 26 &mdash; Public ( Ticket Required )
            </p>
            <p class="text-white text-xs md:text-sm tracking-[0.25em] uppercase font-light drop-shadow mt-4">
                Siam Paragon 5th floor (NEX HALL &amp; JEWEL ZONE)
            </p>
        </div>

        {{-- Manage Slides (admin only) --}}
        @auth
        @if(Auth::user()->isAdmin())
        <div class="absolute top-5 right-5 z-30">
            <livewire:slide-manager />
        </div>
        @endif
        @endauth

        {{-- Arrows --}}
        @if($slides->count() > 1)
        <button @click="prev()" class="absolute left-4 md:left-6 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-white/80 hover:bg-white rounded-full shadow flex items-center justify-center transition">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button @click="next()" class="absolute right-4 md:right-6 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-white/80 hover:bg-white rounded-full shadow flex items-center justify-center transition">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>

        {{-- Dots --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
            @foreach($slides as $i => $slide)
            <button @click="go({{ $i }})"
                    :class="{{ $i }} === current ? 'w-6 bg-black' : 'w-2 bg-gray-300 hover:bg-gray-500'"
                    class="h-2 rounded-full transition-all duration-300">
            </button>
            @endforeach
        </div>
        @endif
    </div>
</section>
