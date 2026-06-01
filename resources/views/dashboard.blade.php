@extends('layouts.app')
@section('title', 'Dashboard — Art Bangkok')
@section('content')
<div class="min-h-screen bg-gray-50 pt-20">
    <div class="max-w-7xl mx-auto px-4 py-8 flex flex-col lg:flex-row gap-6">

        {{-- Sidebar --}}
        <aside class="w-full lg:w-64 flex-shrink-0">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:sticky lg:top-24">

                {{-- Profile Photo --}}
                <div class="text-center mb-6">
                    <div class="w-20 h-20 rounded-full bg-gray-100 mx-auto mb-3 overflow-hidden">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ Auth::user()->profile_photo }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-2xl font-bold text-gray-400">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <p class="font-semibold text-sm text-black">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">
                        {{ Auth::user()->gallery_type === 'international' ? 'International Gallery' : (Auth::user()->gallery_type === 'thai' ? 'Thai Gallery' : 'Gallery') }}
                    </p>
                </div>

                {{-- Progress --}}
                @php $app = Auth::user()->application; $percent = $app?->completion_percent ?? 0; @endphp
                <div class="mb-6 p-4 bg-gray-50 rounded-xl">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Application</span>
                        <span class="text-xs font-bold text-black">{{ $percent }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div class="bg-black h-1.5 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">
                        @if($percent < 100) In progress @else Complete @endif
                    </p>
                </div>

                {{-- Menu --}}
                <nav class="space-y-1">
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm bg-gray-100 font-semibold text-black transition">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Gallery Application
                    </a>
                    <a href="{{ route('profile') }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-gray-50 hover:text-black transition">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Profile Settings
                    </a>

                    <div class="pt-3">
                        <form method="POST" action="{{ route('sign-out') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-red-500 hover:bg-red-50 transition w-full text-left">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </nav>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 min-w-0">

            {{-- Header --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-black">Gallery Application</h1>
                <p class="text-gray-400 text-sm mt-1">ART BANGKOK 2026 — Complete all sections below</p>
            </div>

            {{-- Status Cards --}}
            @php
                $app = Auth::user()->application;
                $galleryComplete = $app?->gallery_type && $app?->gallery_name && $app?->year_founded &&
                                   $app?->description && $app?->website_url && $app?->gallery_email &&
                                   $app?->phone && $app?->instagram && $app?->facebook;
            @endphp
            <div class="grid grid-cols-3 gap-4 mb-8">
                <div class="bg-white rounded-xl border border-gray-100 p-4">
                    <p class="text-xs text-gray-400 mb-1">Gallery Info</p>
                    <p class="text-sm font-semibold {{ $galleryComplete ? 'text-green-600' : 'text-gray-400' }}">
                        {{ $galleryComplete ? '✓ Completed' : '○ Pending' }}
                    </p>
                </div>
                <div class="bg-white rounded-xl border border-gray-100 p-4">
                    <p class="text-xs text-gray-400 mb-1">Booth Selection</p>
                    <p class="text-sm font-semibold {{ $app?->booth_section ? 'text-yellow-600' : 'text-gray-400' }}">
                        {{ $app?->booth_section ? '⏳ Waiting Confirm' : '○ Pending' }}
                    </p>
                </div>
                <div class="bg-white rounded-xl border border-gray-100 p-4">
                    <p class="text-xs text-gray-400 mb-1">Status</p>
                    <p class="text-sm font-semibold text-gray-600">
                        {{ ucfirst($app?->status ?? 'draft') }}
                    </p>
                </div>
            </div>

            {{-- Application Form --}}
            <livewire:application-form />

        </main>
    </div>
</div>
@endsection
