<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/task_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
include_once '../../../../fns/Tags/maxNumber.php';
task_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the task to edit.',
    ],
    [
        'name' => 'text',
        'description' => 'The new text of the task.',
    ],
    [
        'name' => 'deadline_time',
        'description' => 'The new Unix timestamp of the deadline of the task.',
    ],
    [
        'name' => 'tags',
        'description' => 'A space-separated list of tags.',
    ],
    [
        'name' => 'top_priority',
        'description' => 'Whether the task should be marked as top priority.',
    ],
], ApiDoc\trueResult(), [
    'TASK_NOT_FOUND' => "A task with the ID doesn't exist.",
    'ENTER_TEXT' => 'The new text is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
