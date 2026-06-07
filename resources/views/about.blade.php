@extends('layouts.app')

@section('title', 'About — Art Bangkok')

@section('content')
<div class="pt-28 pb-24 max-w-7xl mx-auto px-4 sm:px-6">

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
                <img src="{{ asset('images/about.jpg') }}"
                     alt="About Art Bangkok"
                     class="w-full h-full object-cover">
            </div>
        </div>

        {{-- Right: Text --}}
        <div class="w-full lg:w-1/2 lg:pl-16 pt-10 lg:pt-0 flex flex-col">

            {{-- Subheading 1 --}}
            <p class="text-base font-bold text-black lowercase tracking-wide mb-4">
                the essence of beginning
            </p>

            {{-- Paragraph 1 --}}
            <p class="text-sm font-light text-gray-600 leading-loose lowercase mb-10">
                an art collection lies in letting your emotions guide you appreciating the intrinsic value of a piece from the heart, free from the confines of monetary valuation. This is 'The First Chapter,' the ideal origin of collecting that we aspire to cultivate within the Thai art community.
            </p>

            {{-- Subheading 2 --}}
            <p class="text-xl md:text-2xl font-bold text-black leading-snug mb-6">
                Poised to become the leading art fair in Southeast Asia,
            </p>

            {{-- Bulleted List --}}
            <ul class="space-y-3">
                @foreach([
                    'Significant international and regional gallery presentations.',
                    'Special curated exhibitions.',
                    'VIP & Docent Programmes.',
                    'Thought-provoking talks and panel discussions.',
                    'Live performances.',
                ] as $item)
                <li class="flex items-start gap-3 text-sm font-light text-gray-600 leading-relaxed">
                    <span class="mt-2 w-1.5 h-1.5 rounded-full bg-black flex-shrink-0"></span>
                    {{ $item }}
                </li>
                @endforeach
            </ul>

        </div>
    </div>

</div>
@endsection
