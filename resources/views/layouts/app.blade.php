<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Art Bangkok 2026')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/Logo-art_bangkok-b.png') }}">
    <link rel="stylesheet" href="https://use.typekit.net/hjg1ity.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-white font-['agenda-one']">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    @livewireScripts

    {{-- Facebook SDK --}}
    @if(config('services.facebook.app_id'))
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v19.0&appId={{ config('services.facebook.app_id') }}">
    </script>
    @endif

    {{-- Page Loading Bar --}}
    <div wire:loading.delay="300"
         x-data
         x-show="true"
         x-transition:enter="transition-opacity duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity duration-500"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed top-0 left-0 right-0 z-[60] pointer-events-none">
        <div class="h-[2px] bg-black origin-left animate-[progress_1.5s_ease-in-out_infinite]"
             style="animation: progress 1.5s ease-in-out infinite;"></div>
    </div>
    <style>
        @keyframes progress {
            0%   { transform: scaleX(0); transform-origin: left; }
            50%  { transform: scaleX(0.7); transform-origin: left; }
            100% { transform: scaleX(1); transform-origin: left; opacity: 0; }
        }
    </style>

    {{-- Toast Notifications --}}
    <div
        x-data="{
            toasts: [],
            add(toast) {
                const id = Date.now();
                this.toasts.push({ id, ...toast });
                setTimeout(() => this.remove(id), toast.lines ? 7000 : 4000);
            },
            remove(id) {
                this.toasts = this.toasts.filter(t => t.id !== id);
            }
        }"
        x-on:toast.window="add($event.detail)"
        @if(session('toast'))
        x-init="$nextTick(() => add({{ json_encode(session('toast')) }}))"
        @endif
        class="fixed top-6 right-6 z-[200] flex flex-col gap-2 pointer-events-none"
        style="min-width: 280px; max-width: 380px;"
    >
        <template x-for="toast in toasts" :key="toast.id">
            <div
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-8"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-x-0"
                x-transition:leave-end="opacity-0 translate-x-8"
                :class="{
                    'border-green-500': toast.type === 'success',
                    'border-red-500':   toast.type === 'error',
                    'border-blue-500':  toast.type === 'info',
                    'border-yellow-500': toast.type === 'warning',
                }"
                class="pointer-events-auto flex items-center gap-3 bg-white border-l-4 shadow-md rounded-xl px-4 py-3 text-sm text-gray-800"
            >
                <span
                    :class="{
                        'text-green-500': toast.type === 'success',
                        'text-red-500':   toast.type === 'error',
                        'text-blue-500':  toast.type === 'info',
                        'text-yellow-500': toast.type === 'warning',
                    }"
                    x-text="({'success':'✓','error':'✕','info':'ℹ','warning':'⚠'})[toast.type] ?? 'ℹ'"
                    class="text-base leading-none flex-shrink-0 font-bold"
                ></span>
                <div class="flex-1 min-w-0">
                    <template x-if="!toast.lines">
                        <span x-text="toast.message"></span>
                    </template>
                    <template x-if="toast.lines">
                        <div>
                            <p x-text="toast.message" class="font-medium mb-1.5"></p>
                            <ul class="space-y-0.5">
                                <template x-for="line in toast.lines" :key="line">
                                    <li class="flex items-start gap-1.5 text-xs text-gray-600">
                                        <span class="flex-shrink-0 mt-px">•</span>
                                        <span x-text="line"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </template>
                </div>
                <button
                    @click="remove(toast.id)"
                    class="text-gray-300 hover:text-gray-500 ml-1 flex-shrink-0 transition"
                >✕</button>
            </div>
        </template>
    </div>
</body>
</html>
