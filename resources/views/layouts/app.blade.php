<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Art Bangkok 2026')</title>
    <link rel="stylesheet" href="https://use.typekit.net/hjg1ity.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

    {{-- Page Loading Bar --}}
    <div wire:loading.delay class="fixed top-0 left-0 right-0 z-[60] pointer-events-none">
        <div class="h-[3px] bg-black w-full animate-pulse"></div>
    </div>

    {{-- Toast Notifications --}}
    <div
        x-data="{
            toasts: [],
            add(toast) {
                const id = Date.now();
                this.toasts.push({ id, ...toast });
                setTimeout(() => this.remove(id), 3500);
            },
            remove(id) {
                this.toasts = this.toasts.filter(t => t.id !== id);
            }
        }"
        x-on:toast.window="add($event.detail)"
        @if(session('toast'))
        x-init="$nextTick(() => add({{ json_encode(session('toast')) }}))"
        @endif
        class="fixed top-6 right-6 z-50 flex flex-col gap-3 pointer-events-none"
        style="min-width: 260px; max-width: 380px;"
    >
        <template x-for="toast in toasts" :key="toast.id">
            <div
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                :class="{
                    'border-green-500': toast.type === 'success',
                    'border-red-500':   toast.type === 'error',
                    'border-blue-500':  toast.type === 'info',
                    'border-yellow-500': toast.type === 'warning',
                }"
                class="pointer-events-auto flex items-center gap-3 bg-white border-l-4 shadow-lg rounded-lg px-4 py-3 text-sm text-gray-800"
            >
                <span
                    :class="{
                        'text-green-500': toast.type === 'success',
                        'text-red-500':   toast.type === 'error',
                        'text-blue-500':  toast.type === 'info',
                        'text-yellow-500': toast.type === 'warning',
                    }"
                    x-text="({'success':'✓','error':'✕','info':'ℹ','warning':'⚠'})[toast.type] ?? 'ℹ'"
                    class="text-lg leading-none flex-shrink-0 font-bold"
                ></span>
                <span x-text="toast.message" class="flex-1"></span>
                <button
                    @click="remove(toast.id)"
                    class="text-gray-400 hover:text-gray-600 ml-1 flex-shrink-0"
                >✕</button>
            </div>
        </template>
    </div>
</body>
</html>
