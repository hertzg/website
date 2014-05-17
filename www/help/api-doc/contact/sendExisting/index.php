<?php

include_once '../fns/contact_method_page.php';
contact_method_page('sendExisting', [
    [
        'name' => 'id',
        'description' => 'The ID of the contact to send.',
    ],
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
], [
    'CONTACT_NOT_FOUND', 'ENTER_RECEIVER_USERNAME',
    'RECEIVER_NOT_FOUND', 'RECEIVER_NOT_RECEIVING',
]);
