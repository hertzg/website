<?php

include_once '../fns/DomainName/get.php';
$domainName = DomainName\get();

include_once '../fns/SiteBase/get.php';
$siteBase = SiteBase\get();

$description =
    'Save your data in Zvini. Save your files, contacts, notes and more.'
    .' It\'s free and easy.';

header('Content-Type: application/x-web-app-manifest+json');

include_once '../fns/get_revision.php';
include_once '../fns/SiteTitle/get.php';
echo json_encode([
    'name' => SiteTitle\get(),
    'version' => '2.0',
    'description' => $description,
    'fullscreen' => 'true',
    'launch_path' => $siteBase,
    'developer' => [
        'name' => 'Zvini Developers',
        'url' => "http://$domainName/",
    ],
    'icons' => [
        '16' => "{$siteBase}images/icons/16.png?"
            .get_revision('images/icons/16.png'),
        '32' => "{$siteBase}images/icons/32.png?"
            .get_revision('images/icons/32.png'),
        '48' => "{$siteBase}images/icons/48.png?1",
        '60' => "{$siteBase}images/icons/60.png?1",
        '64' => "{$siteBase}images/icons/64.png?1",
        '84' => "{$siteBase}images/icons/84.png",
        '90' => "{$siteBase}images/icons/90.png?1",
        '120' => "{$siteBase}images/icons/120.png?1",
        '126' => "{$siteBase}images/icons/126.png",
        '128' => "{$siteBase}images/icons/128.png?1",
        '142' => "{$siteBase}images/icons/142.png",
        '189' => "{$siteBase}images/icons/189.png",
        '256' => "{$siteBase}images/icons/256.png?1",
        '512' => "{$siteBase}images/icons/512.png",
    ],
    'permissions' => [
        'geolocation' => [
            'description' => 'Required while entering place coordinates.',
        ],
    ],
]);
