<?php

namespace Users\Schedules;

function get ($mysqli, $user, $id) {

    if (!$user->num_schedules) return;

    include_once __DIR__.'/../../Schedules/getOnUser.php';
    return \Schedules\getOnUser($mysqli, $user->id_users, $id);

}
