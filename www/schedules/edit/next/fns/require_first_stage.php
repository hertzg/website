<?php

function require_first_stage () {

    include_once __DIR__.'/../../../../fns/require_user.php';
    $user = require_user('../../../');

    $key = 'schedules/edit/next/first_stage';
    if (!array_key_exists($key, $_SESSION)) {
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect('..');
    }

    $first_stage = $_SESSION[$key];
    $schedule = $first_stage['schedule'];

    return [$user, $schedule->id, $schedule, $first_stage];

}
