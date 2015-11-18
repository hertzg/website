<?php

namespace Users\Schedules\Received;

function get ($mysqli, $user, $id) {

    if (!$user->num_received_schedules) return;

    include_once __DIR__.'/../../../ReceivedSchedules/getOnReceiver.php';
    return \ReceivedSchedules\getOnReceiver($mysqli, $user->id_users, $id);

}
