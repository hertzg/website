<?php

function require_received_task ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Tasks/Received/get.php";
    $receivedTask = Users\Tasks\Received\get($mysqli, $user, $id);

    if (!$receivedTask) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"RECEIVED_TASK_NOT_FOUND"');
    }

    return $receivedTask;

}
