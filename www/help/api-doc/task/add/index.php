<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/task_method_page.php';
include_once '../../../../fns/Tags/maxNumber.php';
task_method_page('add', [
    [
        'name' => 'text',
        'description' => 'The text of the task.',
    ],
    [
        'name' => 'deadline_time',
        'description' => 'The Unix timestamp of the deadline of the task.',
    ],
    [
        'name' => 'tags',
        'description' => 'A space-separated list of tags.',
    ],
    [
        'name' => 'top_priority',
        'description' => 'Whether the task should be marked as top priority.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly created task.',
], [
    'ENTER_TEXT' => 'The text is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
