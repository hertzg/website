<?php

function check_event_check_day ($mysqli, &$user) {

    $timeNow = time();
    $dayToday = date('j', $timeNow);
    $monthToday = date('n', $timeNow);
    $yearToday = date('Y', $timeNow);
    $timeToday = mktime(0, 0, 0, $monthToday, $dayToday, $yearToday);

    if ($user->events_check_day < $timeToday) {

        $timeTomorrow = mktime(0, 0, 0, $monthToday, $dayToday + 1, $yearToday);
        $id_users = $user->id_users;

        include_once __DIR__.'/../../fns/Events/countOnTime.php';
        $num_events_today = Events\countOnTime($mysqli, $id_users, $timeToday);
        $num_events_tomorrow = Events\countOnTime($mysqli, $id_users, $timeTomorrow);

        include_once __DIR__.'/../../fns/Users/updateEvents.php';
        Users\updateEvents($mysqli, $id_users, $num_events_today,
            $num_events_tomorrow, $timeToday);

        $user->num_events_today = $num_events_today;
        $user->num_events_tomorrow = $num_events_tomorrow;

    }

}
