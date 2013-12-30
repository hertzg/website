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
        16 => '/images/icon16.png',
        32 => '/images/icon32.png',
        60 => '/images/icon60.png',
        64 => '/images/icon64.png',
        90 => '/images/icon90.png',
        120 => '/images/icon120.png',
        128 => '/images/icon128.png',
        256 => '/images/icon256.png',
    ),
));
