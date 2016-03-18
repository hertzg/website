<?php

function require_schedule ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Schedules/get.php";
    $schedule = Users\Schedules\get($mysqli, $user, $id);

    if (!$schedule) {
        $_SESSION['schedules/errors'] = ['The schedule no longer exists.'];
        unset($_SESSION['schedules/messages']);
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$schedule, $id, $user];

}
