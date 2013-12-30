<?php

header('Content-Type: application/json');
echo json_encode(array(
    'name' => 'Zvini',
    'description' => 'Save Your Data in Zvini. Save your files, contacts, notes and more. It\'s free and easy.',
    'developer' => array(
        'name' => 'Zvini Developers',
        'url' => 'http://zvini.com/',
    ),
    'icons' => array(
        16 => '/images/icon16.png',
        32 => '/images/icon32.png',
        64 => '/images/icon64.png',
        128 => '/images/icon128.png',
    ),
));
