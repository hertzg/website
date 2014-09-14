<?php

function check_event_check_day ($mysqli, &$user) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/time_today.php";
    $timeToday = time_today();

    if ($user->events_check_day == $timeToday) return;

    $timeTomorrow = $timeToday + 60 * 60 * 24;
    $id_users = $user->id_users;

    include_once "$fnsDir/Events/countOnTime.php";
    $today = Events\countOnTime($mysqli, $id_users, $timeToday);
    $tomorrow = Events\countOnTime($mysqli, $id_users, $timeTomorrow);

    include_once "$fnsDir/Users/Events/setNumbers.php";
    Users\Events\setNumbers($mysqli,
        $id_users, $today, $tomorrow, $timeToday);

    $user->num_events_today = $today;
    $user->num_events_tomorrow = $tomorrow;

}
