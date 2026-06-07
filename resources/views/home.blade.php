@extends('layouts.app')

@section('title', 'Art Bangkok')

@section('content')
<div class="pt-20">

    {{-- 1. Hero Carousel --}}
    <livewire:hero-carousel />

    {{-- 2. Features Grid --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 mt-12 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-0">

            {{-- Left: Why text --}}
            <div class="lg:col-span-2 lg:pr-12">
                <h2 class="text-2xl md:text-3xl font-bold text-black font-['agenda-one'] leading-snug mb-6">
                    Why The First Chapter?
                </h2>
                <p class="text-sm leading-relaxed">
                    <span class="block font-bold text-black lowercase mt-6 mb-3">
                        first steps into the world of collecting.
                    </span>
                    <span class="font-light text-gray-500">
                        not just as a starting point for beginners, but also as the Origin of Meaning.
                    </span>
                    <span class="block font-bold text-black mt-3 mb-3">
                        It is a return to the origin the moment art begins to matter personally to an individual.
                    </span>
                    <span class="font-light text-gray-500">
                        We reject the standard art market ranking. Instead, we focus on the raw curiosity and the first spark that ignites a collector's journey.
                    </span>
                </p>
            </div>

            {{-- Right: 3 Feature Columns --}}
            <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-3">

                {{-- Feature 1: No Ranking --}}
                <div class="lg:border-l border-gray-200 lg:pl-10 pb-8 sm:pb-0">
                    <div class="w-11 h-11 bg-gray-100 rounded-full flex items-center justify-center mb-5">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-black text-base mb-3 font-['agenda-one']">No Ranking</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        We do not rank art. We value discovery over hierarchy.
                    </p>
                </div>

                {{-- Feature 2: Inclusive Art Circle --}}
                <div class="lg:border-l border-gray-200 lg:pl-10 border-t sm:border-t-0 pt-8 sm:pt-0 pb-8 sm:pb-0">
                    <div class="w-11 h-11 bg-gray-100 rounded-full flex items-center justify-center mb-5">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-black text-base mb-3 font-['agenda-one']">Inclusive Art Circle</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Open to all collectors, artists, and art lovers. A space to connect and grow together.
                    </p>
                </div>

                {{-- Feature 3: Art Literacy --}}
                <div class="lg:border-l border-gray-200 lg:pl-10 border-t sm:border-t-0 pt-8 sm:pt-0">
                    <div class="w-11 h-11 bg-gray-100 rounded-full flex items-center justify-center mb-5">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-black text-base mb-3 font-['agenda-one']">Art Literacy</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        We believe in learning through experience and conversation.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- Facebook Feed --}}
    <livewire:facebook-feed :limit="4" />

</div>
@endsection
