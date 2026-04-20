<?php
namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        $types = ['stage', 'bijbaan', 'freelance', 'parttime', 'fulltime'];
        $type = fake()->randomElement($types);

        $vacatures = [
            [
                'tech' => 'Laravel',
                'role' => 'Backend Developer',
                'description' => "Wij zijn op zoek naar een enthousiaste Laravel Backend Developer die ons team komt versterken. Je werkt mee aan de doorontwikkeling van ons SaaS-platform dat door honderden bedrijven dagelijks wordt gebruikt.\n\nJe taken bestaan onder andere uit het bouwen van REST APIs, het optimaliseren van databasequeries en het schrijven van geautomatiseerde tests. Je werkt nauw samen met onze frontend developers en product owner in een agile team.\n\nWij bieden een prettige werkomgeving, flexibele werktijden en ruimte om te groeien. Je krijgt de kans om mee te denken over architectuur en nieuwe features.",
                'requirements' => "- Minimaal 1 jaar ervaring met Laravel (of sterke affinity als junior)\n- Kennis van MySQL of PostgreSQL\n- Bekendheid met Git en versiebeheer\n- Goede communicatieve vaardigheden in het Nederlands\n- Zelfstandig én in teamverband kunnen werken",
            ],
            [
                'tech' => 'React',
                'role' => 'Frontend Developer',
                'description' => "Ben jij een creatieve Frontend Developer met een passie voor gebruiksvriendelijke interfaces? Dan zoeken wij jou! Je gaat werken aan moderne webapplicaties gebouwd in React en TypeScript.\n\nSamen met ons designteam vertaal je UI/UX ontwerpen naar werkende, toegankelijke componenten. Je zorgt voor een vlekkeloze gebruikerservaring op zowel desktop als mobiel.\n\nBij ons krijg je vrijheid om nieuwe technieken te verkennen en draag je bij aan onze componentenbibliotheek die door meerdere projecten wordt gebruikt.",
                'requirements' => "- Goede kennis van React en moderne JavaScript (ES6+)\n- Ervaring met CSS/SCSS en responsive design\n- Bekendheid met REST APIs en het ophalen van data\n- Oog voor detail en gevoel voor UX\n- Pluspunt: ervaring met TypeScript of Tailwind CSS",
            ],
            [
                'tech' => 'Vue.js',
                'role' => 'Frontend Developer',
                'description' => "Voor een snel groeiende startup zoeken we een Vue.js Frontend Developer. Je bouwt mee aan een innovatief dashboard waarmee onze klanten realtime inzicht krijgen in hun bedrijfsdata.\n\nJe bent verantwoordelijk voor het implementeren van nieuwe features, het verbeteren van de performance en het onderhouden van bestaande code. Je werkt direct samen met de CTO en hebt korte lijnen met de rest van het team.\n\nWij geloven in leren door te doen en bieden je een budget voor cursussen en conferenties.",
                'requirements' => "- Ervaring met Vue.js 3 en de Composition API\n- Basiskennis van Pinia of Vuex voor state management\n- Bekendheid met Vite of webpack\n- Proactieve houding en zin om bij te leren\n- Pluspunt: ervaring met Laravel als backend",
            ],
            [
                'tech' => 'Node.js',
                'role' => 'Backend Developer',
                'description' => "Ons technologiebedrijf is op zoek naar een Node.js Backend Developer die meebouwt aan onze microservices-architectuur. Je werkt aan schaalbare services die miljoenen requests per dag verwerken.\n\nJe werkzaamheden omvatten het ontwikkelen van nieuwe API-endpoints, het integreren van externe diensten en het monitoren van de performance van onze services. Je denkt mee over technische oplossingen en verbeteringen.\n\nFlexibel werken (deels remote) is mogelijk. We hebben een informele cultuur en organiseren regelmatig team-uitjes.",
                'requirements' => "- Kennis van Node.js en Express of Fastify\n- Ervaring met MongoDB of een andere NoSQL database\n- Begrip van asynchrone programmering en Promises\n- Basiskennis van Docker is een pre\n- Goede probleemoplossende vaardigheden",
            ],
            [
                'tech' => 'Python',
                'role' => 'Data Engineer',
                'description' => "Wij zoeken een Python Developer / Data Engineer die ons helpt bij het bouwen van datapijplijnen en analysetools. Je werkt samen met data scientists en helpt ruwe data om te zetten in bruikbare inzichten.\n\nJe schrijft scripts voor data-extractie, -transformatie en -laden (ETL), bouwt automatiseringstools en zorgt voor de kwaliteit en beschikbaarheid van data. Je werkt in een team van vier developers en twee data scientists.\n\nJe krijgt toegang tot moderne cloud-omgevingen (AWS/GCP) en de nieuwste AI-tools om je werk efficiënter te maken.",
                'requirements' => "- Goede kennis van Python 3\n- Basiskennis van pandas en/of SQL\n- Interesse in data en analyse\n- Nauwkeurig en gestructureerd werken\n- Pluspunt: ervaring met cloud (AWS, GCP of Azure)",
            ],
            [
                'tech' => 'Fullstack',
                'role' => 'Developer',
                'description' => "Als Fullstack Developer bij ons werk je van database tot gebruikersinterface. Je bent betrokken bij alle lagen van onze webapplicatie en krijgt een breed beeld van de technische stack.\n\nJe werkt aan features van begin tot eind: van het ontwerpen van de database tot het bouwen van de frontend. Je bent een allrounder die zowel zelfstandig als in teamverband kan werken.\n\nWij bieden een marktconform salaris, een laptop naar keuze, en 25 vakantiedagen. Remote werken is deels mogelijk.",
                'requirements' => "- Ervaring met zowel frontend (HTML/CSS/JS) als backend (PHP, Node.js of Python)\n- Basiskennis van relationele databases\n- Bekendheid met Git-workflow (branches, pull requests)\n- Goede communicatie in het Nederlands en Engels\n- Enthousiasme voor het volledig begrijpen van een systeem",
            ],
            [
                'tech' => 'PHP',
                'role' => 'Developer',
                'description' => "Voor een gevestigd softwarebedrijf in de zakelijke dienstverlening zoeken we een PHP Developer. Je werkt aan een bestaand systeem dat we stap voor stap moderniseren naar een Laravel-architectuur.\n\nJe taken: het refactoren van legacy code, het toevoegen van nieuwe modules en het schrijven van unittests. Je werkt in een team van vijf developers en een projectmanager.\n\nWij hebben een stabiele werkomgeving, goede secundaire arbeidsvoorwaarden en mogelijkheden voor professionele ontwikkeling.",
                'requirements' => "- Kennis van PHP 8.x\n- Basiskennis van Laravel is een pré\n- Bereidheid om met bestaande codebases te werken en deze te verbeteren\n- Teamspeler met een positieve werkhouding\n- Pluspunt: ervaring met PHPUnit of Pest",
            ],
            [
                'tech' => 'Mobile',
                'role' => 'App Developer',
                'description' => "Wij ontwikkelen apps die mensen helpen gezonder te leven, en we zoeken een Mobile Developer om ons team te versterken. Je werkt aan onze iOS- en Android-app in React Native.\n\nJe implementeert nieuwe features op basis van user feedback, fixt bugs en zorgt dat de app soepel werkt op verschillende apparaten en schermformaten. Je overlegt dagelijks met de product owner en de designer.\n\nWij zijn een jong bedrijf met een missie. Je krijgt veel verantwoordelijkheid en de kans om snel te groeien.",
                'requirements' => "- Kennis van React Native of bereidheid dit snel te leren\n- Basiskennis van JavaScript/TypeScript\n- Affiniteit met mobiele UX en platformspecifieke richtlijnen\n- Zelfstandige werkhouding\n- Pluspunt: eigen gepubliceerde apps of open-source projecten",
            ],
            [
                'tech' => 'DevOps',
                'role' => 'Engineer',
                'description' => "Ons platform groeit snel en we zoeken een DevOps Engineer die onze infrastructuur beheert en verbetert. Je zorgt ervoor dat onze applicaties snel, veilig en betrouwbaar draaien in de cloud.\n\nJe werkt aan CI/CD-pipelines, container-orchestratie met Kubernetes en monitoring van onze services. Je werkt nauw samen met het development team en helpt developers productiever te zijn.\n\nJe krijgt volledige vrijheid om de infra naar jouw inzicht in te richten en nieuwe tools te evalueren.",
                'requirements' => "- Kennis van Linux en bash-scripting\n- Ervaring met Docker en bij voorkeur Kubernetes\n- Basiskennis van CI/CD (GitHub Actions, GitLab CI of vergelijkbaar)\n- Interesse in cloud-platforms (AWS, Azure of GCP)\n- Veiligheid en betrouwbaarheid staan bij jou hoog in het vaandel",
            ],
            [
                'tech' => 'API',
                'role' => 'Backend Developer',
                'description' => "Voor een fintech-startup zoeken we een Backend Developer gespecialiseerd in API-ontwikkeling. Je bouwt mee aan de kern van ons platform: de API die door zowel onze eigen apps als externe partijen wordt gebruikt.\n\nJe ontwerpt en implementeert RESTful en GraphQL-endpoints, zorgt voor goede documentatie en denkt mee over authenticatie en beveiliging. Je bent de verbindende schakel tussen frontend en de rest van het systeem.\n\nWij werken in sprints van twee weken en hechten veel waarde aan code reviews en kennisdeling.",
                'requirements' => "- Ervaring met het bouwen van REST APIs\n- Kennis van authenticatie (OAuth2, JWT)\n- Basiskennis van API-documentatie (Swagger/OpenAPI)\n- Gevoel voor beveiliging en dataprotectie\n- Pluspunt: ervaring met GraphQL",
            ],
        ];

        $vacature = fake()->randomElement($vacatures);

        $typeLabels = [
            'stage'     => 'Stage',
            'bijbaan'   => 'Bijbaan',
            'freelance' => 'Freelance',
            'parttime'  => 'Parttime',
            'fulltime'  => 'Fulltime',
        ];

        $title = $vacature['tech'] . ' ' . $vacature['role'] . ' (' . $typeLabels[$type] . ')';

        return [
            'title'        => $title,
            'description'  => $vacature['description'],
            'type'         => $type,
            'region'       => fake()->randomElement(['Groningen','Friesland','Drenthe','Overijssel','Flevoland','Gelderland','Utrecht','Noord-Holland','Zuid-Holland','Zeeland','Noord-Brabant','Limburg','Remote']),
            'requirements' => $vacature['requirements'],
            'status'       => fake()->randomElement(['open', 'open', 'open', 'closed']),
        ];
    }
}
