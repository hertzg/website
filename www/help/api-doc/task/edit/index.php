<?php

include_once '../fns/task_method_page.php';
task_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the task to edit.',
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
]);
