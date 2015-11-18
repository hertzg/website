<?php

namespace Users\Schedules\Received;

function index ($mysqli, $user) {

    if (!$user->num_received_schedules) return [];

    include_once __DIR__.'/../../../ReceivedSchedules/indexOnReceiver.php';
    return \ReceivedSchedules\indexOnReceiver($mysqli, $user->id_users);

}
