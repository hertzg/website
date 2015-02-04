<?php

function require_task ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Tasks/getOnUser.php";
    $task = Tasks\getOnUser($mysqli, $id_users, $id);

    if (!$task) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('TASK_NOT_FOUND');
    }

    return $task;

}
