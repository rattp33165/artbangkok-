@extends('layouts.app')
@section('title', 'Zone & Activity — Art Bangkok')
@section('content')
<div class="pt-28 pb-24 max-w-7xl mx-auto px-4 sm:px-6">

    <h1 class="text-2xl md:text-3xl font-bold text-black font-['agenda-one'] uppercase mb-4">Zone & Activity</h1>
    <div class="w-full h-px bg-black mb-12"></div>

    {{-- Section 1: Hero Banner --}}
    <div class="rounded-3xl overflow-hidden relative h-[400px] md:h-[520px] mb-10"
         style="background-image: url('{{ asset('images/zone_activity.jpg') }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-black/55"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
            <p class="text-white/90 text-lg md:text-2xl font-semibold tracking-wide mb-3">
                The fair launches at
            </p>
            <p class="text-white text-3xl md:text-5xl font-bold font-['agenda-one'] leading-tight">
                Siam Paragon 5th floor (NEX HALL &amp; JEWEL ZONE)
            </p>
        </div>
    </div>

    {{-- Section 3: Exhibition Zones --}}
    <h2 class="text-xl md:text-2xl font-bold text-black font-['agenda-one'] uppercase mb-6 text-center">Present in 6 Zone 6 Chapter</h2>
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
            <p class="italic text-gray-400 text-sm font-normal">Featured Art in the Thai Ecosystem is a dynamic, globally open platform rooted in the Thai art scene. It brings together emerging and established artists to showcase diverse, experimental, and constantly evolving contemporary art practices.</p>
        </div>

        {{-- Card 3: Museums & Institutions --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <p class="font-bold text-black text-lg mb-1">Museums & Institutions</p>
            <p class="italic text-gray-400 text-sm font-normal">Learning "how to live with art" through special exhibitions from museums and private collections. Lifestyle-oriented displays showing art in context.</p>
        </div>

        {{-- Card 4: Art Care & Stewardship --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <p class="font-bold text-black text-lg mb-1">Art Care & Stewardship</p>
            <p class="italic text-gray-400 text-sm font-normal">ART BANGKOK's Unique Differentiator. A zone dedicated to everything about art management: Restoration, Framing, Logistics, Insurance, and Storage.</p>
        </div>

        {{-- Card 5: Art Eco System --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <p class="font-bold text-black text-lg mb-1 uppercase">Art Eco System</p>
            <div class="space-y-0.5">
                @foreach(['Association & Foundation', 'Press & Media', 'Art Prize', 'Collectors Community'] as $item)
                <p class="italic text-gray-400 text-sm font-normal">{{ $item }}</p>
                @endforeach
            </div>
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
