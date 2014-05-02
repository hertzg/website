<?php

function check_event_check_day ($mysqli, &$user) {

    include_once __DIR__.'/../../fns/time_today.php';
    $timeToday = time_today();

    if ($user->events_check_day < $timeToday) {

        $timeTomorrow = $timeToday + 60 * 60 * 24;
        $id_users = $user->id_users;

        include_once __DIR__.'/../../fns/Events/countOnTime.php';
        $num_events_today = Events\countOnTime($mysqli, $id_users, $timeToday);
        $num_events_tomorrow = Events\countOnTime($mysqli, $id_users, $timeTomorrow);

        include_once __DIR__.'/../../fns/Users/Events/update.php';
        Users\Events\update($mysqli, $id_users, $num_events_today,
            $num_events_tomorrow, $timeToday);

        $user->num_events_today = $num_events_today;
        $user->num_events_tomorrow = $num_events_tomorrow;

    }

}
