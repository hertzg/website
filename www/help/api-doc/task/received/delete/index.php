<?php

include_once '../fns/received_task_method_page.php';
include_once '../../../fns/true_result.php';
received_task_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received task to delete.',
    ],
], true_result(), [
    'RECEIVED_TASK_NOT_FOUND' => "A received task with the ID doesn't exist.",
]);
