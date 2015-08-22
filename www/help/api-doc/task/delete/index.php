<?php

include_once '../fns/task_method_page.php';
include_once '../../fns/true_result.php';
task_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the task to delete.',
    ],
], true_result(), [
    'TASK_NOT_FOUND' => "A task with the ID doesn't exist.",
]);
