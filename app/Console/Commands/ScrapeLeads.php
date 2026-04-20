<?php

namespace App\Console\Commands;

use App\Models\Lead;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ScrapeLeads extends Command
{
    protected $signature = 'leads:scrape
                            {--provincie= : Zoek in een specifieke provincie (bijv. gelderland)}
                            {--category= : Filter op categorie (bijv. restaurant, kapper, bakker)}
                            {--limit=100 : Maximum aantal resultaten per categorie}
                            {--delay=5 : Seconden wachten tussen API requests}';

    protected $description = 'Zoek bedrijven zonder website per provincie via OpenStreetMap';

    /**
     * Vaste bounding boxes per provincie — geen Nominatim nodig.
     * Formaat: [south, west, north, east]
     */
    private array $provincies = [
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

    private array $categoryMap = [
        // Bouw & installatie
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
        // Overig
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

    private array $categoryLabels = [
        // Bouw & installatie
        'plumber'        => 'Installateur / Loodgieter',
        'electrician'    => 'Elektricien',
        'painter'        => 'Schilder',
        'carpenter'      => 'Timmerman',
        'roofer'         => 'Dakdekker',
        'plasterer'      => 'Stukadoor',
        'bricklayer'     => 'Metselaar',
        'hvac'           => 'HVAC / Klimaattechniek',
        'builder'        => 'Aannemer',
        // Overig
        'hairdresser'    => 'Kapper',
        'bakery'         => 'Bakker',
        'butcher'        => 'Slager',
        'car_repair'     => 'Garage',
        'beauty'         => 'Schoonheidssalon',
        'florist'        => 'Bloemist',
        'bicycle'        => 'Fietsenmaker',
        'supermarket'    => 'Supermarkt',
        'clothes'        => 'Kledingwinkel',
        'convenience'    => 'Gemakswinkel',
        'restaurant'     => 'Restaurant',
        'cafe'           => 'Café',
        'bar'            => 'Bar',
        'pharmacy'       => 'Apotheek',
        'dentist'        => 'Tandarts',
        'fitness_centre' => 'Sportschool',
    ];

    public function handle(): int
    {
        $provincie = $this->option('provincie') ? strtolower($this->option('provincie')) : null;
        $category = $this->option('category') ? strtolower($this->option('category')) : null;
        $limit = (int) $this->option('limit');
        $delay = (int) $this->option('delay');

        // Validatie
        if ($provincie && !isset($this->provincies[$provincie])) {
            $this->error("Onbekende provincie: {$provincie}");
            $this->info('Beschikbaar: ' . implode(', ', array_keys($this->provincies)));
            return Command::FAILURE;
        }

        if ($category && !isset($this->categoryMap[$category])) {
            $this->error("Onbekende categorie: {$category}");
            $this->info('Beschikbaar: ' . implode(', ', array_keys($this->categoryMap)));
            return Command::FAILURE;
        }

        // Welke provincies doorzoeken?
        $targets = $provincie
            ? [$provincie => $this->provincies[$provincie]]
            : $this->provincies;

        // Welke categorieën doorzoeken?
        $categories = $category
            ? [$category => $this->categoryMap[$category]]
            : $this->categoryMap;

        $totalImported = 0;
        $totalSkipped = 0;

        foreach ($targets as $provNaam => $bbox) {
            $this->newLine();
            $this->info("=== " . ucfirst($provNaam) . " ===");

            foreach ($categories as $catNaam => $catFilter) {
                $this->line("  Zoeken: {$catNaam}...");

                $query = $this->buildQuery($bbox, $catFilter, $limit);
                $data = $this->fetchOverpass($query);

                if ($data === null) {
                    $this->warn("    Overpass server niet beschikbaar, skip.");
                    sleep($delay);
                    continue;
                }

                [$imported, $skipped] = $this->processResults($data, $provNaam);
                $totalImported += $imported;
                $totalSkipped += $skipped;

                $this->line("    → {$imported} nieuw, {$skipped} overgeslagen");

                // Pauze tussen elke query
                sleep($delay);
            }
        }

        $this->newLine();
        $this->info("Klaar! {$totalImported} nieuw, {$totalSkipped} overgeslagen.");

        return Command::SUCCESS;
    }

    private function buildQuery(array $bbox, array $filter, int $limit): string
    {
        [$key, $value] = $filter;
        $box = "{$bbox[0]},{$bbox[1]},{$bbox[2]},{$bbox[3]}";

        // Haal alles op, filteren op website doen we in PHP (betrouwbaarder)
        return "[out:json][timeout:90];node[\"{$key}\"=\"{$value}\"][\"name\"]({$box});out {$limit};";
    }

    private function fetchOverpass(string $query): ?array
    {
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
                        return $json['elements'];
                    }
                }

                $this->line("    {$server}: HTTP {$response->status()}");
            } catch (\Exception $e) {
                $this->line("    {$server}: timeout");
            }

            sleep(2);
        }

        return null;
    }

    private function processResults(array $elements, string $provincie): array
    {
        $imported = 0;
        $skipped = 0;

        foreach ($elements as $element) {
            $tags = $element['tags'] ?? [];
            $name = $tags['name'] ?? null;

            if (!$name || isset($tags['website']) || isset($tags['contact:website'])) {
                continue;
            }

            $placeId = 'osm_' . ($element['type'] ?? 'node') . '_' . $element['id'];

            if (Lead::where('place_id', $placeId)->exists()) {
                $skipped++;
                continue;
            }

            Lead::create([
                'place_id' => $placeId,
                'business_name' => $name,
                'address' => trim(($tags['addr:street'] ?? '') . ' ' . ($tags['addr:housenumber'] ?? '')),
                'city' => $tags['addr:city'] ?? ucfirst($provincie),
                'phone' => $tags['phone'] ?? $tags['contact:phone'] ?? null,
                'category' => $this->resolveCategory($tags),
                'latitude' => $element['lat'] ?? null,
                'longitude' => $element['lon'] ?? null,
            ]);

            $imported++;
        }

        return [$imported, $skipped];
    }

    private function resolveCategory(array $tags): ?string
    {
        foreach (['craft', 'shop', 'amenity', 'leisure'] as $key) {
            if (isset($tags[$key]) && isset($this->categoryLabels[$tags[$key]])) {
                return $this->categoryLabels[$tags[$key]];
            }
            if (isset($tags[$key])) {
                return ucfirst($tags[$key]);
            }
        }

        return null;
    }
}
