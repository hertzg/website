<?php

namespace Users\Schedules\Received;

function purge ($mysqli, $receivedSchedule) {

    include_once __DIR__.'/../../../ReceivedSchedules/delete.php';
    \ReceivedSchedules\delete($mysqli, $receivedSchedule->id);

    $id_users = $receivedSchedule->receiver_id_users;

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $id_users, -1, $receivedSchedule->archived ? -1 : 0);

}
