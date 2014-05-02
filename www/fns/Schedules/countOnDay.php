<?php

namespace Schedules;

function countOnDay ($mysqli, $id_users, $day) {

    include_once __DIR__.'/indexOnUser.php';
    $schedules = indexOnUser($mysqli, $id_users);

    $n = 0;
    if ($schedules) {
        include_once __DIR__.'/../../schedules/fns/days_left.php';
        foreach ($schedules as $schedule) {
            $interval = $schedule->interval;
            $offset = $schedule->offset;
            $days_left = days_left($interval, $offset, $day);
            if (!$days_left) $n++;
        }
    }
    return $n;

}
