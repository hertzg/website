<?php

namespace Users\Schedules;

function delete ($mysqli, $user, $schedule) {

    include_once __DIR__.'/../../Schedules/delete.php';
    \Schedules\delete($mysqli, $schedule->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $user->id_users, -1);

    include_once __DIR__.'/../../days_left_from_today.php';
    $days_left = days_left_from_today($schedule->interval, $schedule->offset);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $days_left);

}
