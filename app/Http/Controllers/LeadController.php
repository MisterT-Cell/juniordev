<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LeadController extends Controller
{
    /**
     * Publieke pagina: toon alle bedrijven zonder website.
     */
    public function index(Request $request)
    {
        $query = Lead::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($city = $request->input('city')) {
            $query->where('city', $city);
        }

        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        $leads = $query->orderBy('created_at', 'desc')->paginate(12);
        $cities = Lead::whereNotNull('city')->distinct()->orderBy('city')->pluck('city');
        $categories = Lead::whereNotNull('category')->distinct()->orderBy('category')->pluck('category');

        return view('leads.index', compact('leads', 'cities', 'categories'));
    }

    /**
     * API: lazy load meer leads (voor infinite scroll).
     */
    public function loadMore(Request $request)
    {
        $query = Lead::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($city = $request->input('city')) {
            $query->where('city', $city);
        }

        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        $leads = $query->orderBy('created_at', 'desc')->paginate(12);

        return response()->json([
            'html' => view('leads._cards', compact('leads'))->render(),
            'next_page' => $leads->hasMorePages() ? $leads->currentPage() + 1 : null,
            'total' => $leads->total(),
        ]);
    }

    /**
     * Admin: toon formulier om een lead toe te voegen.
     */
    public function create()
    {
        return view('admin.leads.create');
    }

    /**
     * Admin: sla een nieuw bedrijf op.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'category' => 'nullable|string|max:255',
        ]);

        $validated['place_id'] = 'manual_' . uniqid();

        Lead::create($validated);

        return redirect()->route('admin.leads.index')
            ->with('success', 'Bedrijf succesvol toegevoegd.');
    }

    /**
     * Admin: overzicht van alle leads.
     */
    public function adminIndex(Request $request)
    {
        $query = Lead::query();

        if ($search = $request->input('search')) {
            $query->where('business_name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
        }

        $leads = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.leads.index', compact('leads'));
    }

    /**
     * Admin: bewerk een lead.
     */
    public function edit(Lead $lead)
    {
        return view('admin.leads.edit', compact('lead'));
    }

    /**
     * Admin: update een lead.
     */
    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'category' => 'nullable|string|max:255',
        ]);

        $lead->update($validated);

        return redirect()->route('admin.leads.index')
            ->with('success', 'Bedrijf succesvol bijgewerkt.');
    }

    /**
     * Admin: verwijder een lead.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('admin.leads.index')
            ->with('success', 'Bedrijf verwijderd.');
    }

    /**
     * Admin: scrape bedrijven via OpenStreetMap.
     */
    public function scrape(Request $request)
    {
        $request->validate([
            'provincie' => 'required|string',
            'category' => 'required|string',
            'limit' => 'nullable|integer|min:1|max:500',
        ]);

        $provincies = [
            'groningen'     => [53.09, 6.15, 53.55, 7.09],
            'friesland'     => [52.74, 4.87, 53.47, 6.26],
            'drenthe'       => [52.63, 6.10, 53.13, 7.09],
            'overijssel'    => [52.13, 5.73, 52.84, 6.92],
            'flevoland'     => [52.25, 5.10, 52.65, 5.95],
            'gelderland'    => [51.73, 5.05, 52.45, 6.38],
            'utrecht'       => [51.94, 4.95, 52.23, 5.55],
            'noord-holland' => [52.18, 4.50, 53.00, 5.25],
            'zuid-holland'  => [51.68, 3.83, 52.23, 4.88],
            'zeeland'       => [51.20, 3.33, 51.75, 4.28],
            'noord-brabant' => [51.24, 4.38, 51.82, 6.05],
            'limburg'       => [50.75, 5.55, 51.78, 6.23],
        ];

        $categories = [
            'installateur'  => ['craft', 'plumber'],
            'elektricien'   => ['craft', 'electrician'],
            'schilder'      => ['craft', 'painter'],
            'timmerman'     => ['craft', 'carpenter'],
            'loodgieter'    => ['craft', 'plumber'],
            'dakdekker'     => ['craft', 'roofer'],
            'stukadoor'     => ['craft', 'plasterer'],
            'metselaar'     => ['craft', 'bricklayer'],
            'hvac'          => ['craft', 'hvac'],
            'aannemer'      => ['craft', 'builder'],
            'restaurant'    => ['amenity', 'restaurant'],
            'cafe'          => ['amenity', 'cafe'],
            'kapper'        => ['shop', 'hairdresser'],
            'bakker'        => ['shop', 'bakery'],
            'slager'        => ['shop', 'butcher'],
            'garage'        => ['shop', 'car_repair'],
            'schoonheid'    => ['shop', 'beauty'],
            'bloemist'      => ['shop', 'florist'],
            'fietsen'       => ['shop', 'bicycle'],
            'apotheek'      => ['amenity', 'pharmacy'],
            'tandarts'      => ['amenity', 'dentist'],
            'bar'           => ['amenity', 'bar'],
            'gym'           => ['leisure', 'fitness_centre'],
        ];

        $categoryLabels = [
            'plumber' => 'Installateur / Loodgieter', 'electrician' => 'Elektricien',
            'painter' => 'Schilder', 'carpenter' => 'Timmerman', 'roofer' => 'Dakdekker',
            'plasterer' => 'Stukadoor', 'bricklayer' => 'Metselaar', 'hvac' => 'HVAC / Klimaattechniek',
            'builder' => 'Aannemer', 'hairdresser' => 'Kapper', 'bakery' => 'Bakker',
            'butcher' => 'Slager', 'car_repair' => 'Garage', 'beauty' => 'Schoonheidssalon',
            'florist' => 'Bloemist', 'bicycle' => 'Fietsenmaker', 'restaurant' => 'Restaurant',
            'cafe' => 'Café', 'bar' => 'Bar', 'pharmacy' => 'Apotheek', 'dentist' => 'Tandarts',
            'fitness_centre' => 'Sportschool',
        ];

        $provKey = strtolower($request->input('provincie'));
        $catKey = strtolower($request->input('category'));
        $limit = $request->input('limit', 100);

        if (!isset($provincies[$provKey]) || !isset($categories[$catKey])) {
            return back()->with('error', 'Ongeldige provincie of categorie.');
        }

        $bbox = $provincies[$provKey];
        [$osmKey, $osmValue] = $categories[$catKey];
        $box = "{$bbox[0]},{$bbox[1]},{$bbox[2]},{$bbox[3]}";

        $query = "[out:json][timeout:90];node[\"{$osmKey}\"=\"{$osmValue}\"][\"name\"]({$box});out {$limit};";

        // Probeer Overpass servers
        $elements = null;
        $servers = [
            'https://overpass-api.de/api/interpreter',
            'https://overpass.kumi.systems/api/interpreter',
        ];

        foreach ($servers as $server) {
            try {
                $response = Http::timeout(120)
                    ->withHeaders(['User-Agent' => 'JuniorDev/1.0'])
                    ->get($server, ['data' => $query]);

                if ($response->successful()) {
                    $json = $response->json();
                    if ($json && isset($json['elements'])) {
                        $elements = $json['elements'];
                        break;
                    }
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        if ($elements === null) {
            return back()->with('error', 'OpenStreetMap server is niet beschikbaar. Probeer het later opnieuw.');
        }

        $imported = 0;
        $skipped = 0;

        foreach ($elements as $element) {
            $tags = $element['tags'] ?? [];
            $name = $tags['name'] ?? null;

            // Filter: geen naam of WEL een website → overslaan
            if (!$name || isset($tags['website']) || isset($tags['contact:website'])) {
                continue;
            }

            $placeId = 'osm_' . ($element['type'] ?? 'node') . '_' . $element['id'];

            if (Lead::where('place_id', $placeId)->exists()) {
                $skipped++;
                continue;
            }

            $osmValue = $tags[$osmKey] ?? null;
            $label = $categoryLabels[$osmValue] ?? ($osmValue ? ucfirst($osmValue) : null);

            Lead::create([
                'place_id' => $placeId,
                'business_name' => $name,
                'address' => trim(($tags['addr:street'] ?? '') . ' ' . ($tags['addr:housenumber'] ?? '')),
                'city' => $tags['addr:city'] ?? ucfirst($provKey),
                'phone' => $tags['phone'] ?? $tags['contact:phone'] ?? null,
                'category' => $label,
                'latitude' => $element['lat'] ?? null,
                'longitude' => $element['lon'] ?? null,
            ]);

            $imported++;
        }

        $provLabel = ucfirst($provKey);
        return back()->with('success', "{$imported} bedrijven gevonden in {$provLabel} ({$skipped} al bekend).");
    }

    /**
     * Admin: importeer leads vanuit CSV.
     */
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getPathname(), 'r');

        $header = fgetcsv($handle, 0, ';');
        $header = array_map('strtolower', array_map('trim', $header));

        $imported = 0;

        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            $data = array_combine($header, array_map('trim', $row));

            $name = $data['business_name'] ?? $data['bedrijfsnaam'] ?? $data['naam'] ?? null;
            if (!$name) continue;

            Lead::updateOrCreate(
                ['business_name' => $name, 'city' => $data['city'] ?? $data['stad'] ?? $data['plaats'] ?? null],
                [
                    'place_id' => 'csv_' . uniqid(),
                    'business_name' => $name,
                    'address' => $data['address'] ?? $data['adres'] ?? null,
                    'city' => $data['city'] ?? $data['stad'] ?? $data['plaats'] ?? null,
                    'phone' => $data['phone'] ?? $data['telefoon'] ?? null,
                    'category' => $data['category'] ?? $data['categorie'] ?? null,
                ]
            );

            $imported++;
        }

        fclose($handle);

        return redirect()->route('admin.leads.index')
            ->with('success', "{$imported} bedrijven geïmporteerd.");
    }
}
