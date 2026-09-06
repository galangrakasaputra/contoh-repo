<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Landing Page Modern')</title>

    {{-- Tailwind CSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine Cloak --}}
    {{-- Mencegah elemen Alpine muncul sesaat sebelum Alpine selesai loading --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    {{-- Alpine.js --}}
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>
</head>

<body class="bg-slate-50 text-slate-800 antialiased font-sans selection:bg-rose-600 selection:text-white flex flex-col min-h-screen">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Global Login Modal --}}
    @include('partials.login')

    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

</body>

</html>
