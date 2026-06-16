@extends('layouts.app')

@section('title', ($application->gallery_name ?? 'Application') . ' — Admin')

@section('content')
<div class="min-h-screen bg-gray-50/50 pt-24 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <div class="flex items-center gap-2 text-xs text-gray-400 uppercase tracking-widest mb-6">
            <span>Admin Panel</span>
            <span>/</span>
            <a href="{{ route('admin.applications') }}" class="hover:text-black transition">Applications</a>
            <span>/</span>
            <span class="text-black font-medium">{{ $application->gallery_name ?? 'Application #'.$application->id }}</span>
        </div>

        @livewire('admin-application-review', ['applicationId' => $application->id])
    </div>
</div>
@endsection
