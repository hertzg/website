<?php

function require_received_schedule ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Schedules/Received/get.php";
    $receivedSchedule = Users\Schedules\Received\get($mysqli, $user, $id);

    if (!$receivedSchedule) {
        unset($_SESSION['schedules/received/messages']);
        $error = 'The received schedule no longer exists.';
        $_SESSION['schedules/received/errors'] = [$error];
        include_once "$fnsDir/redirect.php";
        redirect($base === '' ? './' : $base);
    }

    return [$receivedSchedule, $id, $user];

}
