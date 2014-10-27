<?php

function sort_schedules ($user, &$schedules) {

    include_once __DIR__.'/../../fns/days_left_from_today.php';
    foreach ($schedules as $schedule) {
        $interval = $schedule->interval;
        $offset = $schedule->offset;
        $schedule->days_left = days_left_from_today($user, $interval, $offset);
    }

    usort($schedules, function ($a, $b) {
        $result = $a->days_left - $b->days_left;
        if ($result) return $result;
        return $b->update_time - $a->update_time;
    });

}
