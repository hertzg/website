<?php

function require_schedule ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Schedules/get.php";
    $schedule = Users\Schedules\get($mysqli, $user, $id);

    if (!$schedule) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('SCHEDULE_NOT_FOUND');
    }

    return $schedule;

}
