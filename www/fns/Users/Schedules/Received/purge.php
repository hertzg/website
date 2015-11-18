<?php

namespace Users\Schedules\Received;

function purge ($mysqli, $receivedSchedule) {

    include_once __DIR__.'/../../../ReceivedSchedules/delete.php';
    \ReceivedSchedules\delete($mysqli, $receivedSchedule->id);

    $id_users = $receivedSchedule->receiver_id_users;

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

    if ($receivedSchedule->archived) {
        include_once __DIR__.'/addNumberArchived.php';
        addNumberArchived($mysqli, $id_users, -1);
    }

}
