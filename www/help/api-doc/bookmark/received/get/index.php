<?php

include_once '../fns/received_bookmark_method_page.php';
received_bookmark_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the received bookmark to get.',
    ],
], [
    'RECEIVED_BOOKMARK_NOT_FOUND' =>
        "A received bookmark with the ID doesn't exist.",
]);
