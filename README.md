# JuniorDev

Een Laravel 12 platform dat junior developers koppelt aan bedrijven. Studenten kunnen vacatures bekijken en solliciteren, bedrijven kunnen vacatures plaatsen en kandidaten beheren.

## Tech stack

- **Laravel 12** — MVC framework
- **Laravel Breeze** — authenticatie (Blade stack)
- **Tailwind CSS** — styling met custom dark/lime design
- **SQLite** — database (via Laravel Herd)
- **Eloquent ORM** — modellen en relaties
- **Laravel Policies** — autorisatie per rol
- **Laravel Notifications** — e-mailmeldingen

## Rollen

| Rol | Mogelijkheden |
|---|---|
| **Student** | Registreren, profiel invullen, vacatures bekijken, solliciteren, berichten sturen |
| **Bedrijf** | Registreren, bedrijfsprofiel invullen, vacatures plaatsen/bewerken, sollicitanten beheren, berichten sturen |
| **Admin** | Gebruikers en vacatures beheren, statistieken bekijken |

## Projectstructuur

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── JobController.php          # Vacatures (bekijken, aanmaken, bewerken)
│   │   ├── ApplicationController.php  # Sollicitaties beheren
│   │   ├── DashboardController.php    # Dashboard per rol
│   │   ├── AdminController.php        # Beheerderspanel
│   │   ├── MessageController.php      # Berichten
│   │   └── ProfileController.php      # Profielbeheer
│   └── Middleware/
│       └── CheckRole.php              # Rol-gebaseerde toegangsbeveiliging
├── Models/
│   ├── User.php                       # Gebruiker (student/company/admin)
│   ├── Job.php                        # Vacature (tabel: job_listings)
│   ├── Application.php                # Sollicitatie
│   ├── Message.php                    # Bericht
│   ├── StudentProfile.php             # Studentprofiel
│   └── CompanyProfile.php             # Bedrijfsprofiel
├── Policies/
│   ├── JobPolicy.php                  # Wie mag vacatures bewerken/verwijderen
│   └── ApplicationPolicy.php         # Wie mag sollicitaties inzien/updaten
└── Notifications/
    ├── ApplicationReceived.php        # Mail bij nieuwe sollicitatie
    ├── ApplicationStatusChanged.php   # Mail bij statuswijziging
    └── NewMessageReceived.php         # Mail bij nieuw bericht

database/
├── migrations/                        # Tabelstructuur
├── factories/                         # Faker-gebaseerde testdata
└── seeders/DatabaseSeeder.php         # Vult de database met testdata

resources/views/
├── jobs/                              # Vacatures overzicht en detailpagina
├── company/jobs/                      # Vacatures aanmaken/bewerken (bedrijf)
├── company/applications/              # Sollicitanten bekijken (bedrijf)
├── student/applications/              # Mijn sollicitaties (student)
├── dashboard/                         # Dashboards per rol
├── messages/                          # Berichten
├── admin/                             # Beheerderspanel
└── layouts/                           # App layout en navigatie

routes/web.php                         # Alle routes gegroepeerd per rol
```

## Installatie

```bash
# Kloon het project
git clone <repo-url>
cd juniordev

# Installeer dependencies
composer install
npm install

# Omgevingsvariabelen instellen
cp .env.example .env
php artisan key:generate

# Database aanmaken en vullen met testdata
touch database/database.sqlite
php artisan migrate:fresh --seed

# Frontend bouwen
npm run dev
```

> Met **Laravel Herd** open je de site op `http://juniordev.test` — geen verdere configuratie nodig.

## Testaccounts (na seeder)

Na `php artisan migrate:fresh --seed` zijn de volgende accounts beschikbaar:

| Rol | E-mail | Wachtwoord |
|---|---|---|
| Admin | admin@juniordev.nl | password |
| Bedrijf | (zie seeder output) | password |
| Student | (zie seeder output) | password |

## Routes

| URL | Naam | Beschrijving |
|---|---|---|
| `/` | `home` | Homepage |
| `/vacatures` | `jobs.index` | Alle vacatures |
| `/vacatures/{job}` | `jobs.show` | Vacature detail |
| `/company/jobs` | `company.jobs.index` | Mijn vacatures (bedrijf) |
| `/company/jobs/create` | `company.jobs.create` | Nieuwe vacature |
| `/dashboard` | `dashboard` | Dashboard (rol-afhankelijk) |
| `/messages` | `messages.index` | Berichten |
| `/admin/users` | `admin.users` | Gebruikersbeheer |
| `/admin/jobs` | `admin.jobs` | Vacaturebeheer |

## Ontwerp

Dark/lime kleurschema:

- **Achtergrond:** `#f8f7f4` (gebroken wit)
- **Navigatie:** `#0a0a0a` (bijna zwart)
- **Accent:** `#c8f135` (lime groen)
- **Knoppen:** `rounded-full` met zwarte achtergrond
- **Kaarten:** `rounded-2xl` met subtiele border
