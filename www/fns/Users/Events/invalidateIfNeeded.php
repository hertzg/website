<?php

namespace Users\Events;

function invalidateIfNeeded ($mysqli, &$user, $event_time) {

    include_once __DIR__.'/../../user_time_today.php';
    $timeToday = user_time_today($user);
    $timeTomorrow = $timeToday + 60 * 60 * 24;

    if ($event_time == $timeToday || $event_time == $timeTomorrow) {
        if ($user->events_check_day) {
            $user->events_check_day = 0;
            include_once __DIR__.'/invalidate.php';
            invalidate($mysqli, $user->id_users);
        }
    }

}
