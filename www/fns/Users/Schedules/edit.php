<?php

namespace Users\Schedules;

function edit ($mysqli, $user, $schedule,
    $text, $interval, $offset, $tags, $tag_names) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Schedules/edit.php";
    \Schedules\edit($mysqli, $schedule->id,
        $text, $interval, $offset, $tags, $tag_names);

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($user, $interval, $offset);
    $old_days_left = days_left_from_today($user,
        $schedule->interval, $schedule->offset);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $days_left);
    invalidateIfNeeded($mysqli, $user, $old_days_left);

}
