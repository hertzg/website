<?php

include_once '../fns/place_method_page.php';
place_method_page('sendExisting', [
    [
        'name' => 'id',
        'description' => 'The ID of the place to send.',
    ],
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
], [
    'PLACE_NOT_FOUND' => "A place with the ID doesn't exist.",
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'INVALID_RECEIVER_USERNAME' => 'The receiver username is invalid.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection to receive places from you.",
]);