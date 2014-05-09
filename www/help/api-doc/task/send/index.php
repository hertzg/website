<?php

include_once '../fns/task_method_page.php';
task_method_page('send', [
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
    [
        'name' => 'text',
        'description' => 'The text of the task.',
    ],
    [
        'name' => 'tags',
        'description' => 'Space-separated list of tags.',
    ],
    [
        'name' => 'top_priority',
        'description' => 'Whether the task should be marked as top priority.',
    ],
], [
    'ENTER_RECEIVER_USERNAME', 'RECEIVER_NOT_FOUND',
    'RECEIVER_NOT_RECEIVING', 'ENTER_TEXT', 'TOO_MANY_TAGS',
]);
