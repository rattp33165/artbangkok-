<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Bangkok 2026</title>
    <link rel="stylesheet" href="https://use.typekit.net/hjg1ity.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-white">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('components.footer')

    @livewireScripts
</body>
</html>
