<?php

include_once '../fns/SiteBase/get.php';
$siteBase = SiteBase\get();

$description =
    'Save your data in Zvini. Save your files, contacts, notes and more.'
    .' It\'s free and easy.';

include_once '../fns/Theme/Color/getDefault.php';
$theme_color = Theme\Color\getDefault();

include_once '../fns/get_revision.php';
$get_icon_href = function ($size) use ($siteBase, $theme_color) {
    $src = "theme/color/$theme_color/images/icon$size.png";
    return $src.get_revision($src);
};

header('Content-Type: application/x-web-app-manifest+json');

include_once '../fns/get_absolute_base.php';
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
        '16' => $get_icon_href('16'),
        '32' => $get_icon_href('32'),
        '48' => $get_icon_href('48'),
        '64' => $get_icon_href('64'),
        '90' => $get_icon_href('90'),
        '120' => $get_icon_href('120'),
        '128' => $get_icon_href('128'),
        '256' => $get_icon_href('256'),
        '512' => $get_icon_href('512'),
    ],
    'permissions' => [
        'geolocation' => [
            'description' => 'Required while entering place coordinates.',
        ],
    ],
]);
