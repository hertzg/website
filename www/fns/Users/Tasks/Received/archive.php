<?php

namespace Users\Tasks\Received;

function archive ($mysqli, $receivedTask) {

    if ($receivedTask->archived) return;

    include_once __DIR__.'/../../../ReceivedTasks/setArchived.php';
    \ReceivedTasks\setArchived($mysqli, $receivedTask->id, true);

    include_once __DIR__.'/addNumberArchived.php';
    addNumberArchived($mysqli, $receivedTask->receiver_id_users, 1);

}
