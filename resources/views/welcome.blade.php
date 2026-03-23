<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuniorDev - Vind je eerste opdracht</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @include('layouts.navigation')

    <!-- Hero -->
    <div class="bg-indigo-700 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">Jouw eerste stap als developer begint hier</h1>
            <p class="text-xl text-indigo-200 mb-8">Vind stages, bijbanen en freelance opdrachten als junior developer</p>
            <div class="flex justify-center gap-4 flex-wrap">
                <a href="{{ route('assignments.index') }}" class="bg-white text-indigo-700 font-semibold px-6 py-3 rounded-lg hover:bg-indigo-50 transition">
                    Bekijk opdrachten
                </a>
                <a href="{{ route('register') }}" class="border-2 border-white text-white font-semibold px-6 py-3 rounded-lg hover:bg-indigo-600 transition">
                    Gratis registreren
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-8 text-center">
                <div>
                    <div class="text-3xl font-bold text-indigo-600">{{ \App\Models\Assignment::where('status','open')->count() }}+</div>
                    <div class="text-gray-600 mt-1">Open opdrachten</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-indigo-600">{{ \App\Models\User::where('role','company')->count() }}+</div>
                    <div class="text-gray-600 mt-1">Bedrijven</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-indigo-600">{{ \App\Models\User::where('role','student')->count() }}+</div>
                    <div class="text-gray-600 mt-1">Junior developers</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Assignments -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Nieuwste opdrachten</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach(\App\Models\Assignment::with('company.companyProfile')->where('status','open')->latest()->take(3)->get() as $assignment)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-3">
                    <span class="text-xs font-medium bg-indigo-100 text-indigo-700 px-2 py-1 rounded">{{ $assignment->type }}</span>
                    <span class="text-xs text-gray-500">{{ $assignment->region }}</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">{{ $assignment->title }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($assignment->description, 100) }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">{{ $assignment->company->companyProfile->company_name ?? $assignment->company->name }}</span>
                    <a href="{{ route('assignments.show', $assignment) }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Bekijk &rarr;</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('assignments.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                Alle opdrachten bekijken
            </a>
        </div>
    </div>

    <!-- How it works -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 text-center mb-12">Hoe werkt het?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-lg font-semibold text-indigo-600 mb-4">Voor studenten</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="bg-indigo-600 text-white rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold shrink-0">1</div>
                            <p class="text-gray-700">Maak gratis een account aan als student</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="bg-indigo-600 text-white rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold shrink-0">2</div>
                            <p class="text-gray-700">Vul je profiel in met skills en regio</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="bg-indigo-600 text-white rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold shrink-0">3</div>
                            <p class="text-gray-700">Reageer op opdrachten die bij je passen</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-indigo-600 mb-4">Voor bedrijven</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="bg-indigo-600 text-white rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold shrink-0">1</div>
                            <p class="text-gray-700">Registreer je bedrijf</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="bg-indigo-600 text-white rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold shrink-0">2</div>
                            <p class="text-gray-700">Plaats je opdracht of vacature</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="bg-indigo-600 text-white rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold shrink-0">3</div>
                            <p class="text-gray-700">Selecteer de beste junior developer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} JuniorDev &mdash; Het platform voor junior developers
        </div>
    </footer>
</body>
</html>
