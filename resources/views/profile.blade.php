@extends('layouts.app')
@section('title', 'Profile Settings — Art Bangkok')
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
                    <p class="text-xs text-gray-400 mt-0.5 truncate">{{ Auth::user()->email }}</p>
                </div>

                {{-- Menu --}}
                <nav class="space-y-1">
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-gray-50 hover:text-black transition">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Gallery Application
                    </a>
                    <a href="{{ route('profile') }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm bg-gray-100 font-semibold text-black transition">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Profile Settings
                    </a>

                </nav>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 min-w-0">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-black">Profile Settings</h1>
                <p class="text-gray-400 text-sm mt-1">Manage your account information</p>
            </div>

            <livewire:user-profile />
        </main>
    </div>
</div>
@endsection
