<?php

include_once '../fns/task_method_page.php';
task_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the task to delete.',
    ],
]);
