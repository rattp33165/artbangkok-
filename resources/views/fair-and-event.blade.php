@extends('layouts.app')
@section('title', 'Fair & Event — Art Bangkok')
@section('content')
<div class="pt-28 pb-24 max-w-7xl mx-auto px-4 sm:px-6">

    <h1 class="text-4xl md:text-5xl font-bold text-black font-['agenda-one'] uppercase mb-4">Fair & Event</h1>
    <div class="w-full h-px bg-black mb-12"></div>

    {{-- Section 1: Hero Banner --}}
    <div class="rounded-3xl overflow-hidden relative h-[400px] md:h-[520px] mb-10">
        <img src="{{ asset('images/NEX-HALL.jpg') }}"
             alt="NEX HALL"
             class="absolute inset-0 w-full h-full object-cover"
             onerror="this.src='{{ asset('images/NEX-HALL.webp') }}'">
        <div class="absolute inset-0 bg-black/55"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
            <p class="text-white/90 text-lg md:text-2xl font-semibold tracking-wide mb-3">
                The fair launches at NEXHALL,
            </p>
            <p class="text-white text-3xl md:text-5xl font-bold font-['agenda-one'] leading-tight">
                5th floor of Siam Paragon
            </p>
        </div>
    </div>

    {{-- Section 2: Floor Plan --}}
    <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden px-6 md:px-12 py-10 mb-10">
        <p class="text-center text-base font-medium text-black tracking-wide mb-8">Floor Plan</p>
        <div class="flex justify-center">
            <img src="{{ asset('images/Floor-Plan-Nex-Hall.jpg') }}"
                 alt="Floor Plan NEX HALL"
                 class="w-full max-w-3xl h-auto object-contain">
        </div>
    </div>

    {{-- Section 3: Exhibition Zones --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        {{-- Card 1: Gallery Zone --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <p class="font-bold text-black text-lg mb-1">Gallery Zone</p>
            <p class="italic text-gray-400 text-sm font-normal mb-6">Ways of Seeing</p>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-3xl font-bold text-black mb-1">10</p>
                    <p class="text-xs text-gray-400 uppercase tracking-widest">Thai</p>
                    <p class="text-xs text-gray-400 uppercase tracking-widest">Galleries</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-black mb-1">~13</p>
                    <p class="text-xs text-gray-400 uppercase tracking-widest">Global</p>
                    <p class="text-xs text-gray-400 uppercase tracking-widest">Galleries</p>
                </div>
            </div>
        </div>

        {{-- Card 2: Past Present Future --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <p class="font-bold text-black text-lg mb-1 uppercase">Past Present Future</p>
            <p class="italic text-gray-400 text-sm font-normal">Finding Your Taste</p>
        </div>

        {{-- Card 3: Museums & Institutions --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <p class="font-bold text-black text-lg mb-1">Museums & Institutions</p>
            <p class="italic text-gray-400 text-sm font-normal">Living with Art</p>
        </div>

        {{-- Card 4: Art Care & Stewardship --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <p class="font-bold text-black text-lg mb-1">Art Care & Stewardship</p>
            <p class="italic text-gray-400 text-sm font-normal">Caring for Art</p>
        </div>

        {{-- Card 5: Art Eco System --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <p class="font-bold text-black text-lg mb-1 uppercase">Art Eco System</p>
            <p class="italic text-gray-400 text-sm font-normal">Inclusive Art Circle</p>
        </div>

        {{-- Card 6: Exclusive Lounge --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <p class="font-bold text-black text-lg mb-1">
                <span class="uppercase">Exclusive</span> Lounge
            </p>
            <p class="italic text-gray-400 text-sm font-normal">A special curated section</p>
        </div>

    </div>

</div>
@endsection
