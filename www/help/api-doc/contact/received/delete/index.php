<?php

include_once '../fns/received_contact_method_page.php';
include_once '../../../fns/true_result.php';
received_contact_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received contact to delete.',
    ],
], true_result(), [
    'RECEIVED_CONTACT_NOT_FOUND' =>
        "A received contact with the ID doesn't exist.",
]);
