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
    'CONTACT_NOT_FOUND' => "A contact with the ID doesn't exist.",
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' => "The receiver hasn't opened a connection to receive contacts from you.",
]);
