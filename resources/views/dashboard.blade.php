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
                <div class="mb-6 p-4 bg-gray-50 rounded-xl"
                     x-data="{ percent: {{ $percent }} }"
                     x-on:progress-updated.window="percent = $event.detail.percent">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Application</span>
                        <span class="text-xs font-bold text-black" x-text="percent + '%'"></span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div class="bg-black h-1.5 rounded-full transition-all duration-500" :style="'width: ' + percent + '%'"></div>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">
                        <span x-text="percent < 100 ? 'In progress' : 'Complete'"></span>
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
                $currentStatus = $app?->status ?? 'draft';
            @endphp

            {{-- Application Status Tracker --}}
            @php
            $editRequested = (bool)($app?->edit_requested ?? false);

            // Step index: 0=draft, 1=submitted, 2=under_review, 3=approved/rejected
            $stepOrder   = ['draft' => 0, 'submitted' => 1, 'under_review' => 2, 'approved' => 3, 'rejected' => 3];
            $currentStep = $stepOrder[$currentStatus] ?? 0;

            $statusBadge = match($currentStatus) {
                'submitted'    => 'bg-blue-50 text-blue-700',
                'under_review' => 'bg-yellow-50 text-yellow-700',
                'approved'     => 'bg-green-50 text-green-700',
                'rejected'     => 'bg-red-50 text-red-700',
                default        => 'bg-gray-100 text-gray-500',
            };
            $statusLabel = match($currentStatus) {
                'submitted'    => 'Submitted',
                'under_review' => 'Under Review',
                'approved'     => 'Approved',
                'rejected'     => 'Not Approved',
                default        => 'Draft',
            };

            $statusInfo = match($currentStatus) {
                'submitted'    => [
                    'icon'  => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                    'color' => 'blue',
                    'title' => 'Application Submitted',
                    'body'  => 'Your application has been received and is awaiting review. Our team will process it shortly. You will be notified once the status changes.',
                ],
                'under_review' => [
                    'icon'  => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                    'color' => 'yellow',
                    'title' => 'Under Review',
                    'body'  => 'Our team is currently reviewing your application. This may take a few business days. We will contact you once a decision has been made.',
                ],
                'approved'     => [
                    'icon'  => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'color' => 'green',
                    'title' => 'Application Approved',
                    'body'  => 'Congratulations! Your gallery application has been approved. Our team will be in touch with you regarding next steps for ART BANGKOK 2026.',
                ],
                'rejected'     => [
                    'icon'  => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'color' => 'red',
                    'title' => 'Not Approved',
                    'body'  => 'Your application was not approved at this time. You may revise your information and resubmit. Please contact us if you have any questions.',
                ],
                default        => [
                    'icon'  => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                    'color' => 'gray',
                    'title' => 'Application in Draft',
                    'body'  => 'Complete all sections of your gallery application. Use the form below to fill in your information. You can save each section individually and come back anytime.',
                ],
            };

            $colorMap = [
                'blue'   => ['dot' => 'bg-blue-500',   'bg' => 'bg-blue-50',   'border' => 'border-blue-200',   'icon' => 'text-blue-500'],
                'yellow' => ['dot' => 'bg-yellow-400',  'bg' => 'bg-yellow-50', 'border' => 'border-yellow-200', 'icon' => 'text-yellow-500'],
                'green'  => ['dot' => 'bg-green-500',   'bg' => 'bg-green-50',  'border' => 'border-green-200',  'icon' => 'text-green-500'],
                'red'    => ['dot' => 'bg-red-400',     'bg' => 'bg-red-50',    'border' => 'border-red-200',    'icon' => 'text-red-400'],
                'gray'   => ['dot' => 'bg-gray-400',    'bg' => 'bg-gray-50',   'border' => 'border-gray-200',   'icon' => 'text-gray-400'],
            ];
            $c = $colorMap[$statusInfo['color']];
            @endphp

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-8 overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5 flex items-center justify-between border-b border-gray-50">
                    <div>
                        <h2 class="font-semibold text-black">Application Status</h2>
                        <p class="text-xs text-gray-400 mt-0.5">ART BANGKOK 2026</p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusBadge }}">
                        {{ $statusLabel }}
                    </span>
                </div>

                {{-- Step Tracker --}}
                <div class="px-6 py-6">
                    @php
                    $steps = [
                        ['label' => 'Draft',        'sub' => 'Fill in form'],
                        ['label' => 'Submitted',     'sub' => 'Awaiting review'],
                        ['label' => 'Under Review',  'sub' => 'Being reviewed'],
                        ['label' => 'Decision',      'sub' => 'Final outcome'],
                    ];
                    @endphp
                    <div class="relative flex items-start justify-between">
                        {{-- connector line --}}
                        <div class="absolute top-3.5 left-3.5 right-3.5 h-px bg-gray-100 z-0"></div>
                        @foreach($steps as $i => $step)
                        @php
                            if ($i < $currentStep) {
                                $dotClass = 'bg-black border-black';
                                $innerEl  = '<svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>';
                                $labelCls = 'text-black font-semibold';
                                $subCls   = 'text-gray-400';
                            } elseif ($i === $currentStep) {
                                $dotClass = $c['dot'] . ' border-transparent ring-2 ring-offset-2 ring-' . $statusInfo['color'] . '-300';
                                $innerEl  = '';
                                $labelCls = 'text-black font-semibold';
                                $subCls   = $c['icon'];
                            } else {
                                $dotClass = 'bg-white border-gray-200';
                                $innerEl  = '';
                                $labelCls = 'text-gray-400';
                                $subCls   = 'text-gray-300';
                            }
                        @endphp
                        <div class="relative flex flex-col items-center gap-2 flex-1 first:items-start last:items-end">
                            <div class="w-7 h-7 rounded-full border-2 {{ $dotClass }} flex items-center justify-center z-10 transition-all">
                                {!! $innerEl !!}
                            </div>
                            <div class="{{ $i === 0 ? 'text-left' : ($i === count($steps)-1 ? 'text-right' : 'text-center') }}">
                                <p class="text-xs {{ $labelCls }} leading-tight">{{ $step['label'] }}</p>
                                <p class="text-xs {{ $subCls }} leading-tight mt-0.5">{{ $step['sub'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Status Description --}}
                <div class="px-6 pb-6">
                    <div class="rounded-xl border p-4 {{ $c['bg'] }} {{ $c['border'] }}">
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 {{ $c['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $statusInfo['icon'] }}"/>
                            </svg>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-black">{{ $statusInfo['title'] }}</p>
                                <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">{{ $statusInfo['body'] }}</p>
                                @if($app?->reviewed_at && in_array($currentStatus, ['approved', 'rejected', 'under_review']))
                                <p class="text-xs text-gray-400 mt-1.5">{{ $app->reviewed_at->format('d M Y, H:i') }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- Edit request notice (approved + edit_requested) --}}
                        @if($currentStatus === 'approved' && $editRequested)
                        <div class="mt-3 pt-3 border-t border-yellow-200 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-yellow-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-xs text-yellow-700 font-medium">Edit request pending — awaiting admin approval</p>
                        </div>
                        @endif
                    </div>

                    {{-- Form completion bar (draft only) --}}
                    @if($currentStatus === 'draft')
                    <div class="mt-4 pt-4 border-t border-gray-50">
                        <div class="flex justify-between items-center mb-1.5">
                            <span class="text-xs text-gray-400">Form completion</span>
                            <span class="text-xs font-semibold text-black">{{ $percent }}%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                            <div class="bg-black h-1.5 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                    @endif
                </div>

            </div>

            {{-- Application Form --}}
            <livewire:application-form />

        </main>
    </div>
</div>
@endsection
