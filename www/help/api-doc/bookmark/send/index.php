<?php

include_once '../fns/bookmark_method_page.php';
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
    'ENTER_RECEIVER_USERNAME', 'RECEIVER_NOT_FOUND',
    'RECEIVER_NOT_RECEIVING', 'ENTER_URL', 'TOO_MANY_TAGS',
]);
