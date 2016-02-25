<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_bookmark_method_page.php';
received_bookmark_method_page('import', [
    [
        'name' => 'id',
        'description' => 'The ID of the received bookmark to move.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the imported bookmark.',
], [
    'RECEIVED_BOOKMARK_NOT_FOUND' =>
        "A received bookmark with the ID doesn't exist.",
]);
