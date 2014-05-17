<?php

include_once '../fns/task_method_page.php';
task_method_page('sendExisting', [
    [
        'name' => 'id',
        'description' => 'The ID of the task to send.',
    ],
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
], [
    'TASK_NOT_FOUND', 'ENTER_RECEIVER_USERNAME',
    'RECEIVER_NOT_FOUND', 'RECEIVER_NOT_RECEIVING',
]);
