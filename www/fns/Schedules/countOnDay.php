<?php

namespace Schedules;

function countOnDay ($mysqli, $id_users, $day_time) {

    include_once __DIR__.'/indexOnUser.php';
    $schedules = indexOnUser($mysqli, $id_users);

    $n = 0;
    $day = floor($day_time / (24 * 60 * 60));
    if ($schedules) {
        include_once __DIR__.'/../days_left.php';
        foreach ($schedules as $schedule) {
            $interval = $schedule->interval;
            $days_left = days_left($interval, $schedule->offset, $day);
            if (!$days_left) $n++;
        }
    }
    return $n;

}
