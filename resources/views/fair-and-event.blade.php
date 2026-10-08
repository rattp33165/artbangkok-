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

    {{-- Section 2: Areas --}}
    <h2 class="text-xl md:text-2xl font-bold text-black font-['agenda-one'] uppercase mb-6 text-center">3 Areas &mdash; 6 Elements</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Area 1: NEX Hall --}}
        <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden flex flex-col">
            <div class="relative aspect-[4/3]">
                <img src="{{ asset('images/Galeri-Sasha.png') }}"
                     alt="NEX Hall"
                     class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-linear-to-t from-black/75 via-black/20 to-transparent"></div>
                <div class="absolute inset-x-0 bottom-0 p-6 md:p-8 flex items-end justify-between gap-4">
                    <h3 class="text-white text-3xl md:text-4xl font-bold font-['agenda-one'] leading-none drop-shadow">
                        NEX Hall
                    </h3>
                    <ul class="text-white text-xs md:text-sm tracking-wide space-y-1 drop-shadow">
                        @foreach(['Gallery Zone', 'Art Care & Stewardship', 'VIP Lounge'] as $item)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-white shrink-0"></span>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="p-6 md:p-8 space-y-4 text-sm text-gray-600 leading-relaxed">
                <p>
                    Through <span class="font-semibold text-black">Gallery Zone</span>, we offer an expansion of vision through curation by Thai and international galleries. Focused on thematic planning rather than simple inventory display.
                </p>
                <p>
                    Encounter ART BANGKOK's Unique Differentiator at <span class="font-semibold text-black">Art Care &amp; Stewardship</span>: A zone dedicated to everything about art management: Restoration, Framing, Logistics, Insurance, and Storage presented by Helutrans.
                </p>
                <p>
                    Fulfilled with the richness of arts and purposeful storytelling, have a relaxing time at <span class="font-semibold text-black">VIP Lounge</span>: A special curated section exclusively for VIP guests powered by Thai Art Collector Association.
                </p>
            </div>
        </div>

        {{-- Area 2: ART Jewel --}}
        <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden flex flex-col">
            <div class="relative aspect-[4/3]">
                <img src="{{ asset('images/art-jewel.jpg') }}"
                     alt="ART Jewel"
                     class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-linear-to-t from-black/75 via-black/20 to-transparent"></div>
                <div class="absolute inset-x-0 bottom-0 p-6 md:p-8 flex items-end justify-between gap-4">
                    <h3 class="text-white text-3xl md:text-4xl font-bold font-['agenda-one'] leading-none drop-shadow">
                        ART Jewel
                    </h3>
                    <ul class="text-white text-xs md:text-sm tracking-wide space-y-1 drop-shadow">
                        @foreach(['PAST PRESENT FUTURE', 'Art Eco System'] as $item)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-white shrink-0"></span>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="p-6 md:p-8 space-y-4 text-sm text-gray-600 leading-relaxed">
                <p>
                    A collaborative exhibition by Bangkok Art Auction and Dorothy Circus Gallery; <span class="font-semibold text-black">&ldquo;PAST PRESENT FUTURE&rdquo;</span> curated by the fair team in partnership with Thai and international galleries, museums, foundations, art organizations, private collections and art prizes is held at ART Jewel area. Responding to the theme of our inaugural edition, "The First Chapter," this exhibition explores how artistic legacy continues to evolve across generations&mdash;from master artists and established contemporary voices to emerging talents shaping the future of art.
                </p>
                <p>
                    Come upon inclusive art circle where Association &amp; Foundation, Press &amp; Media, Art Prize announcement from UOB: Painting of the year program and Collectors community gather around the Main Stage at <span class="font-semibold text-black">Art Eco System</span>.
                </p>
            </div>
        </div>

        {{-- Area 3: Jewel Dome --}}
        <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden flex flex-col">
            <div class="relative aspect-[4/3]">
                <img src="{{ asset('images/jewel-dome.png') }}"
                     alt="Jewel Dome"
                     class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-linear-to-t from-black/75 via-black/20 to-transparent"></div>
                <div class="absolute inset-x-0 bottom-0 p-6 md:p-8 flex items-end justify-between gap-4">
                    <h3 class="text-white text-3xl md:text-4xl font-bold font-['agenda-one'] leading-none drop-shadow">
                        Jewel Dome
                    </h3>
                    <ul class="text-white text-xs md:text-sm tracking-wide space-y-1 drop-shadow">
                        @foreach(['Museums & Institutions'] as $item)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-white shrink-0"></span>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="p-6 md:p-8 space-y-4 text-sm text-gray-600 leading-relaxed">
                <p>
                    Partnered with MoNWIC Art Museum and Office of Contemporary Art and Culture (OCAC), You can explore "How to live with art" through <span class="font-semibold text-black">Special Exhibitions</span> from museums and private distinguished public and private collections. Lifestyle-oriented displays showing art in context.
                </p>
            </div>
        </div>

    </div>

</div>
@endsection
