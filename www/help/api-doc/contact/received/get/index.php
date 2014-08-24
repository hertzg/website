<?php

include_once '../fns/received_contact_method_page.php';
received_contact_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the received contact to get.',
    ],
], [
    'RECEIVED_CONTACT_NOT_FOUND' =>
        "A received contact with the ID doesn't exist.",
]);
