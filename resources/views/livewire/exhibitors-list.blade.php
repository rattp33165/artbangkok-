<div>
    {{-- Search --}}
    <form wire:submit.prevent="$refresh" class="max-w-md mb-12">
        <div class="relative flex gap-2">
            <div class="relative flex-1">
                <input wire:model="search"
                       type="text"
                       placeholder="Search by gallery name..."
                       class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-black transition bg-white">
                <svg class="absolute left-3 top-3.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <button type="submit"
                    class="bg-black text-white text-xs font-semibold tracking-widest uppercase px-6 py-3 rounded-xl hover:bg-gray-800 transition">
                Search
            </button>
        </div>
    </form>

    {{-- Alphabetical directory --}}
    @forelse($grouped as $letter => $items)
        <div class="mb-12">
            <h2 class="text-xl font-bold text-black mb-6">{{ $letter }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-8 gap-y-8">
                @foreach($items as $item)
                    <div>
                        <p class="text-sm font-semibold text-black uppercase tracking-wide">{{ $item->gallery_name }}</p>
                        @if($item->office_city)
                            <p class="text-sm text-gray-400 mt-1">{{ $item->office_city }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @if(!$loop->last)
            <div class="w-full h-px bg-gray-200 mb-12"></div>
        @endif
    @empty
        <p class="text-sm font-light text-gray-400">No exhibitors found.</p>
    @endforelse
</div>
