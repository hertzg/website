<?php

function require_schedule ($mysqli) {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user('../../');

    include_once __DIR__.'/../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../fns/Schedules/getOnUser.php';
    $schedule = Schedules\getOnUser($mysqli, $user->id_users, $id);

    if (!$schedule) {
        $_SESSION['schedules/errors'] = ['The schedule no longer exists.'];
        unset($_SESSION['schedules/messages']);
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return [$schedule, $id, $user];

}
