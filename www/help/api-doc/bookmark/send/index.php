<?php

include_once '../fns/bookmark_method_page.php';
include_once '../../../../fns/Tags/maxNumber.php';
bookmark_method_page('send', [
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
    [
        'name' => 'url',
        'description' => 'The URL of the bookmark.',
    ],
    [
        'name' => 'title',
        'description' => 'The title of the bookmark.',
    ],
    [
        'name' => 'tags',
        'description' => 'Space-separated list of tags.',
    ],
], [
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection"
        .' to receive bookmarks from you.',
    'ENTER_URL' => 'The URL is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
