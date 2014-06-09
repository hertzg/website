<?php

function require_schedule ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Schedules/getOnUser.php";
    $schedule = Schedules\getOnUser($mysqli, $user->id_users, $id);

    if (!$schedule) {
        $_SESSION['schedules/errors'] = ['The schedule no longer exists.'];
        unset($_SESSION['schedules/messages']);
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$schedule, $id, $user];

}
