<?php
/*
Template Name: Jugend Links Page
*/

$emergencyContacts = [
    ['service' => 'Hotline-Kinderschutz', 'description' => '365 Tage im Jahr – rund um die Uhr und auf Wunsch anonym.', 'phone' => '(030) 61 00 66'],
    ['service' => 'Kindernotdienst', 'description' => 'für Eltern und Kinder bis 14 Jahre', 'phone' => '(030) 61 00 61'],
    ['service' => 'Jugendnotdienst', 'description' => 'für Jugendliche ab 14 Jahre', 'phone' => '(030) 61 00 62'],
    ['service' => 'Mädchennotdienst', 'description' => 'für Mädchen und junge Frauen von 12 bis 21 Jahre', 'phone' => '(030) 61 00 63'],
    ['service' => 'KuB', 'description' => 'für Kinder und Jugendliche, deren Lebensmittelpunkt die Straße ist', 'phone' => '(030) 61 00 68 00'],
    ['service' => 'Strohhalm e.V.', 'description' => 'Fachstelle für Prävention von sexueller Gewalt an Mädchen und Jungen', 'phone' => '(030) 614 18 29'],
    ['service' => 'Tauwetter', 'description' => 'Anlaufstelle für Männer die als Junge sex. Gewalt ausgesetzt waren', 'phone' => '(030) 693 8007'],
    ['service' => 'Kassandra e.V.', 'description' => 'Sexuelle Gewalt an behinderten Frauen und Mädchen', 'phone' => '(030) 698 1566'],
    ['service' => 'Wildwasser', 'description' => 'Mädchennotdienst', 'phone' => '(030) 21 00 3990'],
    ['service' => 'Wildwasser', 'description' => 'Selbsthilfe und Beratung', 'phone' => '(030) 693 91 92'],
    ['service' => 'Papatya', 'description' => 'Kriseneinrichtung für junge Migrantinnen c/o Jugendnotdienst', 'phone' => '(030) 61 00 63'],
    ['service' => 'neuhland', 'description' => 'Hilfe in Krisen, bei Suizidgefährdung und psychischen Problemen', 'phone' => '(030)873 01 11'],
    ['service' => 'Zufluchtwohnungen', 'description' => 'Paula Panke', 'phone' => '(030)4854702'],
    ['service' => 'Hilfe für Jungs e.V.', 'description' => 'berliner jungs-Hilfe für Jungen bei sexueller Gewalt', 'phone' => '(030) 499 52 047'],
    ['service' => 'BIG e.V.', 'description' => 'Adressenübersicht im Netz', 'phone' => '']
];

$resources = [
    ['title' => 'Jugendamt Pankow', 'url' => 'http://www.berlin.de/jugendamt-pankow/', 'description' => 'Krisentelefon für Kinder und Jugendliche: 90295-5555 Mo – Fr von 8 bis 18 Uhr'],
    ['title' => 'Jugendportal-Pankow', 'url' => 'http://www.jugendportal-pankow.de', 'description' => ''],
    ['title' => 'Jugendnetzwerk-Berlin', 'url' => 'http://jugendnetz-berlin.de/ger/start/index.php', 'description' => ''],
    ['title' => 'Elterninfo', 'url' => 'http://elterninfo.net', 'description' => 'Wegweiser für Familien in Berlin']
];

get_header(); // WordPress header
?>

<main class="flex-1 bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Jugend-Links</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">

                <!-- Hilfreiche Links -->
                <div class="bg-white shadow rounded-lg">
                    <div class="border-b px-6 py-4">
                        <h2 class="text-xl font-semibold">Hilfreiche Links</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <?php foreach ($resources as $resource): ?>
                            <div class="border-b border-gray-200 pb-4 last:border-b-0">
                                <a href="<?= esc_url($resource['url']) ?>" target="_blank" class="text-blue-600 hover:underline font-medium">
                                    <?= esc_html($resource['title']) ?>
                                </a>
                                <?php if (!empty($resource['description'])): ?>
                                    <p class="text-gray-600 text-sm mt-1"><?= esc_html($resource['description']) ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-gray-700">
                                <strong>Suchtberatung-Pankow</strong><br>
                                Tel.: 030 / 4759820
                            </p>
                        </div>

                        <div class="pt-4">
                            <p class="text-gray-700">
                                <strong>Krisentelefon für Kinder und Jugendliche</strong><br>
                                Überregionaler Bereitschaftsdienst aller Regionen (nachts von 24 – 8 Uhr und an Wochenenden)<br>
                                (030) 390 63-00
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Notfallkontakte -->
                <div class="bg-white shadow rounded-lg">
                    <div class="border-b px-6 py-4">
                        <h2 class="text-xl font-semibold">Notfallkontakte</h2>
                    </div>
                    <div class="p-6 overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold">Dienst</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold">Beschreibung</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold">Telefon</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($emergencyContacts as $index => $contact): ?>
                                    <tr class="<?= $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' ?>">
                                        <td class="border border-gray-300 px-4 py-3 font-medium"><?= esc_html($contact['service']) ?></td>
                                        <td class="border border-gray-300 px-4 py-3 text-sm"><?= esc_html($contact['description']) ?></td>
                                        <td class="border border-gray-300 px-4 py-3 text-sm font-mono">
                                            <?php if (!empty($contact['phone'])): ?>
                                                <a href="tel:<?= preg_replace('/[^\d]/', '', $contact['phone']) ?>" class="text-blue-600 hover:underline">
                                                    <?= esc_html($contact['phone']) ?>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Wichtiger Hinweis -->
                <div class="bg-yellow-50 shadow rounded-lg">
                    <div class="border-b px-6 py-4">
                        <h2 class="text-xl font-semibold text-yellow-800">Wichtiger Hinweis</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-yellow-800 leading-relaxed">
                            Bei akuten Notfällen wählen Sie bitte sofort den <strong>Notruf 110</strong> (Polizei)
                            oder <strong>112</strong> (Feuerwehr/Rettungsdienst). Die oben genannten Kontakte sind
                            spezialisierte Beratungs- und Hilfsdienste für verschiedene Situationen.
                        </p>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
