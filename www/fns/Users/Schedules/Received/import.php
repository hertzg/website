<?php

namespace Users\Schedules\Received;

function import ($mysqli, $user, $receivedSchedule, $insertApiKey = null) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $user, $receivedSchedule, $insertApiKey);

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedSchedule);

    return $id;

}
