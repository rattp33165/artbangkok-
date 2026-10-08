@extends('layouts.app')

@section('title', 'Ticket Information — Art Bangkok')

@section('content')
<div class="pt-28 pb-24 max-w-7xl mx-auto px-4 sm:px-6">

    {{-- H1 & Subtitle --}}
    <h1 class="text-2xl md:text-3xl font-bold text-black tracking-wide uppercase font-['agenda-one'] mb-4">
        Ticket Information
    </h1>
    <p class="text-sm font-light text-gray-500 max-w-2xl leading-relaxed mb-16">
        All Tickets are available for purchase online exclusively. All prices are in Thai Baht (THB). Early Bird pricing applies based on purchase date.
    </p>

    {{-- Ticket Price Guide --}}
    <div class="mb-16">
        <img src="{{ asset('images/ticket-price.jpg') }}"
             alt="Ticket Prices & Types — VIP 780 THB (Early Bird) / 880 THB (Standard), Day Pass 250 THB (Early Bird) / 350 THB (Standard)"
             class="w-full max-w-xl h-auto mx-auto rounded-xl border border-gray-200">
    </div>

    {{-- All Ticket Access --}}
    <div class="mb-16">
        <h2 class="text-sm font-bold uppercase underline underline-offset-4 text-black tracking-widest mb-6">
            All Ticket Access
        </h2>

        @php
        $access = [
            ['label' => 'VIP Lounge', 'time' => null,          'vip' => true, 'day' => false],
            ['label' => '07 Oct',     'time' => '2PM – 9PM',   'vip' => true, 'day' => false],
            ['label' => '08 Oct',     'time' => '12PM – 7PM',  'vip' => true, 'day' => true],
            ['label' => '09 Oct',     'time' => '12PM – 7PM',  'vip' => true, 'day' => true],
            ['label' => '10 Oct',     'time' => '11AM – 9PM',  'vip' => true, 'day' => true],
            ['label' => '11 Oct',     'time' => '11AM – 6PM',  'vip' => true, 'day' => true],
        ];
        @endphp

        <div class="border border-gray-200 rounded-xl overflow-hidden">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        {{-- Split header: Ticket (columns) / Time (rows) --}}
                        <th colspan="2" class="relative w-1/2 h-16 px-5 text-xs font-bold uppercase tracking-wider text-black"
                            style="background-image: linear-gradient(to top right, transparent calc(50% - 0.5px), #e5e7eb calc(50% - 0.5px), #e5e7eb calc(50% + 0.5px), transparent calc(50% + 0.5px));">
                            <span class="absolute top-2.5 right-4">Ticket</span>
                            <span class="absolute bottom-2.5 left-4">Time</span>
                        </th>
                        <th class="w-1/4 px-5 py-4 text-center font-bold uppercase tracking-wider text-black text-xs border-l border-gray-200">VIP Ticket</th>
                        <th class="w-1/4 px-5 py-4 text-center font-bold uppercase tracking-wider text-black text-xs border-l border-gray-200">1-Day Pass</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($access as $i => $row)
                    <tr class="{{ $i < count($access) - 1 ? 'border-b border-gray-200' : '' }}">
                        @if($row['time'])
                            <td class="w-1/4 px-5 py-4 text-center font-medium text-black uppercase tracking-wider">{{ $row['label'] }}</td>
                            <td class="w-1/4 px-5 py-4 text-center font-light text-gray-600 border-l border-gray-200">{{ $row['time'] }}</td>
                        @else
                            <td colspan="2" class="px-5 py-4 text-center font-medium text-black uppercase tracking-wider">{{ $row['label'] }}</td>
                        @endif
                        @foreach(['vip', 'day'] as $col)
                        <td class="px-5 py-4 text-center border-l border-gray-200">
                            @if($row[$col])
                                <svg class="inline-block text-black" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-label="Included">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                <span class="text-gray-300" aria-label="Not included">&ndash;</span>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Privileges & Policies --}}
    <div class="flex flex-col sm:flex-row gap-0 mb-16">

        {{-- Column 1: VIP Privileges --}}
        <div class="flex-1 pr-0 sm:pr-12 pb-10 sm:pb-0">
            <h2 class="text-sm font-bold uppercase underline underline-offset-4 text-black tracking-widest mb-6">
                VIP Ticket Privileges
            </h2>
            <ul class="space-y-3">
                @foreach([
                    'Any drink menu — 1 serving (complimentary)',
                    'Complimentary snack — 1 serving.',
                    'Priority VIP entry on Thursday.',
                    'Exclusive benefits valid throughout the entire exhibition period.'
                ] as $item)
                <li class="flex items-start gap-3 text-sm font-light text-gray-500 leading-relaxed">
                    <span class="mt-1.5 w-1 h-1 rounded-full bg-gray-400 flex-shrink-0"></span>
                    {{ $item }}
                </li>
                @endforeach
            </ul>
        </div>

        {{-- Divider --}}
        <div class="hidden sm:block w-px bg-gray-200 flex-shrink-0"></div>
        <div class="block sm:hidden h-px bg-gray-200 mb-10"></div>

        {{-- Column 2: Ticketing Policies --}}
        <div class="flex-1 pl-0 sm:pl-12">
            <h2 class="text-sm font-bold uppercase underline underline-offset-4 text-black tracking-widest mb-6">
                Ticketing Policies
            </h2>
            <ul class="space-y-3">
                @foreach([
                    'Early Bird pricing is applied based on the date of purchase.',
                    'Re-entry requires presentation of your ticket or QR code.',
                    'All transactions are processed in Thai Baht (THB).',
                ] as $item)
                <li class="flex items-start gap-3 text-sm font-light text-gray-500 leading-relaxed">
                    <span class="mt-1.5 w-1 h-1 rounded-full bg-gray-400 flex-shrink-0"></span>
                    {{ $item }}
                </li>
                @endforeach
            </ul>
        </div>

    </div>

    {{-- CTA Button (disabled — not in use yet)
    <div class="flex justify-center">
        <a href="#"
           class="inline-block bg-black text-white text-sm font-medium tracking-widest uppercase px-16 py-4 text-center hover:bg-gray-800 transition">
            Get Your Ticket
        </a>
    </div>
    --}}

</div>
@endsection
