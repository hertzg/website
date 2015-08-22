<?php

include_once '../fns/task_method_page.php';
include_once '../../fns/true_result.php';
include_once '../../../../fns/Tags/maxNumber.php';
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
        'description' => 'A space-separated list of tags.',
    ],
    [
        'name' => 'top_priority',
        'description' => 'Whether the task should be marked as top priority.',
    ],
], true_result(), [
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'INVALID_RECEIVER_USERNAME' => 'The receiver username is invalid.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection to receive tasks from you.",
    'ENTER_TEXT' => 'The text is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
