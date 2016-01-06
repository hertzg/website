<?php

namespace Users\Tasks\Received;

function purge ($mysqli, $receivedTask) {

    include_once __DIR__.'/../../../ReceivedTasks/delete.php';
    \ReceivedTasks\delete($mysqli, $receivedTask->id);

    $id_users = $receivedTask->receiver_id_users;

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $id_users, -1, $receivedTask->archived ? -1 : 0);

}
