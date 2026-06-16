@extends('layouts.app')

@section('title', 'Applications — Admin')

@section('content')
<div class="min-h-screen bg-gray-50/50 pt-24 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <div class="flex items-center gap-2 text-xs text-gray-400 uppercase tracking-widest mb-6">
            <span>Admin Panel</span>
            <span>/</span>
            <span class="text-black font-medium">Applications</span>
        </div>

        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-black">Applications</h1>
            <p class="text-sm text-gray-500 mt-1">Review and manage gallery applications.</p>
        </div>

        @livewire('admin-application-list')
    </div>
</div>
@endsection
