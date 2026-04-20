<!DOCTYPE html>
<html lang="nl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuniorDev — Vind je eerste vacature</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-gray-900 antialiased">

    {{-- Donkere header-sectie: nav + hero --}}
    <div class="hero-bg grain">
        <x-welcome.nav />
        <x-welcome.hero />
    </div>

    <x-welcome.marquee />
    <x-welcome.featured-jobs />
    <x-welcome.how-it-works />
    <x-welcome.cta />
    <x-welcome.footer />

</body>
</html>
