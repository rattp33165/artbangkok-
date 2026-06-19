@extends('layouts.app')
@section('title', 'Page Not Found — Art Bangkok')
@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 pt-20">
    <div class="text-center max-w-md">
        <p class="text-8xl font-bold text-black mb-4">404</p>
        <h1 class="text-xl font-semibold text-black mb-2">Page Not Found</h1>
        <p class="text-sm text-gray-400 mb-8">The page you're looking for doesn't exist or has been moved.</p>
        <a href="{{ route('home') }}"
           class="inline-block bg-black text-white text-sm px-6 py-3 rounded-xl hover:bg-gray-800 transition">
            Back to Home
        </a>
    </div>
</div>
@endsection
