<?php

function require_received_task ($mysqli) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user('../../../');

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/ReceivedTasks/getOnReceiver.php';
    $receivedTask = ReceivedTasks\getOnReceiver($mysqli, $user->id_users, $id);

    if (!$receivedTask) {
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect('..');
    }

    return [$receivedTask, $id, $user];

}
