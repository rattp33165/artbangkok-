@extends('layouts.app')

@section('title', 'About — Art Bangkok')

@section('content')
<div class="pt-28 max-w-7xl mx-auto px-4 sm:px-6">

    {{-- Header --}}
    <div class="mb-8 flex items-end gap-6">
        <h1 class="text-4xl md:text-6xl font-light text-black font-['agenda-one'] leading-tight">
            About
        </h1>
        <img src="{{ asset('images/Logo-art_bangkok-b.png') }}"
             alt="Art Bangkok"
             class="h-8 md:h-12 w-auto pb-2">
    </div>

    {{-- Horizontal Divider --}}
    <div class="w-full h-px bg-black mb-12"></div>

    {{-- 2-Column Layout --}}
    <div class="flex flex-col lg:flex-row gap-0">

        {{-- Left: Image --}}
        <div class="w-full lg:w-1/2 flex-shrink-0">
            <div class="w-full bg-gray-100 overflow-hidden">
                <img src="{{ asset('images/about2.jpg') }}"
                     alt="About Art Bangkok"
                     class="w-full h-full object-cover">
            </div>
        </div>

        {{-- Right: Text --}}
        <div class="w-full lg:w-1/2 lg:pl-16 pt-10 lg:pt-0 flex flex-col">
            <p class="text-2xl md:text-3xl font-bold text-black leading-snug mb-3">
                This is…
            </p>
            <p class="text-4xl md:text-6xl font-bold text-black font-['agenda-one'] leading-tight mb-8">
                The First Chapter
            </p>

            <p class="text-sm font-light text-gray-600 leading-loose lowercase mb-1">
                first steps into the world of collecting.
            </p>
            <p class="text-sm text-gray-600 leading-loose lowercase">
                not just as a starting point for beginners, but also as the Origin of Meaning.
                <span class="font-medium text-black"> It is a return to the origin the moment art begins to matter personally to an individual.</span>
                <span class="font-light"> We reject the standard art market ranking. Instead, we focus on the raw curiosity and the first spark that ignites a collector's journey.</span>
            </p>

            <p class="text-lg md:text-xl font-bold text-black lowercase tracking-wide mt-8 mb-3">
                the essence of beginning
            </p>
            <p class="text-sm font-light text-gray-600 leading-loose lowercase">
                an art collection lies in letting your emotions guide you appreciating the intrinsic value of a piece from the heart, free from the confines of monetary valuation. This is 'The First Chapter,' the ideal origin of collecting that we aspire to cultivate within the Thai art community.
            </p>
        </div>
    </div>

</div>

{{-- Hub Section --}}
<section class="mt-16 py-16 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">

        {{-- Desktop: Circular Layout --}}
        <div class="relative hidden lg:flex items-center justify-center" style="height: 640px;">

            {{-- Center text --}}
            <div class="relative z-10 text-center" style="max-width: 280px;">
                <p class="text-xl text-black flex items-end justify-center gap-3 mb-3">
                    <img src="{{ asset('images/Logo-art_bangkok-b.png') }}"
                         alt="Art Bangkok"
                         class="h-8 w-auto mb-0.5">
                    serves as a
                </p>
                <p class="text-xl text-black mb-3">
                    <span class="font-bold italic">Centralized Hub</span> connecting…
                </p>
                <p class="text-sm font-light italic text-gray-500 leading-relaxed">
                    …Through a world-class international art fair designed for the future of the Asian art market
                </p>
            </div>

            {{-- Orbiting Circles --}}
            {{-- Positions based on clock: 9=(-240,0), 11=(-120,-208), 1=(120,-208), 3=(240,0), 5=(120,208), 6=(0,240), 7=(-120,208) --}}
            @php
            $orbs = [
                ['label' => 'Galleries',             'x' => -240, 'y' =>    0],
                ['label' => 'Collectors',            'x' => -120, 'y' => -208],
                ['label' => 'Creative Economy',      'x' =>  120, 'y' => -208],
                ['label' => 'Real Estate',           'x' =>  240, 'y' =>    0],
                ['label' => 'Luxury Brands',         'x' =>  170, 'y' =>  170],
                ['label' => 'Tourism',               'x' =>    0, 'y' =>  240],
                ['label' => 'Museum & Institutions', 'x' => -170, 'y' =>  170],
            ];
            @endphp

            @foreach($orbs as $orb)
            <div class="absolute rounded-full border-2 border-dashed border-black bg-white flex items-center justify-center overflow-hidden"
                 style="width:112px; height:112px; left:50%; top:50%; transform: translate(calc(-50% + {{ $orb['x'] }}px), calc(-50% + {{ $orb['y'] }}px));">
                <span class="text-xs font-light text-black text-center leading-tight" style="max-width:90px;">{{ $orb['label'] }}</span>
            </div>
            @endforeach

        </div>

        {{-- Mobile: Center text + pill grid --}}
        <div class="lg:hidden flex flex-col items-center text-center">
            <p class="text-xl text-black flex items-end justify-center gap-3 mb-3">
                <img src="{{ asset('images/Logo-art_bangkok-b.png') }}"
                     alt="Art Bangkok"
                     class="h-8 w-auto mb-0.5">
                serves as a
            </p>
            <p class="text-xl text-black mb-3">
                <span class="font-bold italic">Centralized Hub</span> connecting…
            </p>
            <p class="text-sm font-light italic text-gray-500 leading-relaxed max-w-sm mb-8">
                …Through a world-class international art fair designed for the future of the Asian art market
            </p>
            <div class="flex flex-wrap justify-center gap-3">
                @foreach(['Galleries', 'Collectors', 'Creative Economy', 'Real Estate', 'Luxury Brands', 'Tourism', 'Museum & Institutions'] as $item)
                <div class="border-2 border-dashed border-black bg-white rounded-full px-5 py-3 text-xs font-semibold text-black">
                    {{ $item }}
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
@endsection
