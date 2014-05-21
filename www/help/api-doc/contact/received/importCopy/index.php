<?php

include_once '../fns/received_contact_method_page.php';
received_contact_method_page('importCopy', [
    [
        'name' => 'id',
        'description' => 'The ID of the received contact to copy.',
    ],
], ['RECEIVED_CONTACT_NOT_FOUND']);
