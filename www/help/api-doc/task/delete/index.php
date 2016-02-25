<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/task_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
task_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the task to delete.',
    ],
], ApiDoc\trueResult(), [
    'TASK_NOT_FOUND' => "A task with the ID doesn't exist.",
]);
