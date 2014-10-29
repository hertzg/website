<?php

namespace Users\Tasks\Deadlines;

function invalidateIfNeeded ($mysqli, &$user, $deadline_time) {

    include_once __DIR__.'/../../../user_time_today.php';
    $timeToday = user_time_today($user);
    $timeTomorrow = $timeToday + 60 * 60 * 24;

    if ($deadline_time == $timeToday || $deadline_time == $timeTomorrow) {
        if ($user->task_deadlines_check_day) {
            $user->task_deadlines_check_day = 0;
            include_once __DIR__.'/invalidate.php';
            invalidate($mysqli, $user->id_users);
        }
    }

}
