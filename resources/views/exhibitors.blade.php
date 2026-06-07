@extends('layouts.app')
@section('title', 'List of Exhibitors — Art Bangkok')
@section('content')
<div class="pt-28 pb-24 max-w-7xl mx-auto px-4 sm:px-6">

    {{-- Mobile: button on top centered, heading below --}}
    {{-- Desktop: heading left, button right --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-6 sm:gap-4 mb-4">
        <a href="{{ auth()->check() ? route('dashboard') : route('sign-in') }}"
           class="sm:hidden flex items-center justify-center gap-2 w-full bg-black text-white text-xs font-semibold tracking-widest uppercase px-5 py-3 rounded-xl hover:bg-gray-800 transition">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Gallery Application
        </a>
        <h1 class="text-4xl md:text-5xl font-bold text-black font-['agenda-one'] uppercase">List of Exhibitors</h1>
        <a href="{{ auth()->check() ? route('dashboard') : route('sign-in') }}"
           class="hidden sm:inline-flex flex-shrink-0 items-center gap-2 bg-black text-white text-xs font-semibold tracking-widest uppercase px-5 py-3 rounded-xl hover:bg-gray-800 transition">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Gallery Application
        </a>
    </div>

    <div class="w-full h-px bg-black mb-12"></div>
    <p class="text-sm font-light text-gray-400">Content coming soon.</p>
</div>
@endsection
