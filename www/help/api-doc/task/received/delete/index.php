<?php

include_once '../fns/received_task_method_page.php';
received_task_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received task to delete.',
    ],
], ['RECEIVED_TASK_NOT_FOUND']);
