<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuniorDev — Vind je eerste vacature</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap');
        body { font-family: 'Inter', sans-serif; }

        .hero-bg {
            background-color: #0a0a0a;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 48px 48px;
        }
        .hero-glow {
            position: absolute;
            width: 700px; height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(200,241,53,0.07) 0%, transparent 65%);
            pointer-events: none;
            top: -200px; left: -200px;
        }
        .display {
            font-size: clamp(3.8rem, 7.5vw, 7.5rem);
            font-weight: 900;
            line-height: 0.93;
            letter-spacing: -0.04em;
        }
        .outline-word {
            -webkit-text-stroke: 2px white;
            color: transparent;
        }
        .card-float {
            transform: rotate(-1.5deg);
            transition: transform 0.4s ease;
        }
        .card-float:hover { transform: rotate(0deg) scale(1.02); }

        .marquee-track {
            display: flex;
            animation: ticker 28s linear infinite;
            white-space: nowrap;
        }
        @keyframes ticker {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }
        .step-num {
            font-size: clamp(4rem, 8vw, 7rem);
            font-weight: 900;
            line-height: 1;
            letter-spacing: -0.05em;
            color: rgba(255,255,255,0.06);
        }
        .grain {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            background-repeat: repeat;
            background-size: 180px 180px;
        }
    </style>
</head>
<body class="bg-[#f8f7f4] text-gray-900 antialiased">

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
