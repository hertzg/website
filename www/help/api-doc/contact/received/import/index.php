<?php

include_once '../fns/received_contact_method_page.php';
received_contact_method_page('import', [
    [
        'name' => 'id',
        'description' => 'The ID of the received contact to import.',
    ],
], ['RECEIVED_CONTACT_NOT_FOUND']);
