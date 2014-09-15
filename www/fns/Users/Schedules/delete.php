<?php

namespace Users\Schedules;

function delete ($mysqli, $user, $schedule) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Schedules/delete.php";
    \Schedules\delete($mysqli, $schedule->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $user->id_users, -1);

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($schedule->interval, $schedule->offset);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $days_left);

}
