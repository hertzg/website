<?php

namespace Users\Tasks\Received;

function get ($mysqli, $user, $id) {

    if (!$user->num_received_tasks) return;

    include_once __DIR__.'/../../../ReceivedTasks/getOnReceiver.php';
    return \ReceivedTasks\getOnReceiver($mysqli, $user->id_users, $id);

}
