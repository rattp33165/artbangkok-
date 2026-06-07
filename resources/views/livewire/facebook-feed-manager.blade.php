<div>
    {{-- Manage Button --}}
    <button wire:click="openModal"
            class="inline-flex items-center gap-2 border border-gray-300 hover:border-black text-xs text-gray-600 hover:text-black px-4 py-2 rounded-full transition">
        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        Manage Feed
    </button>

    @if($showModal)
    <div class="fixed inset-0 z-[100] flex items-center justify-center px-4"
         x-data
         x-on:keydown.escape.window="$wire.closeModal()">

        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" wire:click="closeModal"></div>

        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[85vh] flex flex-col z-10">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 flex-shrink-0">
                <div>
                    <h2 class="font-bold text-black text-lg">Manage Facebook Feed</h2>
                    <p class="text-xs text-gray-400 mt-0.5">First 4 visible posts will appear on homepage</p>
                </div>
                <button wire:click="closeModal" class="text-gray-400 hover:text-black transition">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="overflow-y-auto flex-1 px-6 py-4 space-y-6">

                {{-- Section: Showing --}}
                @php
                    $visible = $posts->where('is_visible', true)->values();
                    $hidden  = $posts->where('is_visible', false)->values();
                @endphp

                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-black">
                            Showing on Homepage
                        </h3>
                        <span class="text-xs font-semibold {{ $visible->count() >= 4 ? 'text-emerald-600' : 'text-gray-400' }}">
                            {{ $visible->count() }} / 4 slots filled
                        </span>
                    </div>

                    @if($visible->isEmpty())
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center text-gray-400 text-sm">
                        No posts selected — add posts from below
                    </div>
                    @else
                    <div class="space-y-2">
                        @foreach($visible as $i => $post)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 border border-gray-200 rounded-xl transition-opacity duration-200"
                             wire:loading.class="opacity-40 pointer-events-none"
                             wire:target="moveUp({{ $post->id }}),moveDown({{ $post->id }}),toggleVisible({{ $post->id }})">

                            {{-- Slot Number --}}
                            <div class="w-7 h-7 rounded-full {{ $i < 4 ? 'bg-black text-white' : 'bg-gray-200 text-gray-500' }} flex items-center justify-center text-xs font-bold flex-shrink-0">
                                {{ $i + 1 }}
                            </div>

                            {{-- Thumbnail --}}
                            <div class="w-14 h-10 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">
                                @if($post->full_picture)
                                    <img src="{{ $post->full_picture }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#3b5998"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Text --}}
                            <p class="flex-1 text-xs text-gray-700 line-clamp-1 min-w-0">
                                {{ $post->excerpt ?: 'No text content' }}
                            </p>

                            {{-- Controls --}}
                            <div class="flex items-center gap-1 flex-shrink-0">
                                <button wire:click="moveUp({{ $post->id }})"
                                        @class(['p-1.5 rounded-lg text-gray-400 hover:text-black hover:bg-white transition', 'opacity-25 pointer-events-none' => $i === 0])>
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/></svg>
                                </button>
                                <button wire:click="moveDown({{ $post->id }})"
                                        @class(['p-1.5 rounded-lg text-gray-400 hover:text-black hover:bg-white transition', 'opacity-25 pointer-events-none' => $i === $visible->count() - 1])>
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <button wire:click="toggleVisible({{ $post->id }})"
                                        title="Remove from display"
                                        class="p-1.5 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition ml-1">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    {{-- Empty slots indicator --}}
                    @if($visible->count() < 4)
                    @for($s = $visible->count(); $s < 4; $s++)
                    <div class="flex items-center gap-3 p-3 border-2 border-dashed border-gray-100 rounded-xl mt-2">
                        <div class="w-7 h-7 rounded-full bg-gray-100 text-gray-300 flex items-center justify-center text-xs font-bold flex-shrink-0">
                            {{ $s + 1 }}
                        </div>
                        <p class="text-xs text-gray-300 italic">Empty slot — add a post below</p>
                    </div>
                    @endfor
                    @endif
                </div>

                {{-- Section: Hidden --}}
                @if($hidden->isNotEmpty())
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">
                        Not Showing ({{ $hidden->count() }})
                    </h3>
                    <div class="space-y-2">
                        @foreach($hidden as $post)
                        <div class="flex items-center gap-3 p-3 border border-gray-100 rounded-xl transition-opacity duration-200"
                             wire:loading.class="opacity-40 pointer-events-none"
                             wire:target="toggleVisible({{ $post->id }})">
                            <div class="w-14 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                @if($post->full_picture)
                                    <img src="{{ $post->full_picture }}" class="w-full h-full object-cover opacity-50">
                                @else
                                    <div class="w-full h-full flex items-center justify-center opacity-40">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#3b5998"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <p class="flex-1 text-xs text-gray-400 line-clamp-1 min-w-0">
                                {{ $post->excerpt ?: 'No text content' }}
                            </p>
                            <button wire:click="toggleVisible({{ $post->id }})"
                                    title="Add to display"
                                    class="flex items-center gap-1.5 text-xs font-semibold text-black bg-gray-100 hover:bg-black hover:text-white px-3 py-1.5 rounded-lg transition flex-shrink-0">
                                <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Add
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            {{-- Footer --}}
            <div class="border-t border-gray-100 px-6 py-3 flex-shrink-0 flex justify-end">
                <button wire:click="closeModal"
                        class="text-xs font-semibold text-white bg-black px-5 py-2 rounded-xl hover:bg-gray-800 transition">
                    Done
                </button>
            </div>

        </div>
    </div>
    @endif
</div>
