<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JuniorDev – Jouw carrière begint hier</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-white">

    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="text-2xl font-black text-indigo-600">Junior<span class="text-gray-800">Dev</span></a>
                <div class="flex items-center gap-4">
                    <a href="{{ route('assignments.index') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">Opdrachten</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">Inloggen</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Registreren</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="relative bg-gradient-to-br from-indigo-50 via-white to-purple-50 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 text-sm font-semibold rounded-full mb-6">Het platform voor junior developers</span>
            <h1 class="text-5xl sm:text-6xl font-black text-gray-900 leading-tight mb-6">
                Vind je eerste <span class="text-indigo-600">developer</span> job
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-10">
                JuniorDev verbindt ambitieuze junior developers met bedrijven die op zoek zijn naar vers talent. Stage, bijbaan of freelance – jij kiest.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-indigo-600 text-white text-lg font-semibold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                    Start gratis &rarr;
                </a>
                <a href="{{ route('assignments.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-gray-800 text-lg font-semibold rounded-xl border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition">
                    Bekijk opdrachten
                </a>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-8 text-center">
                <div>
                    <p class="text-4xl font-black text-indigo-600">{{ \App\Models\Assignment::where('status','open')->count() }}+</p>
                    <p class="text-gray-600 mt-1 font-medium">Open opdrachten</p>
                </div>
                <div>
                    <p class="text-4xl font-black text-indigo-600">{{ \App\Models\User::where('role','company')->count() }}+</p>
                    <p class="text-gray-600 mt-1 font-medium">Bedrijven</p>
                </div>
                <div>
                    <p class="text-4xl font-black text-indigo-600">{{ \App\Models\User::where('role','student')->count() }}+</p>
                    <p class="text-gray-600 mt-1 font-medium">Junior developers</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-black text-gray-900">Hoe werkt het?</h2>
                <p class="text-gray-600 mt-3 text-lg">In drie eenvoudige stappen aan de slag</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-black text-indigo-600">1</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Maak een profiel</h3>
                    <p class="text-gray-600 text-sm">Registreer als student of bedrijf en vul je profiel in met je skills en ervaring.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-black text-indigo-600">2</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Ontdek opdrachten</h3>
                    <p class="text-gray-600 text-sm">Blader door honderden opdrachten gefilterd op regio, type en vaardigheden.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-black text-indigo-600">3</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Reageer &amp; connect</h3>
                    <p class="text-gray-600 text-sm">Stuur een motivatie, word geaccepteerd en communiceer direct via het platform.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest assignments -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-black text-gray-900">Nieuwste opdrachten</h2>
                    <p class="text-gray-600 mt-1">Direct beschikbaar voor jou</p>
                </div>
                <a href="{{ route('assignments.index') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 text-sm">Alle opdrachten &rarr;</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(\App\Models\Assignment::with('company.companyProfile')->where('status','open')->latest()->take(6)->get() as $assignment)
                <a href="{{ route('assignments.show', $assignment) }}" class="group bg-white border border-gray-200 rounded-2xl p-6 hover:border-indigo-300 hover:shadow-md transition">
                    <div class="flex items-start justify-between mb-3">
                        <span class="inline-block px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-semibold rounded-full">{{ ucfirst($assignment->type) }}</span>
                        <span class="text-xs text-gray-400">{{ $assignment->region }}</span>
                    </div>
                    <h3 class="font-bold text-gray-900 group-hover:text-indigo-600 transition mb-1">{{ $assignment->title }}</h3>
                    <p class="text-sm text-gray-500 mb-3">{{ $assignment->company->companyProfile?->company_name ?? $assignment->company->name }}</p>
                    <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($assignment->description, 120) }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 bg-indigo-600">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-black text-white mb-4">Klaar om te beginnen?</h2>
            <p class="text-indigo-200 text-lg mb-8">Registreer gratis en vind vandaag nog jouw eerste developer opdracht.</p>
            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-indigo-600 text-lg font-bold rounded-xl hover:bg-indigo-50 transition">
                Registreer gratis
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-lg font-black text-white mb-2">Junior<span class="text-indigo-400">Dev</span></p>
            <p class="text-sm">&copy; {{ date('Y') }} JuniorDev. Alle rechten voorbehouden.</p>
        </div>
    </footer>

</body>
</html>
