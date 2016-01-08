<?php

namespace Users\Tasks\Received;

function archive ($mysqli, $receivedTask) {

    if ($receivedTask->archived) return;

    include_once __DIR__.'/../../../ReceivedTasks/setArchived.php';
    \ReceivedTasks\setArchived($mysqli, $receivedTask->id, true);

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $receivedTask->receiver_id_users, 0, 1);

}
