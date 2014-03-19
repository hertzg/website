<?php

$description =
    'Save your data in Zvini. Save your files, contacts, notes and more.'
    .' It\'s free and easy.';

header('Content-Type: application/x-web-app-manifest+json');

echo json_encode(array(
    'name' => 'Zvini',
    'description' => $description,
    'developer' => array(
        'name' => 'Zvini Developers',
        'url' => 'http://zvini.com/',
    ),
    'icons' => array(
        16 => '/zvini-icons/16.png',
        32 => '/zvini-icons/32.png',
        60 => '/zvini-icons/60.png',
        64 => '/zvini-icons/64.png',
        90 => '/zvini-icons/90.png',
        120 => '/zvini-icons/120.png',
        128 => '/zvini-icons/128.png',
        256 => '/zvini-icons/256.png',
    ),
));
