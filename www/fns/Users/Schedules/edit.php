<?php

namespace Users\Schedules;

function edit ($mysqli, $user, $schedule, $text, $interval, $offset) {

    include_once __DIR__.'/../../Schedules/edit.php';
    \Schedules\edit($mysqli, $schedule->id, $text, $interval, $offset);

    include_once __DIR__.'/../../days_left_from_today.php';
    $days_left = days_left_from_today($interval, $offset);
    $old_days_left = days_left_from_today(
        $schedule->interval, $schedule->offset);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $days_left);
    invalidateIfNeeded($mysqli, $user, $old_days_left);

}
