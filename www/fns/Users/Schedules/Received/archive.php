<?php

namespace Users\Schedules\Received;

function archive ($mysqli, $receivedSchedule) {

    if ($receivedSchedule->archived) return;

    include_once __DIR__.'/../../../ReceivedSchedules/setArchived.php';
    \ReceivedSchedules\setArchived($mysqli, $receivedSchedule->id, true);

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $receivedSchedule->receiver_id_users, 0, 1);

}
