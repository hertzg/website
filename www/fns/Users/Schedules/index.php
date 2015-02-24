<?php

namespace Users\Schedules;

function index ($mysqli, $user) {

    if (!$user->num_schedules) return [];

    include_once __DIR__.'/../../Schedules/indexOnUser.php';
    return \Schedules\indexOnUser($mysqli, $user->id_users);

}
