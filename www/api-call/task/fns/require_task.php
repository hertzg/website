<?php

function require_task ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Tasks/get.php";
    $task = Users\Tasks\get($mysqli, $user, $id);

    if (!$task) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"TASK_NOT_FOUND"');
    }

    return $task;

}
