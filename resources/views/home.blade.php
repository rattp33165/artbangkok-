@extends('layouts.app')

@section('title', 'Art Bangkok')

@section('content')
<div class="pt-20">

    {{-- Hero Section --}}
    <section class="min-h-screen bg-white flex items-center justify-center relative overflow-hidden">
        <div class="text-center text-black z-10 px-6">
            <p class="text-gray-400 tracking-[0.3em] uppercase text-sm mb-6 font-['agenda-one']">
                Bangkok · Thailand · 2026
            </p>
            <h1 class="text-6xl md:text-8xl font-bold mb-6 font-['agenda-one'] leading-tight text-black">
                Art Bangkok<br>2026
            </h1>
            <p class="text-gray-500 text-lg md:text-xl max-w-xl mx-auto mb-10">
                Thailand's Premier International Art Fair
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register"
                   class="bg-black text-white px-8 py-3 rounded-full text-sm font-semibold hover:bg-gray-800 transition tracking-wide">
                    Gallery Application
                </a>
                <a href="#"
                   class="border border-black text-black px-8 py-3 rounded-full text-sm hover:bg-black hover:text-white transition tracking-wide">
                    Learn More
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
