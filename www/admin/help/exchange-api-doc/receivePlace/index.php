<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
include_once '../../../../fns/Tags/maxNumber.php';
method_page('receivePlace', [
    [
        'name' => 'sender_username',
        'description' => 'The Zvini username of the sender.',
    ],
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
        'name' => 'altitude',
        'description' => 'The altitude of the place.',
    ],
    [
        'name' => 'name',
        'description' => 'The name of the place.',
    ],
    [
        'name' => 'description',
        'description' => 'The description of the place.',
    ],
    [
        'name' => 'tags',
        'description' => 'A space-separated list of tags.',
    ],
], ApiDoc\trueResult(), [
    'ENTER_SENDER_USERNAME' => 'The sender username is empty.',
    'INVALID_SENDER_USERNAME' => 'The sender username is invalid.',
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'INVALID_RECEIVER_USERNAME' => 'The receiver username is invalid.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection"
        .' to receive places from the sender.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
