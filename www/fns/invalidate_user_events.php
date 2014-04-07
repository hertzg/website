<?php

function invalidate_user_events ($mysqli, $id_users, $event_time) {

    include_once __DIR__.'/time_today.php';
    $timeToday = time_today();
    $timeTomorrow = $timeToday + 60 * 60 * 24;

    if ($event_time == $timeToday || $event_time == $timeTomorrow) {
        include_once __DIR__.'/Users/invalidateEvents.php';
        Users\invalidateEvents($mysqli, $id_users);
    }

}
