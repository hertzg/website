<?php

function check_event_check_day ($mysqli, &$user) {

    include_once __DIR__.'/../../fns/time_today.php';
    $timeToday = time_today();

    if ($user->events_check_day < $timeToday) {

        $id_users = $user->id_users;

        $numEvents = function ($time) use ($mysqli, $id_users) {
            $numEvents = Events\countOnTime($mysqli, $id_users, $time);
            $day = date('j', $time);
            $month = date('n', $time);
            $numEvents += Contacts\countBirthDays($mysqli,
                $id_users, $day, $month);
            return $numEvents;
        };

        $timeTomorrow = $timeToday + 60 * 60 * 24;

        include_once __DIR__.'/../../fns/Events/countOnTime.php';
        include_once __DIR__.'/../../fns/Contacts/countBirthDays.php';
        $num_events_today = $numEvents($timeToday);
        $num_events_tomorrow = $numEvents($timeTomorrow);

        include_once __DIR__.'/../../fns/Users/updateEvents.php';
        Users\updateEvents($mysqli, $id_users, $num_events_today,
            $num_events_tomorrow, $timeToday);

        $user->num_events_today = $num_events_today;
        $user->num_events_tomorrow = $num_events_tomorrow;

    }

}
