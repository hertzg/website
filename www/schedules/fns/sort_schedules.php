<?php

function sort_schedules ($user, &$schedules) {

    include_once __DIR__.'/../../fns/days_left_from_today.php';
    foreach ($schedules as $schedule) {
        $interval = $schedule->interval;
        $offset = $schedule->offset;
        $schedule->days_left = days_left_from_today($user, $interval, $offset);
    }

    usort($schedules, function ($a, $b) {
        return $a->days_left - $b->days_left;
    });

}
