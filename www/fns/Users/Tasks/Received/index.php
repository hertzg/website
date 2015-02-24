<?php

namespace Users\Tasks\Received;

function index ($mysqli, $user) {

    if (!$user->num_received_tasks) return [];

    include_once __DIR__.'/../../../ReceivedTasks/indexOnReceiver.php';
    return \ReceivedTasks\indexOnReceiver($mysqli, $user->id_users);

}
