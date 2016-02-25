<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/wallet_method_page.php';
wallet_method_page('add', [
    [
        'name' => 'name',
        'description' => 'The name of the wallet.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly created wallet.',
], [
    'ENTER_NAME' => 'The name is empty.',
]);
