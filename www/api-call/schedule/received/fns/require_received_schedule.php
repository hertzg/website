<?php

function require_received_schedule ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Schedules/Received/get.php";
    $receivedSchedule = Users\Schedules\Received\get($mysqli, $user, $id);

    if (!$receivedSchedule) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"RECEIVED_SCHEDULE_NOT_FOUND"');
    }

    return $receivedSchedule;

}
