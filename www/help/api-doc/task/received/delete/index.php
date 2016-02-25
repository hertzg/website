<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_task_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
received_task_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received task to delete.',
    ],
], ApiDoc\trueResult(), [
    'RECEIVED_TASK_NOT_FOUND' => "A received task with the ID doesn't exist.",
]);
