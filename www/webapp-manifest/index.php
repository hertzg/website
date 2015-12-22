<?php

include_once '../fns/SiteBase/get.php';
$siteBase = SiteBase\get();

$description =
    'Save your data in Zvini. Save your files, contacts, notes and more.'
    .' It\'s free and easy.';

header('Content-Type: application/x-web-app-manifest+json');

include_once '../fns/get_absolute_base.php';
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
        'url' => get_absolute_base(),
    ],
    'icons' => [
        '16' => "{$siteBase}images/icons/16.png?"
            .get_revision('images/icons/16.png'),
        '32' => "{$siteBase}images/icons/32.png?"
            .get_revision('images/icons/32.png'),
        '48' => "{$siteBase}images/icons/48.png?2",
        '64' => "{$siteBase}images/icons/64.png?2",
        '90' => "{$siteBase}images/icons/90.png?2",
        '120' => "{$siteBase}images/icons/120.png?2",
        '128' => "{$siteBase}images/icons/128.png?2",
        '256' => "{$siteBase}images/icons/256.png?2",
        '512' => "{$siteBase}images/icons/512.png?1",
    ],
    'permissions' => [
        'geolocation' => [
            'description' => 'Required while entering place coordinates.',
        ],
    ],
]);
