<?php

include_once '../fns/note_method_page.php';
note_method_page('send', [
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
    [
        'name' => 'text',
        'description' => 'The text of the note.',
    ],
    [
        'name' => 'tags',
        'description' => 'Space-separated list of tags.',
    ],
], [
    'ENTER_RECEIVER_USERNAME', 'RECEIVER_NOT_FOUND',
    'RECEIVER_NOT_RECEIVING', 'ENTER_TEXT', 'TOO_MANY_TAGS',
]);
