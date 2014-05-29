<?php

namespace Users\Tasks\Received;

function archive ($mysqli, $receivedTask) {
    include_once __DIR__.'/../../../ReceivedTasks/setArchived.php';
    \ReceivedTasks\setArchived($mysqli, $receivedTask->id, true);
}
