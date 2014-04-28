<?php

include_once '../fns/task_method_page.php';
task_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the task to get.',
    ],
], ['TASK_NOT_FOUND']);
