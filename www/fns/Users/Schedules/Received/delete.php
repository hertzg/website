<?php

namespace Users\Schedules\Received;

function delete ($mysqli, $receivedSchedule, $apiKey = null) {

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedSchedule);

    include_once __DIR__.'/../../DeletedItems/addReceivedSchedule.php';
    \Users\DeletedItems\addReceivedSchedule(
        $mysqli, $receivedSchedule, $apiKey);

}
