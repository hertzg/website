<?php

namespace Users\Tasks\Received;

function unarchive ($mysqli, $receivedTask) {

    if (!$receivedTask->archived) return;

    include_once __DIR__.'/../../../ReceivedTasks/setArchived.php';
    \ReceivedTasks\setArchived($mysqli, $receivedTask->id, false);

    include_once __DIR__.'/addNumberArchived.php';
    addNumberArchived($mysqli, $receivedTask->receiver_id_users, -1);

}
