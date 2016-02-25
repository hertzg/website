<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_task_method_page.php';
received_task_method_page('importCopy', [
    [
        'name' => 'id',
        'description' => 'The ID of the received task to copy.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the imported task.',
], [
    'RECEIVED_TASK_NOT_FOUND' => "A received task with the ID doesn't exist.",
]);
