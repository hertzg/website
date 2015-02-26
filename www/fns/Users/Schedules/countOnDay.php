<?php

namespace Users\Schedules;

function countOnDay ($mysqli, $user, $day) {

    if (!$user->num_schedules) return 0;

    include_once __DIR__.'/../../Schedules/countOnDay.php';
    return \Schedules\countOnDay($mysqli, $user->id_users, $day);

}
