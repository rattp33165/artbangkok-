@extends('layouts.app')
@section('title', 'Server Error — Art Bangkok')
@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 pt-20">
    <div class="text-center max-w-md">
        <p class="text-8xl font-bold text-black mb-4">500</p>
        <h1 class="text-xl font-semibold text-black mb-2">Server Error</h1>
        <p class="text-sm text-gray-400 mb-8">Something went wrong on our end. Please try again later.</p>
        <a href="{{ route('home') }}"
           class="inline-block bg-black text-white text-sm px-6 py-3 rounded-xl hover:bg-gray-800 transition">
            Back to Home
        </a>
    </div>
</div>
@endsection
