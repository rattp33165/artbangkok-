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

    {{-- Ticket Price Guide --}}
    <div class="mb-12">
        <h2 class="text-sm font-bold uppercase underline underline-offset-4 text-black tracking-widest mb-6">
            Ticket Price Guide
        </h2>

        <div class="border border-gray-200 rounded-xl overflow-hidden">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        <th class="px-5 py-4 text-center font-bold uppercase tracking-wider text-black text-xs">Ticket Type</th>
                        <th class="px-5 py-4 text-center font-bold uppercase tracking-wider text-black text-xs border-l border-gray-200">Valid Date</th>
                        <th class="px-5 py-4 text-center font-bold uppercase tracking-wider text-black text-xs border-l border-gray-200">Early Bird Price</th>
                        <th class="px-5 py-4 text-center font-bold uppercase tracking-wider text-black text-xs border-l border-gray-200">Standard Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $rows = [
                        [
                            'type'       => 'VIP Ticket',
                            'date_lines' => ['Wednesday (VIP Day)', '+ Thursday – Sunday'],
                            'early'      => '780 THB',
                            'standard'   => '880 THB',
                        ],
                        [
                            'type'       => '1-Day Pass',
                            'date_lines' => ['Thursday – Sunday'],
                            'early'      => '250 THB',
                            'standard'   => '350 THB',
                        ]
                    ];
                    @endphp

                    @foreach($rows as $i => $row)
                    <tr class="{{ $i < count($rows) - 1 ? 'border-b border-gray-200' : '' }}">
                        <td class="px-5 py-4 text-center font-normal text-gray-700">
                            {{ $row['type'] }}
                        </td>
                        <td class="px-5 py-4 text-center border-l border-gray-200">
                            @foreach($row['date_lines'] as $line)
                                <span class="block font-light text-gray-600">{{ $line }}</span>
                            @endforeach
                        </td>
                        <td class="px-5 py-4 text-center font-normal text-gray-700 border-l border-gray-200">
                            {{ $row['early'] }}
                        </td>
                        <td class="px-5 py-4 text-center font-normal text-gray-700 border-l border-gray-200">
                            {{ $row['standard'] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
