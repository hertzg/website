<?php

namespace Users\Tasks\Received;

function unarchive ($mysqli, $receivedTask) {
    include_once __DIR__.'/../../../ReceivedTasks/setArchived.php';
    \ReceivedTasks\setArchived($mysqli, $receivedTask->id, false);
}
