<?php

include_once '../fns/place_method_page.php';
include_once '../../../../fns/Tags/maxNumber.php';
place_method_page('send', [
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
    [
        'name' => 'latitude',
        'description' => 'The latitude of the place.',
    ],
    [
        'name' => 'longitude',
        'description' => 'The longitude of the place.',
    ],
    [
        'name' => 'name',
        'description' => 'The name of the place.',
    ],
    [
        'name' => 'tags',
        'description' => 'Space-separated list of tags.',
    ],
], [
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'INVALID_RECEIVER_USERNAME' => 'The receiver username is invalid.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection to receive places from you.",
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
