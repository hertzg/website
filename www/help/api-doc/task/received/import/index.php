<?php

include_once '../fns/received_task_method_page.php';
received_task_method_page('import', [
    [
        'name' => 'id',
        'description' => 'The ID of the received task to import.',
    ],
], ['RECEIVED_TASK_NOT_FOUND']);
