<?php

function require_first_stage () {

    $fnsDir = __DIR__.'/../../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../../');

    $key = 'schedules/received/edit-and-import/next/first_stage';
    if (!array_key_exists($key, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        redirect('../..');
    }

    $first_stage = $_SESSION[$key];
    $receivedSchedule = $first_stage['receivedSchedule'];

    return [$user, $receivedSchedule->id, $receivedSchedule, $first_stage];

}
