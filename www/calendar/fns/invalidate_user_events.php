<?php

function invalidate_user_events ($mysqli, &$user, $event_time) {

    include_once __DIR__.'/../../fns/time_today.php';
    $timeToday = time_today();
    $timeTomorrow = $timeToday + 60 * 60 * 24;

    if ($event_time == $timeToday || $event_time == $timeTomorrow) {
        if ($user->events_check_day) {
            $user->events_check_day = 0;
            include_once __DIR__.'/../../fns/Users/Events/invalidate.php';
            Users\Events\invalidate($mysqli, $user->id_users);
        }
    }

}
