<?php

include_once '../fns/received_place_method_page.php';
received_place_method_page('importCopy', [
    [
        'name' => 'id',
        'description' => 'The ID of the received place to copy.',
    ],
], [
    'RECEIVED_PLACE_NOT_FOUND' => "A received place with the ID doesn't exist.",
]);
