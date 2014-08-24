<?php

include_once '../fns/task_method_page.php';
task_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the task to delete.',
    ],
], [
    'TASK_NOT_FOUND' => "A task with the ID doesn't exist.",
]);
