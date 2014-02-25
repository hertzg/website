<?php

header('Content-Type: application/x-web-app-manifest+json');

echo json_encode(array(
    'name' => 'Zvini',
    'description' => 'Save your data in Zvini. Save your files, contacts, notes and more. It\'s free and easy.',
    'developer' => array(
        'name' => 'Zvini Developers',
        'url' => 'http://zvini.com/',
    ),
    'icons' => array(
        16 => '/icons/16.png',
        32 => '/icons/32.png',
        60 => '/icons/60.png',
        64 => '/icons/64.png',
        90 => '/icons/90.png',
        120 => '/icons/120.png',
        128 => '/icons/128.png',
        256 => '/icons/256.png',
    ),
));
