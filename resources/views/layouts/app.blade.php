<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'JuniorDev') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-surface text-gray-900 min-h-screen flex flex-col">

    @include('layouts.navigation')

    @isset($header)
        <div class="bg-white border-b border-gray-200 shadow-[0_1px_3px_rgba(0,0,0,0.04)]">
            <div class="max-w-7xl mx-auto px-6 py-7">
                {{ $header }}
            </div>
        </div>
    @endisset

    <main class="flex-1">{{ $slot }}</main>

    <footer class="border-t border-gray-200 bg-white mt-auto">
        <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center text-xs text-gray-400">
            <span>&copy; {{ date('Y') }} JuniorDev</span>
            <a href="{{ route('home') }}" class="font-semibold text-gray-500 hover:text-gray-900 transition">
                Junior<span class="text-brand">Dev</span>
            </a>
        </div>
    </footer>

</body>
</html>
