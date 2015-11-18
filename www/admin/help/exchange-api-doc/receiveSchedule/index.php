<?php

include_once '../fns/method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
include_once '../../../../fns/Tags/maxNumber.php';
method_page('receiveSchedule', [
    [
        'name' => 'sender_username',
        'description' => 'The Zvini username of the sender.',
    ],
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
    [
        'name' => 'text',
        'description' => 'The text of the schedule.',
    ],
    [
        'name' => 'interval',
        'description' => 'The number of days in which the schedule repeats.'
            .' Its value can be 2 or greater.',
    ],
    [
        'name' => 'offset',
        'description' => 'The number of days from January 1st 1970'
            .' to the next day on which the schedule is effective.',
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
        .' to receive bookmarks from the sender.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);