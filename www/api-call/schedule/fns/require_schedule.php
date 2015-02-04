<?php

function require_schedule ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Schedules/getOnUser.php";
    $schedule = Schedules\getOnUser($mysqli, $id_users, $id);

    if (!$schedule) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('SCHEDULE_NOT_FOUND');
    }

    return $schedule;

}
