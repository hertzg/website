<?php

function require_received_task ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/ReceivedTasks/getOnReceiver.php";
    $receivedTask = ReceivedTasks\getOnReceiver($mysqli, $id_users, $id);

    if (!$receivedTask) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('RECEIVED_TASK_NOT_FOUND');
    }

    return $receivedTask;

}
